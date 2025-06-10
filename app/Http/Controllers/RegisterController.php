<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    

class RegisterController extends Controller
{
    public function index(){
    return view('login.register'); // Make sure resources/views/login/register.blade.php exists
    }
    
    public function register(Request $request){ 
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $result = \App\Models\User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        return redirect()->route('login')->with('success', 'Registration successful!');
    }



}

