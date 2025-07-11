<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaqueteContenidoRequest;
use App\Models\Hospedaje;
use App\Models\Paquete;
use App\Models\PaqueteContenido;
use App\Models\Vehiculo;
use App\Models\Viaje;
use Illuminate\Http\Request;

class AdminContenidoController extends Controller
{

    public function index(Request $request)
    {
        $query = PaqueteContenido::with('contenido');


        // Aplicar búsqueda
        if ($request->filled('search_paquete')) {
            $search = $request->search_paquete;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('numero_paquete', 'like', "%{$search}%");
            });
        }
        if ($request->filled('search_contenido')) {
            $search = $request->search_contenido;
            $query->where(function ($q) use ($search) {
                $q->where('contenido_type', 'like', "%{$search}%");
            });
        }
        /*
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
        }*/

        // Ordenar por fecha de creación descendente
        $query->whereHas('paquete')->with([
            'paquete:id,nombre,numero_paquete'
        ])->select(['id', 'paquete_id', 'contenido_type', 'contenido_id', 'created_at'])->orderBy('created_at', 'desc');

        // Paginar resultados
        $registros = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-paquetes-contenidos-contenido', compact('registros'))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} contenidos"
            ]);
        }

        $viajes = Viaje::all();
        $hospedajes = Hospedaje::all();
        $vehiculos = Vehiculo::all();

        return view('administracion.paquetes-contenidos', compact(['registros', 'viajes', 'hospedajes', 'vehiculos']));
    }

    public function create(PaqueteContenidoRequest $request)
    {
        try {
            $paquete = Paquete::find($request->paquete_id);
            $paquete->contenidos()->create([
                'contenido_type' => $request->contenido_type,
                'contenido_id' => $request->contenido_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Contenido creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el contenido',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(PaqueteContenidoRequest $request, PaqueteContenido $paquete)
    {

        try {
            $paquete->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Contenido actualizado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el contenido',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(PaqueteContenido $paquete)
    {
        try {
            $paquete->delete();


            return response()->json([
                'success' => true,
                'message' => 'Contenido eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el contenido',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
