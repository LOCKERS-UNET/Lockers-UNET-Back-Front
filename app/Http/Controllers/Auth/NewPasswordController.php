<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class NewPasswordController extends Controller
{
    public function show()
    {
        // Verificar que vino del flujo correcto
        if (!session('reset_email') || !session('reset_code_verified')) {
            return redirect('/forgot-password');
        }

        return Inertia::render('Auth/NewPassword');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:6', 'confirmed'],
        ], [
            'password.required'  => 'La contraseña es obligatoria.',
            'password.min'       => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $email = session('reset_email');

        if (!$email || !session('reset_code_verified')) {
            return redirect('/forgot-password');
        }

        // Actualizar la contraseña del usuario
        User::where('email', $email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Limpiar los datos del flujo de recuperación
        PasswordResetCode::where('email', $email)->delete();
        session()->forget(['reset_email', 'reset_code_verified']);

        return redirect('/login')->with(
            'status',
            'Contraseña actualizada correctamente. Ya puedes iniciar sesión.'
        );
    }
}