<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Http\Request;
use App\Http\Requests\ViajeRequest;

class AdminViajeController extends Controller
{
    /**
     * Muestra el detalle de un viaje
     */
    public function show($id)
    {
        $viaje = \App\Models\Viaje::findOrFail($id);
        return view('administracion.viajes-show', compact('viaje'));
    }

    public function index(Request $request)
    {
        $query = Viaje::query();

        if ($request->filled('search_avion')) {
            $search = $request->search_avion;
            $query->where(function ($q) use ($search) {
                $q->where('tipo', 'like', "%{$search}%")
                    ->orWhere('numero_viaje', 'like', "%{$search}%");
            });
        }

        if ($request->filled('search_nombre')) {
            $search = $request->search_nombre;
            $query->where('nombre', 'like', "%{$search}%");
        }

        if ($request->filled('search_origen')) {
            $search = $request->search_origen;
            $query->where('origen', 'like', "%{$search}%");
        }

        if ($request->filled('search_destino')) {
            $search = $request->search_destino;
            $query->where('destino', 'like', "%{$search}%");
        }

        if ($request->filled('search_fecha_salida')) {
            $datetime = $request->search_fecha_salida;
            $query->where('fecha_salida', $datetime);
        }

        if ($request->filled('search_fecha_llegada')) {
            $datetime = $request->search_fecha_llegada;
            $query->where('fecha_llegada', $datetime);
        }

        if ($request->filled('search_empresa')) {
            $search = $request->search_empresa;
            $query->where('empresa', 'like', "%{$search}%");
        }

        if ($request->filled('search_capacidad_total')) {
            $search = $request->search_capacidad_total;
            $query->where('capacidad_total', 'like', "%{$search}%");
        }

        if ($request->filled('search_precio')) {
            $search = $request->search_precio;
            $query->where('precio_base', 'like', "%{$search}%");
        }

        if ($request->filled('search_clases')) {
            $search = $request->search_clases;
            $query->where('clases', $search);
        }

        if ($request->filled('search_descripcion')) {
            $search = $request->search_descripcion;
            $query->where('descripcion', 'like', "%{$search}%");
        }

        if ($request->filled('search_activo')) {
            $search = $request->search_activo;
            $query->where('activo', $search);
        }

        // Aplicar todas las condiciones y obtener resultados
        $registros = $query->select(['id', 'nombre', 'tipo', 'origen', 'destino', 'fecha_salida', 'fecha_llegada', 'empresa', 'numero_viaje', 'capacidad_total', 'asientos_disponibles', 'precio_base', 'clases', 'descripcion', 'activo'])
            ->orderBy('created_at', 'desc')
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
    public function create(ViajeRequest $request)
    {
        try {
            // Crear el viaje
            Viaje::create($request->validated());

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

    public function update(ViajeRequest $request, Viaje $viaje)
    {
        try {
            $viaje->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Viaje actualizado exitosamente',
                'data' => $viaje
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el viaje: ' . $e->getMessage()
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
