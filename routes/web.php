<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Route::inertia('/', 'Welcome')->name('home');


Route::inertia('/inicio','Home')->name('home');
Route::inertia('/user-profile','User/Profile')->name('user-profile');
Route::inertia('/edit-profile','User/EditProfile')->name('edit-profile');

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);
Route::post('/logout',[LoginController::class,'logout']);


Route::get('/register',[RegisterController::class,'index']);
Route::post('/register',[RegisterController::class,'store']);