<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HospedajeRequest;
use App\Models\Hospedaje;
use Illuminate\Http\Request;

class AdminHospedajesController extends Controller
{
    public function index(Request $request)
    {
        $query = Hospedaje::query();

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
        $query->select(['id', 'empresa_id', 'tipo', 'habitacion', 'habitaciones_disponibles', 'capacidad_personas', 'precio_por_noche', 'ubicacion', 'pais', 'ciudad', 'estrellas', 'descripcion', 'telefono', 'email', 'sitio_web', 'check_in', 'check_out', 'calificacion', 'activo', 'condiciones', 'created_at'])->orderBy('created_at', 'desc');

        // Paginar resultados
        $registros = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-hospedajes-contenido', compact('registros'))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} hospedajes"
            ]);
        }

        return view('administracion.hospedajes', compact('registros'));
    }

    public function create(HospedajeRequest $request)
    {
        try {
            // Crear el viaje
            Hospedaje::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Hospedaje creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el hospedaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(HospedajeRequest $request, Hospedaje $hospedaje)
    {

        try {
            $hospedaje->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Hospedaje actualizado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el hospedaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Hospedaje $hospedaje)
    {
        try {
            $hospedaje->delete();


            return response()->json([
                'success' => true,
                'message' => 'Hospedaje eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el hospedaje',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
