<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@pressngo.test'],
            [
                'name' => 'PressnGo Admin',
                'is_admin' => true,
                'password' => Hash::make('password'),
            ]
        );
    }
}
