<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

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

    public function getNameAttribute(): string
    {
        return $this->full_name
            ?: $this->email;
    }

    public function profilePhotoUrl(string $size = '256'): string
    {
        if (! $this->profile_photo_path) {
            return asset('assets/images/avatar-placeholder.png');
        }

        $file = match ($size) {
            '64' => 'avatar_64.jpg',
            '256' => 'avatar_256.jpg',
            default => 'avatar_256.jpg',
        };

        return Storage::url("{$this->profile_photo_path}/{$file}");
    }

    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo_path) {
            return Storage::url($this->profile_photo_path);
        }

        return asset('assets/images/avatar-placeholder.png');
    }

    public function setFullNameAttribute($value): void
    {
        $value = trim((string) $value);

        $this->attributes['full_name'] = $value === '' ? null : $value;
    }
}
