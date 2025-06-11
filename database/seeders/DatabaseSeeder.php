<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create predefined user
        User::factory()->create([
            'name' => 'Aaron',
            'email' => 'a@gmail.com',
            'password' => Hash::make('123'),
        ]);

        // Create test admin user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 200 additional users
        $this->call(UserSeeder::class);
    }
}
