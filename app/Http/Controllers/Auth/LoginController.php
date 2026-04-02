<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    //

    public function index(){

        return Inertia::render('Auth/Login');

    }


    public function store(Request $request){


        $credenciales = $request->validate([
            'email' => ['required','email','ends_with:@unet.edu.ve'],
            'password'=>['required']

        ]);

        if(!Auth::attempt($credenciales)){
           return back()->withErrors([
                'auth' => 'Credenciales Incorrectas.',
            ]);
        }



        return to_route('home');

    }

    public function logout(Request $request){

        Auth::logout();

        return to_route('login');

    }

}
