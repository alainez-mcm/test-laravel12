<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Laravel\Facades\Image;

new class extends Component {
    use WithFileUploads;

    public ?string $full_name = null;
    public string $email;
    public $photo = null;
    public bool $delete_photo = false;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->full_name = Auth::user()->full_name;
        $this->email = Auth::user()->email;
    }

    /**
     * Esta función maneja el clic en la "X".
     * Si hay una foto nueva seleccionada, la quita.
     * Si no, marca la foto actual de la DB para ser borrada al guardar.
     */
    public function removePhoto(): void
    {
        if ($this->photo) {
            $this->photo = null;
        } else {
            $this->delete_photo = true;
        }
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $this->validate([
            'full_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($this->photo) {
            $image = Image::read($this->photo->getRealPath())
                ->cover(512, 512)
                ->toJpeg(90);

            $path = 'profile-photos/' . $user->id . '.jpg';
            Storage::disk('public')->put($path, (string) $image);
            $user->profile_photo_path = $path;
        } elseif ($this->delete_photo) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $user->profile_photo_path = null;
        }

        $user->fill(collect($validated)->except('photo')->toArray());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->photo = null;
        $this->delete_photo = false;
        $this->dispatch('profile-updated');
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">{{ __('profile.title') }}</h2>
        <p class="mt-1 text-sm text-gray-600">{{ __('profile.subtitle') }}</p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6">
        <div class="max-w-xl mx-auto">
            <div class="flex flex-col items-center gap-4 mb-8">
                <div class="avatar placeholder group relative inline-flex">

                    <div
                        class="w-32 h-32 rounded-full overflow-hidden border-2 border-black/10 transition-all duration-300 group-hover:border-black bg-neutral-100 text-neutral-800 relative">

                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="object-cover w-full h-full">
                        @elseif (auth()->user()->profile_photo_url && !$delete_photo)
                            <img src="{{ auth()->user()->profile_photo_url }}" class="object-cover w-full h-full">
                        @else
                            <div
                                class="flex items-center justify-center w-full h-full text-3xl font-bold uppercase tracking-wider">
                                {{ auth()->user()->initials }}
                            </div>
                        @endif

                        <div
                            class="absolute inset-0 bg-black/60 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">

                            <label for="photo_input"
                                class="cursor-pointer p-2 bg-white text-black rounded-full hover:scale-110 transition-transform shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <input type="file" id="photo_input" wire:model="photo"
                                    wire:change="$set('delete_photo', false)" class="hidden" accept="image/*">
                            </label>

                            @if ($photo || (auth()->user()->profile_photo_path && !$delete_photo))
                                <button type="button" wire:click="removePhoto"
                                    class="p-2 bg-black text-white rounded-full hover:scale-110 transition-transform shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div wire:loading wire:target="photo"
                        class="absolute inset-0 flex items-center justify-center bg-white/60 rounded-full z-20 backdrop-blur-[1px]">
                        <span class="loading loading-spinner loading-md text-black"></span>
                    </div>
                </div>

                @if ($delete_photo)
                    <span
                        class="text-[10px] uppercase font-bold tracking-widest text-black bg-gray-100 px-2 py-1 rounded border border-black/10">
                        {{ __('profile.will_delete_photo') }}
                    </span>
                @endif

                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div>

            <div class="space-y-6">
                <div>
                    <x-input-label for="full_name" :value="__('profile.full_name')" />
                    <x-text-input wire:model="full_name" id="full_name" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('full_name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('profile.email')" />
                    <x-text-input wire:model="email" id="email" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <div class="flex justify-center pt-2">
                    <x-primary-button wire:loading.attr="disabled">
                        {{ __('profile.save') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>
</section>
