<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin FootVibe',
            'email' => 'admin@footvibe.com',
            'password' => Hash::make('admin123'),
            'phone_number' => '082114232235',
        ]);
    }
}
