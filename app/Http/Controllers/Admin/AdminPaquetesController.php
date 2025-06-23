<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaqueteRequest;
use App\Models\Paquete;
use App\Models\PaqueteContenido;
use Illuminate\Http\Request;

class AdminPaquetesController extends Controller
{
    public function index(Request $request)
    {
        $query = Paquete::query();

        // Aplicar búsqueda
        if ($request->filled('search_usuario')) {
            $search = $request->search_usuario;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('search_nivel')) {
            $search = $request->search_nivel;
            $query->Where('nivel', $search);
        }

        // Aplicar filtro de fecha
        if ($request->filled('search_registration_date')) {
            $date = $request->search_registration_date;
            $query->whereDate('created_at', $date);
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

        return view('administracion.paquetes', compact('registros'));
    }

    public function content(Request $request)
    {
        $query = PaqueteContenido::find($request);
        $query = PaqueteContenido::where('email', 'juan@example.com')->first();
        $registros = $query->get();
        if ($request->ajax()) {

            return response()->json([
                'contenido' => $registros,
            ]);
        }
    }
    public function create(PaqueteRequest $request)
    {
        try {
            // Crear el viaje
            Paquete::create($request->validated());

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
