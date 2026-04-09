<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetCode;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VerificationCodeController extends Controller
{
    public function show()
    {
        // Si no hay email en sesión, redirigir al inicio del flujo
        if (!session('reset_email')) {
            return redirect('/forgot-password');
        }

        return Inertia::render('Auth/VerificationCode');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ], [
            'code.required' => 'Ingresa el código de verificación.',
            'code.digits'   => 'El código debe tener 6 dígitos.',
        ]);

        $email = session('reset_email');

        if (!$email) {
            return redirect('/forgot-password');
        }

        $record = PasswordResetCode::where('email', $email)
            ->where('code', $request->code)
            ->first();

        if (!$record) {
            return back()->withErrors(['code' => 'El código es incorrecto.']);
        }

        if ($record->isExpired()) {
            $record->delete();
            return back()->withErrors(['code' => 'El código ha expirado. Solicita uno nuevo.']);
        }

        // Marcar en sesión que el código fue verificado
        session(['reset_code_verified' => true]);

        return redirect('/new-password');
    }
}