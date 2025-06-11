<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 200 users using the factory
        User::factory()->count(200)->create();

        echo "\n200 users have been created successfully!\n";
        echo "All users have been created with the default password: 'password'\n";
    }
}
