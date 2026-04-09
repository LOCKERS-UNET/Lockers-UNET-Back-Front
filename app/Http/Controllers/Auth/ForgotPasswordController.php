<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetCodeMail;
use App\Models\PasswordResetCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ForgotPasswordController extends Controller
{
    public function show()
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email'    => 'Ingresa un correo válido.',
            'email.exists'   => 'No encontramos una cuenta con ese correo.',
        ]);

        // Eliminar códigos anteriores del mismo correo
        PasswordResetCode::where('email', $request->email)->delete();

        // Generar código de 6 dígitos
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Guardar en BD con expiración de 15 minutos
        PasswordResetCode::create([
            'email'      => $request->email,
            'code'       => $code,
            'expires_at' => now()->addMinutes(15),
        ]);

        // Guardar el email en sesión
        session(['reset_email' => $request->email]);

        // Enviar el código por correo
        Mail::to($request->email)->send(new ResetCodeMail($code));

        return redirect('/verify-code')->with(
            'status',
            'Se ha enviado un código de verificación a tu correo.'
        );
    }
}