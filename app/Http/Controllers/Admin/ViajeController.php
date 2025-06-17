<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ViajeController extends Controller
{
    public function index(Request $request)
    {
        $query = Viaje::query();

        // Aplicar búsqueda por nombre o email del usuario
        if ($request->filled('search_empleado')) {
            $search = $request->search_empleado;
            $query->whereHas('usuario', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Aplicar búsqueda por ID del empleado
        if ($request->filled('search_id')) {
            $search = $request->search_id;
            $query->where('id', $search);
        }

        if ($request->filled('search_puesto')) {
            $search = $request->search_puesto;
            $query->where('puesto', 'like', "%{$search}%");
        }

        if ($request->filled('search_salario')) {
            $search = $request->search_salario;
            $query->where('salario', $search);
        }

        if ($request->filled('search_estado')) {
            $search = $request->search_estado;
            $query->where('estado', $search);
        }

        // Aplicar filtro de fecha
        if ($request->filled('search_hiring_date')) {
            $date = $request->search_hiring_date;
            $query->whereDate('fecha_contratacion', $date);
        }

        // Aplicar todas las condiciones y obtener resultados
        $registros = $query->select(['id', 'nombre', 'tipo', 'origen', 'destino', 'fecha_salida', 'fecha_llegada', 'empresa', 'numero_viaje', 'capacidad_total', 'asientos_disponibles', 'precio_base', 'clases', 'descripcion', 'activo'])
            ->orderBy('fecha_contratacion', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Respuesta AJAX
        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-viajes-contenido', compact(['registros']))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} viajes"
            ]);
        }

        return view('administracion.viajes', compact('registros'));
    }
    public function crear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario_id' => 'required|integer|exists:users,id',
            'puesto' => 'required|string|max:255',
            'fecha_contratacion' => 'required|date|before_or_equal:today',
            'salario' => 'required|string|max:255',
            'estado' => 'nullable|string|in:activo,inactivo,vacaciones,licencia',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            // Crear el viaje
            Viaje::create([
                'id' => $request->usuario_id,
                'usuario_id' => $request->usuario_id,
                'puesto' => $request->puesto,
                'nivel' => "0",
                'fecha_contratacion' => $request->fecha_contratacion,
                'salario' => $request->salario,
                'estado' => $request->estado ?? 'activo',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Viaje creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Error al crear el Viaje",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Viaje $viaje)
    {

        // Formatear fechas para la vista
        if ($viaje->fecha_salida) $viaje->fecha_salida = $viaje->fecha_salida instanceof \Carbon\Carbon ? $viaje->fecha_salida->format('Y-m-d\TH:i') : $viaje->fecha_salida;
        if ($viaje->fecha_llegada) $viaje->fecha_llegada = $viaje->fecha_llegada instanceof \Carbon\Carbon ? $viaje->fecha_llegada->format('Y-m-d\TH:i') : $viaje->fecha_llegada;

        // Buscar la reserva activa para este viaje y usuario
        $reserva = null;
        if (auth()->check()) {
            $reserva = \App\Models\Reserva::where('tipo', 'viaje')
                ->where('servicio_id', $viaje->id)
                ->where('usuario_id', auth()->id())
                ->latest()
                ->first();
        }
        return view('detalles_viajes', compact('viaje', 'reserva'));
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

        $validator = Validator::make($request->all(), [
            'puesto' => 'required|string|max:255',
            'fecha_contratacion' => 'required|date|before_or_equal:today',
            'salario' => 'required|string|max:255',
            'estado' => 'nullable|string|in:activo,inactivo,vacaciones,licencia',
        ]);
        try {
            $viaje->update([
                'puesto' => $request->puesto,
                'fecha_contratacion' => $request->fecha_contratacion,
                'salario' => $request->salario,
                'estado' => $request->estado,

            ]);

            return response()->json([
                'message' => 'Viaje actualizado exitosamente',
                'data' => $viaje->fresh()
            ]);
        } catch (\Exception $e) {

            return response()->json([

                'message' => 'Error al actualizar el viaje',
                'error' => $e->getMessage()

            ], 500);
        }
    }

    public function destroy(Viaje $viaje)
    {
        try {
            $viaje->delete();

            return response()->json([
                'message' => 'Viaje eliminado exitosamente'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error al eliminar el viaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
