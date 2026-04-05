<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PerfilController extends Controller
{
    //

    public function index(){
        
        // dd("Editando perfil");
        return Inertia::render('User/EditProfile');

    }


    public function store(Request $request){

        $request->validate([

            'name' => ['max:30'],
            'lastname'=> ['max:30'],
            'email'=> ['nullable','email','unique:users','ends_with:@unet.edu.ve'],
            'card_code'=>['unique:users','max:5']
            
        ]);


        $user = User::find(Auth::user()->id);

        $user->name = $request->name ? $request->name : $user->name;
        $user->lastname = $request->lastname ? $request->lastname : $user->lastname;
        $user->email = $request->email ? $request->email : $user->email;
        $user->card_code = $request->card_code ? $request->card_code : $user->card_code;
        $user->career = $request->career ? $request->career : $user->career;

        $user->save();

        return to_route('user-profile');

    }

}
