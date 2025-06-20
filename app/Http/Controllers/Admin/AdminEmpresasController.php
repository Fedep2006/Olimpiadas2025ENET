<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Http\Request;
use App\Models\Empresa;

class AdminEmpresasController extends Controller
{
    public function index(Request $request)
    {
        $query = Empresa::query();

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
        $query->select(['id', 'nombre', 'tipo', 'created_at'])->orderBy('created_at', 'desc');

        // Paginar resultados
        $registros = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-empresas-contenido', compact('registros'))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} empresas"
            ]);
        }

        return view('administracion.empresas', compact('registros'));
    }

    public function create(EmpresaRequest $request)
    {
        try {
            // Crear el viaje
            Empresa::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Empresa creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el empresa',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(EmpresaRequest $request, Empresa $empresa)
    {

        try {
            $empresa->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Empresa actualizada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la empresa',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(EmpresaRequest $request, Empresa $empresa)
    {
        try {
            $empresa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Empresa eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el empresa',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
