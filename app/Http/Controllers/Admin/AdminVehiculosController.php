<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehiculo;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehiculoRequest;
use Illuminate\Http\Request;

class AdminVehiculosController extends Controller
{

    public function index(Request $request)
    {
        $query = Vehiculo::query();

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
        $query->select(['id', 'tipo', 'marca', 'modelo', 'antiguedad', 'patente', 'color', 'capacidad_pasajeros', 'pais', 'ubicacion', 'precio_por_dia', 'disponible', 'descripcion', 'created_at'])->orderBy('created_at', 'desc');

        // Paginar resultados
        $registros = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-vehiculos-contenido', compact('registros'))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} vehiculos"
            ]);
        }

        return view('administracion.vehiculos', compact('registros'));
    }

    public function create(VehiculoRequest $request)
    {
        try {
            // Crear el viaje
            Vehiculo::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Vehiculo creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el vehiculo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(VehiculoRequest $request, Vehiculo $vehiculo)
    {

        try {
            $vehiculo->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Vehiculo actualizado exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el vehiculo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Vehiculo $vehiculo)
    {
        try {
            $vehiculo->delete();


            return response()->json([
                'success' => true,
                'message' => 'Vehiculo eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el vehiculo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
