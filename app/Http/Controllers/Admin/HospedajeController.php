<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospedaje;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class HospedajeController extends Controller
{
    public function index()
    {
        try {
            $hospedajes = Hospedaje::all();
            return view('administracion.hospedaje', compact('hospedajes'));
        } catch (\Exception $e) {
            Log::error('Error al cargar la vista de hospedajes: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar los hospedajes');
        }
    }

    public function agregar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'tipo' => 'required|in:hotel,hostal,apartamento,casa,cabaña,resort',
                'pais' => 'required|string|max:100',
                'ciudad' => 'required|string|max:100',
                'ubicacion' => 'required|string|max:255',
                'codigo_postal' => 'nullable|string|max:20',
                'estrellas' => 'nullable|integer|between:1,5',
                'disponibilidad' => 'boolean',
                'descripcion' => 'nullable|text',
                'servicios' => 'nullable|array',
                'imagenes' => 'nullable|array',
                'telefono' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:100',
                'sitio_web' => 'nullable|url|max:255',
                'check_in' => 'required|date_format:H:i',
                'check_out' => 'required|date_format:H:i',
                'check_in_24h' => 'boolean',
                'calificacion' => 'nullable|numeric|between:0,5',
                'politicas' => 'nullable|array',
                'observaciones' => 'nullable|text'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $hospedaje = new Hospedaje();
            $hospedaje->nombre = $request->nombre;
            $hospedaje->tipo = $request->tipo;
            $hospedaje->pais = $request->pais;
            $hospedaje->ciudad = $request->ciudad;
            $hospedaje->ubicacion = $request->ubicacion;
            $hospedaje->codigo_postal = $request->codigo_postal;
            $hospedaje->estrellas = $request->estrellas;
            $hospedaje->disponibilidad = $request->disponibilidad ?? true;
            $hospedaje->descripcion = $request->descripcion;
            $hospedaje->servicios = $request->servicios;
            $hospedaje->imagenes = $request->imagenes;
            $hospedaje->telefono = $request->telefono;
            $hospedaje->email = $request->email;
            $hospedaje->sitio_web = $request->sitio_web;
            $hospedaje->check_in = $request->check_in;
            $hospedaje->check_out = $request->check_out;
            $hospedaje->check_in_24h = $request->check_in_24h ?? false;
            $hospedaje->calificacion = $request->calificacion;
            $hospedaje->politicas = $request->politicas;
            $hospedaje->observaciones = $request->observaciones;
            $hospedaje->save();

            Log::info('Hospedaje creado exitosamente: ' . $hospedaje->id);

            return response()->json([
                'success' => true,
                'message' => 'Hospedaje creado exitosamente'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al crear hospedaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el hospedaje: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:hospedajes,id',
                'nombre' => 'required|string|max:255',
                'tipo' => 'required|in:hotel,hostal,apartamento,casa,cabaña,resort',
                'pais' => 'required|string|max:100',
                'ciudad' => 'required|string|max:100',
                'ubicacion' => 'required|string|max:255',
                'codigo_postal' => 'nullable|string|max:20',
                'estrellas' => 'nullable|integer|between:1,5',
                'disponibilidad' => 'boolean',
                'descripcion' => 'nullable|text',
                'servicios' => 'nullable|array',
                'imagenes' => 'nullable|array',
                'telefono' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:100',
                'sitio_web' => 'nullable|url|max:255',
                'check_in' => 'required|date_format:H:i',
                'check_out' => 'required|date_format:H:i',
                'check_in_24h' => 'boolean',
                'calificacion' => 'nullable|numeric|between:0,5',
                'politicas' => 'nullable|array',
                'observaciones' => 'nullable|text'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $hospedaje = Hospedaje::findOrFail($request->id);
            $hospedaje->nombre = $request->nombre;
            $hospedaje->tipo = $request->tipo;
            $hospedaje->pais = $request->pais;
            $hospedaje->ciudad = $request->ciudad;
            $hospedaje->ubicacion = $request->ubicacion;
            $hospedaje->codigo_postal = $request->codigo_postal;
            $hospedaje->estrellas = $request->estrellas;
            $hospedaje->disponibilidad = $request->disponibilidad;
            $hospedaje->descripcion = $request->descripcion;
            $hospedaje->servicios = $request->servicios;
            $hospedaje->imagenes = $request->imagenes;
            $hospedaje->telefono = $request->telefono;
            $hospedaje->email = $request->email;
            $hospedaje->sitio_web = $request->sitio_web;
            $hospedaje->check_in = $request->check_in;
            $hospedaje->check_out = $request->check_out;
            $hospedaje->check_in_24h = $request->check_in_24h;
            $hospedaje->calificacion = $request->calificacion;
            $hospedaje->politicas = $request->politicas;
            $hospedaje->observaciones = $request->observaciones;
            $hospedaje->save();

            Log::info('Hospedaje actualizado exitosamente: ' . $hospedaje->id);

            return response()->json([
                'success' => true,
                'message' => 'Hospedaje actualizado exitosamente'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al actualizar hospedaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el hospedaje: ' . $e->getMessage()
            ], 500);
        }
    }

    public function eliminar($id)
    {
        try {
            $hospedaje = Hospedaje::findOrFail($id);
            $hospedaje->delete();

            Log::info('Hospedaje eliminado exitosamente: ' . $id);

            return response()->json([
                'success' => true,
                'message' => 'Hospedaje eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            Log::error('Error al eliminar hospedaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el hospedaje: ' . $e->getMessage()
            ], 500);
        }
    }
} 