<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'root@root.com'],
            [
                'password' => Hash::make('root1234.'),
            ]
        );

        if (! $user->hasRole(RoleEnum::ROOT->value)) {
            $user->assignRole(RoleEnum::ROOT->value);
        }
    }
}
