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
            'password' => Hash::make('123456'),
            'card_code' => '67845',
            'career' => null, 
            'is_admin' => 1,
        ]);

        // USUARIO 1
        User::create([
            'name' => 'Juan',
            'lastname' => 'Perez',
            'email' => 'arturo.carvajalino@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '33564',
            'career' => 'Informatica',
            'is_admin' => 0,
        ]);

        // USUARIO 2
        User::create([
            'name' => 'Maria',
            'lastname' => 'Gomez',
            'email' => 'maria@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '12345',
            'career' => 'Psicología',
            'is_admin' => 0,
        ]);

        //----------------------------------------------
        User::create([
            'name' => 'Mariana',
            'lastname' => 'Gomez',
            'email' => 'marianita@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '22223',
            'career' => 'Psicología',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Diego',
            'lastname' => 'Sanchez',
            'email' => 'diego.sanchezr@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '25040',
            'career' => 'Informatica',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Lucas',
            'lastname' => 'Perez',
            'email' => 'lucp@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '32658',
            'career' => 'Civil',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Juan',
            'lastname' => 'Perez',
            'email' => 'juan.perez@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '00001',
            'career' => 'Informática',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Ana',
            'lastname' => 'Rodriguez',
            'email' => 'ana.rodriguez@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '00025',
            'career' => 'Música',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Pedro',
            'lastname' => 'Briceno',
            'email' => 'pedro.briceno@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '10542',
            'career' => 'Psicología',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Laura',
            'lastname' => 'Mendez',
            'email' => 'laura.mendez@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '05487',
            'career' => 'Civil',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Carlos',
            'lastname' => 'Sanchez',
            'email' => 'carlos.sanchez@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '22365',
            'career' => 'Mecánica',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Elena',
            'lastname' => 'Diaz',
            'email' => 'elena.diaz@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '00985',
            'career' => 'Prod. Animal',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Luis',
            'lastname' => 'Ramirez',
            'email' => 'luis.ramirez@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '44512',
            'career' => 'Agronomía',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Sofia',
            'lastname' => 'Torres',
            'email' => 'sofia.torres@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '00777',
            'career' => 'Arquitectura',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Diego',
            'lastname' => 'Flores',
            'email' => 'diego.flores@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '33214',
            'career' => 'Informática',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Lucia',
            'lastname' => 'Garcia',
            'email' => 'lucia.garcia@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '00123',
            'career' => 'Música',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Miguel',
            'lastname' => 'Hernandez',
            'email' => 'miguel.hernandez@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '99854',
            'career' => 'Civil',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Carmen',
            'lastname' => 'Rivas',
            'email' => 'carmen.rivas@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '00050',
            'career' => 'Prod. Animal',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Jorge',
            'lastname' => 'Castro',
            'email' => 'jorge.castro@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '77412',
            'career' => 'Mecánica',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Isabel',
            'lastname' => 'Morales',
            'email' => 'isabel.morales@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '08520',
            'career' => 'Arquitectura',
            'is_admin' => 0,
        ]);

        User::create([
            'name' => 'Andres',
            'lastname' => 'Suarez',
            'email' => 'andres.suarez@unet.edu.ve',
            'password' => Hash::make('123456'),
            'card_code' => '55632',
            'career' => 'Agronomía',
            'is_admin' => 0,
        ]);

    }
}