<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    

class RegisterController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $email = $request->query('email');
        $token = $request->query('token');
        $user = \App\Models\User::where('email', $email)->where('verification_token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'El enlace de verificación no es válido.');
        }
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();
        return redirect()->route('login')->with('success', '¡Correo verificado correctamente! Ya puedes iniciar sesión.');
    }
    public function index(){
    return view('login.register'); // Make sure resources/views/login/register.blade.php exists
    }
    
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
        ], [
            'email.unique' => 'El correo electrónico ya está registrado.',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $result = \App\Models\User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        // Generar token de verificación seguro y sin caracteres problemáticos
        $token = \Illuminate\Support\Str::random(40);
        $result->verification_token = $token;
        $result->save();
        
        // Construir URL de verificación
        $verificationUrl = url('/verify-email?token=' . $token . '&email=' . urlencode($email));
        // Enviar correo de verificación
        \Mail::to($email)->send(new \App\Mail\VerifyEmail($result, $verificationUrl));
        return redirect()->route('login')->with('success', '¡Registro exitoso! Por favor verifica tu correo.');
    }



}

