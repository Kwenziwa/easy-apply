<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'John',
            'middle_name' => 'A.',
            'last_name' => 'Doe',
            'national_id' => Str::random(13),
            'date_of_birth' => '1990-01-01',
            'email' => 'user@example.com',
            'phone_number' => '1234567890',
            'email_verified_at' => now(),
            'type' => 0, // Assuming 1 represents a specific type of user
            'password' => Hash::make('password'), // Always hash passwords
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
