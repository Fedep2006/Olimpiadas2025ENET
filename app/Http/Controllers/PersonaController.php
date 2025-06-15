<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonaController extends Controller
{
    public function crear(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'dni' => 'required|integer|min:7|max:20|unique:personas,dni',
                'fecha_nacimiento' => 'required|date_format:d/m/Y|before:today',
                'nacionalidad' => 'required|string|max:100',
                'direccion' => 'required|string|min:6|max:20|unique:personas,dni',
                'ciudad' => 'required|string|min:6|max:20|unique:personas,dni',
                'pais' => 'required|string|min:6|max:20|unique:personas,dni',
                'pais' => 'required|string|min:6|max:20|unique:personas,dni',
                'email' => 'required|string|email|max:255|unique:users,email',
            ], [
                'name.required' => 'El nombre es obligatorio',
                'name.string' => 'El nombre debe ser texto',
                'name.max' => 'El nombre no puede tener más de 255 caracteres',
                'apellido.required' => 'El apellido es obligatorio',
                'apellido.string' => 'El apellido debe ser texto',
                'apellido.max' => 'El apellido no puede tener más de 255 caracteres',
                'dni.required' => 'El dni es obligatorio',
                'dni.integer' => 'El dni debe ser un numero',
                'dni.min' => 'El dni no puede ser menor a 6 digitos',
                'dni.max' => 'El dni no puede tener mas de 20 digitos',
                'dni.unique' => 'Este dni ya esta registrado',
                'email.required' => 'El correo electrónico es obligatorio',
                'email.string' => 'El correo electrónico debe ser texto',
                'email.email' => 'El correo electrónico debe ser válido',
                'email.max' => 'El correo electrónico no puede tener más de 255 caracteres',
                'email.unique' => 'Este correo electrónico ya está registrado',
                'password.required' => 'La contraseña es obligatoria',
                'password.string' => 'La contraseña debe ser texto',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            } else {
                // Create the user
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Usuario creado exitosamente'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
