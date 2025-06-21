<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Http\Request;
use App\Http\Requests\ViajeRequest;
use App\Models\Empresa;

class AdminViajesController extends Controller
{

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

        if ($request->filled('search_asientos_disponibles')) {
            $search = $request->search_asientos_disponibles;
            $query->where('asientos_disponibles', 'like', "%{$search}%");
        }

        if ($request->filled('search_precio')) {
            $search = $request->search_precio;
            $query->where('precio_base', 'like', "%{$search}%");
        }

        if ($request->filled('search_empresa_id')) {
            $search = $request->search_empresa_id;
            $query->where('empresa_id', $search);
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
        $registros = $query->whereHas('empresa', function ($query) {
            $query->where('tipo', 'viajes');
        })
            ->with('empresa')
            ->select(['id', 'nombre', 'tipo', 'origen', 'destino', 'fecha_salida', 'fecha_llegada', 'empresa_id', 'numero_viaje', 'capacidad_total', 'asientos_disponibles', 'precio_base', 'descripcion', 'activo'])
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

        $empresas = Empresa::query()->where('tipo', 'viajes')
            ->select('id', 'nombre')
            ->orderBy('id', 'asc')
            ->get();
        return view('administracion.viajes', compact(['empresas', 'registros']));
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
                'message' => "Error al crear el viaje",
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
                'success' => true,
                'message' => 'Viaje eliminado exitosamente'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el viaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
