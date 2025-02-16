<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '123',
            'backend_access' => '1',
        ]);
        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => '123',
        ]);
    }
}
