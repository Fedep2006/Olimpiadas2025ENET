<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use App\Http\Requests\VehiculoRequest;
use App\Models\ubicacion\Ciudad;
use App\Models\ubicacion\Pais;
use App\Models\ubicacion\Provincia;
use Illuminate\Http\Request;

class AdminVehiculosController extends Controller
{

    public function index(Request $request)
    {
        $query = Vehiculo::query();

        // Aplicar búsqueda
        if ($request->filled('search_tipo')) {
            $search = $request->search_tipo;
            $query->where('tipo', $search);
        }
        if ($request->filled('search_marca')) {
            $search = $request->search_marca;
            $query->where('marca', 'like', "%{$search}%");
        }
        if ($request->filled('search_modelo')) {
            $search = $request->search_modelo;
            $query->where('modelo', 'like', "%{$search}%");
        }
        if ($request->filled('search_antiguedad')) {
            $search = $request->search_antiguedad;
            $query->where('antiguedad', $search);
        }
        if ($request->filled('search_patente')) {
            $search = $request->search_patente;
            $query->where('patente', 'like', "%{$search}%");
        }
        if ($request->filled('search_color')) {
            $search = $request->search_color;
            $query->where('color', 'like', "%{$search}%");
        }
        if ($request->filled('search_vehiculos_disponibles')) {
            $search = $request->search_vehiculos_disponibles;
            $query->where('vehiculos_disponibles', $search);
        }
        if ($request->filled('search_capacidad_pasajeros')) {
            $search = $request->search_capacidad_pasajeros;
            $query->where('capacidad_pasajeros', $search);
        }
        if ($request->filled('search_provincia_id')) {
            $search = $request->search_provincia_id;
            $query->where('provincia_id', $search);
        }
        if ($request->filled('search_pais_id')) {
            $search = $request->search_pais_id;
            $query->where('pais_id', $search);
        }

        if ($request->filled('search_ciudad_id')) {
            $search = $request->search_ciudad_id;
            $query->where('ciudad_id', $search);
        }
        if ($request->filled('search_ubicacion')) {
            $search = $request->search_ubicacion;
            $query->Where('ubicacion', 'like', "%{$search}%");
        }
        if ($request->filled('search_precio_por_dia')) {
            $search = $request->search_precio_por_dia;
            $query->Where('precio_por_dia', 'like', "%{$search}%");
        }
        if ($request->filled('search_descripcion')) {
            $search = $request->search_descripcion;
            $query->Where('descripcion', 'like', "%{$search}%");
        }
        if ($request->filled('search_activo')) {
            $search = $request->search_activo;
            $query->Where('disponible', $search);
        }

        // Ordenar por fecha de creación descendente
        $registros = $query
            ->whereHas('pais')
            ->whereHas('provincia')
            ->whereHas('ciudad')
            ->with([
                'pais:id,nombre',
                'provincia:id,nombre,pais_id',
                'ciudad:id,nombre,provincia_id'
            ])->select(['id', 'tipo', 'marca', 'modelo', 'antiguedad', 'patente', 'color', 'capacidad_pasajeros', 'vehiculos_disponibles', 'pais_id', 'provincia_id', 'ciudad_id', 'ubicacion', 'precio_por_dia', 'disponible', 'descripcion', 'created_at'])->orderBy('created_at', 'desc');

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
        $paises = Pais::query()->get();
        $provincias = Provincia::query()->get();
        $ciudades = Ciudad::query()->get();
        return view('administracion.vehiculos', compact(['registros', 'paises', 'provincias', 'ciudades']));
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
