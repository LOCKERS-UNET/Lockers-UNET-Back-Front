<?php

namespace App\Http\Controllers;

use App\Models\Multa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MultaController extends Controller
{

    public function index(User $user){

        return Inertia::render('Admin/CrearMulta',[
            'user'=>$user
        ]);


    }

    public function store(Request $request){

        $request->validate([

            'monto'=>['required','integer','min:1'],
            'descripcion'=>['required','string','max:255']

        ]);

        Multa::create([
            'user_id'=>$request->user_id,
            'admin_id'=>Auth::user()->id,
            'monto'=>$request->monto,
            'descripcion'=>$request->descripcion
        ]);


    }

}
