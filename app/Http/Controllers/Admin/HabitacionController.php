<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\Hospedaje;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class HabitacionController extends Controller
{
    public function verHabitaciones($hospedaje_id)
    {
        try {
            $hospedaje = Hospedaje::with('habitaciones')->findOrFail($hospedaje_id);
            return view('administracion.habitaciones', compact('hospedaje'));
        } catch (\Exception $e) {
            Log::error('Error al cargar las habitaciones: ' . $e->getMessage());
            return redirect()->route('administracion.hospedaje')->with('error', 'Error al cargar las habitaciones');
        }
    }

    public function agregar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'hospedaje_id' => 'required|exists:hospedajes,id',
                'numero' => 'required|string|max:10',
                'tipo' => 'required|string|max:50',
                'capacidad_personas' => 'required|integer|min:1',
                'precio_por_noche' => 'required|numeric|min:0',
                'precio_extra_persona' => 'nullable|numeric|min:0',
                'caracteristicas' => 'nullable|string',
                'servicios' => 'nullable|string',
                'camas' => 'nullable|string',
                'metros_cuadrados' => 'nullable|integer|min:1',
                'imagenes' => 'nullable|string',
                'descripcion' => 'nullable|string',
                'politicas' => 'nullable|string',
                'observaciones' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->all();
            
            // Convertir strings separados por comas en arrays
            $arrayFields = ['caracteristicas', 'servicios', 'camas', 'politicas'];
            foreach ($arrayFields as $field) {
                if (!empty($data[$field])) {
                    $data[$field] = array_map('trim', explode(',', $data[$field]));
                }
            }

            $habitacion = new Habitacion($data);
            $habitacion->disponible = true;
            $habitacion->save();

            return redirect()->back()->with('success', 'Habitación agregada correctamente');
        } catch (\Exception $e) {
            Log::error('Error al agregar habitación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al agregar la habitación');
        }
    }

    public function editar(Request $request, $id)
    {
        try {
            $habitacion = Habitacion::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'numero' => 'required|string|max:10',
                'tipo' => 'required|string|max:50',
                'capacidad_personas' => 'required|integer|min:1',
                'precio_por_noche' => 'required|numeric|min:0',
                'precio_extra_persona' => 'nullable|numeric|min:0',
                'caracteristicas' => 'nullable|string',
                'servicios' => 'nullable|string',
                'camas' => 'nullable|string',
                'metros_cuadrados' => 'nullable|integer|min:1',
                'imagenes' => 'nullable|string',
                'descripcion' => 'nullable|string',
                'politicas' => 'nullable|string',
                'observaciones' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->all();
            
            // Convertir strings separados por comas en arrays
            $arrayFields = ['caracteristicas', 'servicios', 'camas', 'politicas'];
            foreach ($arrayFields as $field) {
                if (!empty($data[$field])) {
                    $data[$field] = array_map('trim', explode(',', $data[$field]));
                }
            }

            $habitacion->update($data);

            return redirect()->back()->with('success', 'Habitación actualizada correctamente');
        } catch (\Exception $e) {
            Log::error('Error al editar habitación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al editar la habitación');
        }
    }

    public function cambiarEstado($id)
    {
        try {
            $habitacion = Habitacion::findOrFail($id);
            $habitacion->disponible = !$habitacion->disponible;
            $habitacion->save();

            $mensaje = $habitacion->disponible ? 'Habitación activada correctamente' : 'Habitación desactivada correctamente';
            return response()->json(['success' => true, 'message' => $mensaje]);
        } catch (\Exception $e) {
            Log::error('Error al cambiar estado de habitación: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al cambiar el estado de la habitación'], 500);
        }
    }

    public function eliminar($id)
    {
        try {
            $habitacion = Habitacion::findOrFail($id);
            $habitacion->delete();
            return redirect()->back()->with('success', 'Habitación eliminada correctamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar habitación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar la habitación');
        }
    }

    public function show($id)
    {
        try {
            $habitacion = Habitacion::findOrFail($id);
            return response()->json($habitacion);
        } catch (\Exception $e) {
            Log::error('Error al obtener detalles de habitación: ' . $e->getMessage());
            return response()->json(['error' => 'Error al obtener los detalles de la habitación'], 500);
        }
    }
} 