<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonaController extends Controller
{
    public function crear(Request $request)
    {
        try {
            // Verificar la informacion
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'dni' => 'required|integer|min:7|max:20|unique:personas,dni',
                'fecha_nacimiento' => 'required|date_format:d/m/Y|before:today',
                'nacionalidad' => 'required|string|max:100',
                'direccion' => 'required|string|min:10|max:255',
                'ciudad' => 'required|string|max:100',
                'pais' => 'required|string|max:100',
                'telefono' => 'required|string|regex:/^[0-9]{8,15}$/|unique:personas,telefono'
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
                'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
                'fecha_nacimiento.date_format' => 'La fecha de nacimiento o el formato es incorrecto',
                'fecha_nacimiento.before' => 'Fecha de nacimiento incorrecta. Revise las credenciales',
                'nacionalidad.required' => 'La nacionalidad es obligatoria',
                'nacionalidad.string' => 'La nacionalidad debe ser texto',
                'nacionalidad.max' => 'La nacionalidad es incorrecta',
                'direccion.required' => 'La direccion es obligatoria',
                'direccion.string' => 'La direccion debe ser texto',
                'direccion.min' => 'La direccion es incorrecta',
                'direccion.max' => 'La direccion es incorrecta',
                'ciudad.required' => 'La ciudad es obligatoria',
                'ciudad.string' => 'La ciudad debe ser texto',
                'ciudad.max' => 'La ciudad es incorrecta',
                'pais.required' => 'El pais es obligatorio',
                'pais.string' => 'El pais debe ser texto',
                'pais.max' => 'El pais es incorrecto',
                'telefono.required' => 'El telefono es obligatorio',
                'telefono.string' => 'El telefono es incorrecto. Verifique las credenciales',
                'telefono.regex' => 'El formato del telefono es incorrecto',
                'telefono.unique' => 'El telefono ya esta registrado',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            } else {
                // Crear el usuario
                Persona::create([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'dni' => $request->dni,
                    'fecha_nacimiento' => $request->fecha_nacimiento,
                    'nacionalidad' => $request->nacionalidad,
                    'direccion' => $request->direccion,
                    'ciudad' => $request->ciudad,
                    'pais' => $request->pais,
                    'telefono' => $request->telefono,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Persona creada exitosamente'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la persona',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy(Persona $registro)
    {
        try {
            $registro->deleted_at = now();
            $registro->save();

            return response()->json([
                'message' => 'Persona eliminada exitosamente'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error al eliminar la persona',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
