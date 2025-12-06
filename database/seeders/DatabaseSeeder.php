<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'gender' => 'male',
            'date_of_birth' => '1990-01-15',
            'role' => 'admin',
            'is_verified' => true,
        ]);

        // Create regular users
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'gender' => 'male',
            'date_of_birth' => '1995-05-20',
            'role' => 'user',
            'is_verified' => true,
        ]);

        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'gender' => 'female',
            'date_of_birth' => '1998-03-10',
            'role' => 'user',
            'is_verified' => false,
        ]);
    }
}
