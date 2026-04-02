<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisterController extends Controller
{
    //

    public function index(){


        return Inertia::render('Auth/Register');

    }
    

    public function store(Request $request){

        $credenciales = $request->validate([
            'name' => ['required','max:30'],
            'lastname'=>['required','max:30'],
            'email' => ['required','email','unique:users','ends_with:@unet.edu.ve'],
            'card_code' => ['required','unique:users','max:5'],
            'career'=>['required'],
            'password'=>['required','min:6','confirmed'],

        ]);

        //Añadiendo registro a la DB

        $user = User::create([

            'name' => $request->name,
            'lastname'=> $request->lastname,
            'email'=> $request->email,
            'card_code'=> $request->card_code,
            'career'=>$request->career,
            'password'=> $request->password

        ]);

        //Autenticando el Usuario

        Auth::login($user);

        return to_route('home');

    }

}
