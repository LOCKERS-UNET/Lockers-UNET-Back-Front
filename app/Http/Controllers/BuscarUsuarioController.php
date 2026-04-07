<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BuscarUsuarioController extends Controller
{
    //

    public function mostrar_usuario(User $user){

        
        return Inertia::render('Admin/VistaUsuario',[
            'user'=>$user
        ]);


    }

}
