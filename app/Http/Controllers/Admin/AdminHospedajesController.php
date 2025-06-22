<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HospedajeRequest;
use App\Models\Empresa;
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

        if ($request->filled('search_hospedaje')) {
            $search = $request->search_hospedaje;
            $query->Where('nombre', 'like', "%{$search}%");
        }
        if ($request->filled('search_tipo')) {
            $search = $request->search_tipo;
            $query->Where('tipo', $search);
        }
        if ($request->filled('search_empresa_id')) {
            $search = $request->search_empresa_id;
            $query->Where('empresa_id', $search);
        }
        if ($request->filled('search_habitacion')) {
            $search = $request->search_habitacion;
            $query->Where('habitacion', $search);
        }
        if ($request->filled('search_maximo_personas')) {
            $search = $request->search_maximo_personas;
            $query->Where('capacidad_personas', $search);
        }
        if ($request->filled('search_hospedajes_disponibles')) {
            $search = $request->search_hospedajes_disponibles;
            $query->Where('habitaciones_disponibles', $search);
        }
        if ($request->filled('search_ubicacion')) {
            $search = $request->search_ubicacion;
            $query->where(function ($q) use ($search) {
                $q->where('ubicacion', 'like', "%{$search}%")
                    ->orWhere('pais', 'like', "%{$search}%")
                    ->orWhere('ciudad', 'like', "%{$search}%");
            });
        }
        if ($request->filled('search_calificacion')) {
            $search = $request->search_calificacion;
            $query->where(function ($q) use ($search) {
                $q->where('estrellas', $search)
                    ->orWhere('calificacion', $search);
            });
        }
        if ($request->filled('search_descripcion')) {
            $search = $request->search_descripcion;
            $query->Where('descripcion', 'like', "%{$search}%");
        }
        if ($request->filled('search_check_in')) {
            $search = $request->search_check_in;
            $query->WhereTime('check_in', $search);
        }
        if ($request->filled('search_check_out')) {
            $search = $request->search_check_out;
            $query->WhereTime('check_out', $search);
        }
        if ($request->filled('search_contacto')) {
            $search = $request->search_contacto;
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%")
                    ->orWhere('sitio_web', 'like', "%{$search}%");
            });
        }
        if ($request->filled('search_condiciones')) {
            $search = $request->search_condiciones;
            $query->Where('condiciones', 'like', "%{$search}%");
        }
        if ($request->filled('search_activo')) {
            $search = $request->search_activo;
            $query->where('activo', $search);
        }

        // Ordenar campos
        $query->select(['id', 'empresa_id', 'nombre', 'tipo', 'habitacion', 'habitaciones_disponibles', 'capacidad_personas', 'precio_por_noche', 'ubicacion', 'pais', 'ciudad', 'estrellas', 'descripcion', 'telefono', 'email', 'sitio_web', 'check_in', 'check_out', 'calificacion', 'activo', 'condiciones', 'created_at'])->orderBy('created_at', 'desc');

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
        $empresas = Empresa::query()->where('tipo', 'hospedajes')
            ->select('id', 'nombre')
            ->orderBy('id', 'asc')
            ->get();

        return view('administracion.hospedajes', compact(['registros', 'empresas']));
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
