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
            'card_code' => 'ADMIN001',
            'career' => 'Administracion',
            'is_admin' => 1,
        ]);

        // USUARIO 1
        User::create([
            'name' => 'Juan',
            'lastname' => 'Perez',
            'email' => 'juan@unet.edu.ve',
            'password' => Hash::make('Juan123$'),
            'card_code' => 'EST001',
            'career' => 'Informatica',
            'is_admin' => 0,
        ]);

        // USUARIO 2
        User::create([
            'name' => 'Maria',
            'lastname' => 'Gomez',
            'email' => 'maria@unet.edu.ve',
            'password' => Hash::make('Maria123%'),
            'card_code' => 'EST002',
            'career' => 'Sistemas',
            'is_admin' => 0,
        ]);
    }
}