<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'profile_photo_path',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getDisplayNameAttribute(): string
    {
        return blank($this->full_name)
            ? $this->email
            : $this->full_name;
    }

    public function getInitialsAttribute(): string
    {
        $name = $this->display_name;
        $words = collect(explode(' ', $name))->filter();

        if ($words->count() >= 2) {
            return $words->map(fn ($word) => Str::upper(Str::substr($word, 0, 1)))
                ->take(2)
                ->join('');
        }

        if ($words->count() === 1) {
            return Str::upper(Str::substr($words->first(), 0, 2));
        }

        return Str::upper(Str::substr($this->email, 0, 2));
    }

    public function getProfilePhotoUrlAttribute(): ?string
    {
        if (!$this->profile_photo_path) return null;
        
        $version = $this->updated_at ? $this->updated_at->timestamp : time();
        return Storage::url($this->profile_photo_path) . '?v=' . $version;
    }

    public function setFullNameAttribute($value): void
    {
        $value = trim((string) $value);

        $this->attributes['full_name'] = $value === '' ? null : $value;
    }
}
