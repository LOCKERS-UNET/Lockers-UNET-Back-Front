<?php

namespace Database\Seeders;

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
            'name' => 'Admin',
            'lastname' => 'UNET',
            'email' => 'admin@unet.edu.ve',
            'password' => bcrypt('admin123'),
            'card_code' => 'ADMIN001',
            'career' => 'Administración',
            'is_admin' => 1,
        ]);
    }
}
