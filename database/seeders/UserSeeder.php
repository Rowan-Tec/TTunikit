<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user for login testing
        \App\Models\User::create([
            'name' => 'Test User',
            'full_names' => 'Test',
            'surname' => 'User',
            'email' => 'test@example.com',
            'username' => 'testuser',
            'password' => \Hash::make('password'),
            'cellphone' => '+1234567890',
            'gender' => 'prefer-not-say',
            'date_of_birth' => '1990-01-01',
        ]);
    }
}
