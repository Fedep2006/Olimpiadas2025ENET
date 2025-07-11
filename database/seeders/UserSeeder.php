<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'nivel' => 2,
            'email_verified_at' => now(),
        ]);
        // Create 400 users using the factory
        User::factory()->count(100)->create();
    }
}
