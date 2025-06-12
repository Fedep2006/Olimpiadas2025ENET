<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ViajeController extends Controller
{
    public function index()
    {
        $viajes = Viaje::all();
        
        // Opciones de clases (esto debería venir de un modelo en producción)
        $clases = [
            ['id' => 'economy', 'nombre' => 'Económica'],
            ['id' => 'business', 'nombre' => 'Ejecutiva'],
            ['id' => 'first', 'nombre' => 'Primera Clase'],
            ['id' => 'premium', 'nombre' => 'Premium Economy']
        ];
        
        // Opciones de servicios (esto debería venir de un modelo en producción)
        $servicios = [
            ['id' => 'wifi', 'nombre' => 'WiFi a bordo'],
            ['id' => 'food', 'nombre' => 'Comida incluida'],
            ['id' => 'entertainment', 'nombre' => 'Entretenimiento a bordo'],
            ['id' => 'luggage', 'nombre' => 'Equipaje incluido'],
            ['id' => 'priority', 'nombre' => 'Embarque prioritario']
        ];
        
        $tipos = ['Nacional' => 'Nacional', 'Internacional' => 'Internacional'];
        return view('administracion.viajes', compact('viajes', 'clases', 'servicios', 'tipos'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'tipo' => 'required|string|max:50',
                'origen' => 'required|string|max:100',
                'destino' => 'required|string|max:100',
                'fecha_salida' => 'required|date',
                'fecha_llegada' => 'required|date|after_or_equal:fecha_salida',
                'empresa' => 'required|string|max:100',
                'numero_viaje' => 'required|string|max:50',
                'capacidad_total' => 'required|integer|min:1',
                'asientos_disponibles' => 'required|integer|min:0',
                'precio_base' => 'required|numeric|min:0',
                'descripcion' => 'nullable|string',
                'observaciones' => 'nullable|string',
                'clases' => 'nullable|array',
                'servicios' => 'nullable|array',
                'activo' => 'required|boolean'
            ]);

            $validated['activo'] = filter_var($validated['activo'], FILTER_VALIDATE_BOOLEAN);
            
            if (isset($validated['clases'])) {
                $validated['clases'] = json_encode($validated['clases']);
            }
            
            if (isset($validated['servicios'])) {
                $validated['servicios'] = json_encode($validated['servicios']);
            }

            $viaje = Viaje::create($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Viaje creado exitosamente',
                'data' => $viaje
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear viaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el viaje: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Viaje $viaje)
    {
        try {
            $viaje->fecha_salida = $viaje->fecha_salida->format('Y-m-d\TH:i');
            $viaje->fecha_llegada = $viaje->fecha_llegada->format('Y-m-d\TH:i');
            return response()->json($viaje);
        } catch (\Exception $e) {
            Log::error('Error al mostrar viaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar los datos del viaje'
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $viaje = Viaje::findOrFail($id);
            
            // Formatear fechas para los campos datetime-local
            $viaje->fecha_salida = $viaje->fecha_salida->format('Y-m-d\TH:i');
            $viaje->fecha_llegada = $viaje->fecha_llegada->format('Y-m-d\TH:i');
            
            // Asegurarse de que los campos de array estén en el formato correcto
            if (!is_array($viaje->clases) && !empty($viaje->clases)) {
                $viaje->clases = json_decode($viaje->clases, true) ?: [];
            }
            
            if (!is_array($viaje->servicios) && !empty($viaje->servicios)) {
                $viaje->servicios = json_decode($viaje->servicios, true) ?: [];
            }
            
            return response()->json($viaje);
        } catch (\Exception $e) {
            Log::error('Error al obtener viaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el viaje: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'tipo' => 'required|string|max:50',
                'origen' => 'required|string|max:100',
                'destino' => 'required|string|max:100',
                'fecha_salida' => 'required|date',
                'fecha_llegada' => 'required|date|after_or_equal:fecha_salida',
                'empresa' => 'required|string|max:100',
                'numero_viaje' => 'required|string|max:50',
                'capacidad_total' => 'required|integer|min:1',
                'asientos_disponibles' => 'required|integer|min:0',
                'precio_base' => 'required|numeric|min:0',
                'descripcion' => 'nullable|string',
                'observaciones' => 'nullable|string',
                'clases' => 'nullable|array',
                'servicios' => 'nullable|array',
                'activo' => 'required|boolean'
            ]);

            $viaje = Viaje::findOrFail($id);
            
            $validated['activo'] = filter_var($validated['activo'], FILTER_VALIDATE_BOOLEAN);
            
            if (isset($validated['clases'])) {
                $validated['clases'] = json_encode($validated['clases']);
            }
            
            if (isset($validated['servicios'])) {
                $validated['servicios'] = json_encode($validated['servicios']);
            }

            $viaje->update($validated);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Viaje actualizado exitosamente',
                'data' => $viaje
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar viaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el viaje: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $viaje = Viaje::findOrFail($id);
            $viaje->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Viaje eliminado exitosamente'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar viaje: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el viaje: ' . $e->getMessage()
            ], 500);
        }
    }
} 