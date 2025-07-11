<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaqueteRequest;
use App\Models\Hospedaje;
use App\Models\Paquete;
use App\Models\PaqueteContenido;
use App\Models\Vehiculo;
use App\Models\Viaje;
use Illuminate\Http\Request;

class AdminPaquetesController extends Controller
{
    public function index(Request $request)
    {
        $query = Paquete::query();

        // Aplicar búsqueda
        if ($request->filled('search_paquete')) {
            $search = $request->search_paquete;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('numero_paquete', 'like', "%{$search}%");
            });
        }
        if ($request->filled('search_descripcion')) {
            $search = $request->search_descripcion;
            $query->Where('descripcion', 'like', "%{$search}%");
        }
        if ($request->filled('search_precio_total')) {
            $search = $request->search_precio_total;
            $query->Where('precio_total', 'like', "%{$search}%");
        }
        if ($request->filled('search_duracion')) {
            $search = $request->search_duracion;
            $query->Where('duracion', $search);
        }
        if ($request->filled('search_ubicacion')) {
            $search = $request->search_ubicacion;
            $query->Where('ubicacion', 'like', "%{$search}%");
        }
        if ($request->filled('search_cupo_minimo')) {
            $search = $request->search_cupo_minimo;
            $query->Where('cupo_minimo', $search);
        }
        if ($request->filled('search_cupo_maximo')) {
            $search = $request->search_cupo_maximo;
            $query->Where('cupo_maximo', $search);
        }
        if ($request->filled('search_hecho_por_usuario')) {
            $search = $request->search_hecho_por_usuario;
            $query->Where('hecho_por_usuario', $search);
        }
        if ($request->filled('search_activo')) {
            $search = $request->search_activo;
            $query->Where('activo', $search);
        }

        // Ordenar por fecha de creación descendente
        $query->select(['id', 'nombre', 'descripcion', 'precio_total', 'duracion', 'ubicacion', 'cupo_minimo', 'cupo_maximo', 'numero_paquete', 'activo', 'created_at'])->orderBy('created_at', 'desc');

        // Paginar resultados
        $registros = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-paquetes-contenido', compact('registros'))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} paquetes"
            ]);
        }

        return view('administracion.paquetes', compact(['registros']));
    }

    public function create(PaqueteRequest $request)
    {
        try {
            // Crear el paquete
            Paquete::create([
                'nombre' => $request->nombre,
                'duracion' => $request->duracion,
                'ubicacion' => $request->ubicacion,
                'cupo_minimo' => $request->cupo_minimo,
                'cupo_maximo' => $request->cupo_maximo,
                'precio_total' => $request->precio_total,
                'numero_paquete' => $request->numero_paquete,
                'descripcion' => $request->descripcion,
                'hecho_por_usuario' => $request->hecho_por_usuario,
                'activo' => $request->activo,

            ]);
            //foreach ($request->contenido_type as $index => $tabla) {}

            return response()->json([
                'success' => true,
                'message' => 'Paquete creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el paquete',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(PaqueteRequest $request, Paquete $paquete)
    {

        try {
            $paquete->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Paquete actualizado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el paquete',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Paquete $paquete)
    {
        try {
            $paquete->delete();


            return response()->json([
                'success' => true,
                'message' => 'Paquete eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el paquete',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
