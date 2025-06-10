<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validación básica
        echo "<script>console.log(" . $request->boolean('remember') . ");</script>";
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'remember' => 'boolean'
        ]);

        // Intentar credenciales
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/administracion')
                ->with('success', 'Has iniciado sesión correctamente.');
        }

        // Si falla
        return back()
            ->withErrors(['email' => 'Credenciales inválidas.'])
            ->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Sesión cerrada correctamente.');
    }
}
