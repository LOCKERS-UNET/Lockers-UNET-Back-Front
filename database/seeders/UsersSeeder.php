<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Admin',
            'lastname' => 'Principal',
            'email' => 'admin@unet.edu.ve',
            'password' => Hash::make('Admin123!'),
            'card_code' => '67845',
            'career' => null, 
            'is_admin' => 1,
        ]);

        // USUARIO 1
        User::create([
            'name' => 'Juan',
            'lastname' => 'Perez',
            'email' => 'juan@unet.edu.ve',
            'password' => Hash::make('Juan123$'),
            'card_code' => '33564',
            'career' => 'Informatica',
            'is_admin' => 0,
        ]);

        // USUARIO 2
        User::create([
            'name' => 'Maria',
            'lastname' => 'Gomez',
            'email' => 'maria@unet.edu.ve',
            'password' => Hash::make('Maria123%'),
            'card_code' => '12345',
            'career' => 'Psicología',
            'is_admin' => 0,
        ]);
    }
}