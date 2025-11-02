<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email','admin@demo.test')->exists()) {
            User::create([
                'name'     => 'Admin',
                'username' => 'admin',
                'email'    => 'admin@demo.test',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]);
        }
    }
}
