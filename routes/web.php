<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

// Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth'])->group(function(){

    Route::inertia('/','Home')->name('home');
    Route::inertia('/user-profile','User/Profile')->name('user-profile');
    Route::get('/edit-profile',[PerfilController::class,'index'])->name('editar-perfil');
    Route::post('/edit-profile',[PerfilController::class,'store']);

    Route::inertia('/mi-locker','User/MiLocker')->name('mi-locker');
    Route::inertia('/notificaciones','User/Notificaciones')->name('notificaciones');
    Route::inertia('/buscar-locker','User/BuscarLocker')->name('buscar-locker');


    //Admin
    Route::inertia('/inicio-admin','Admin/HomeAdmin')->name('home-admin'); 
    Route::inertia('/aranceles-admin','Admin/Aranceles')->name('aranceles-admin');
    Route::inertia('/asignaciones-admin','Admin/Asignaciones')->name('asignaciones-admin');
    Route::inertia('/estadisticas-lockers','Admin/EstadisticasLockers')->name('estadisticas-admin');
    Route::inertia('/gestion-lockers-admin','Admin/GestionLockers')->name('gestion-admin');
    Route::inertia('/incidencias-admin','Admin/Incidencias')->name('incidencias-admin');
    Route::inertia('/usuarios-admin','Admin/Usuarios')->name('usuarios-admin');

});

//Estas rutas deben ir protegidas


Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LoginController::class,'logout']);


Route::get('/register',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'store']);