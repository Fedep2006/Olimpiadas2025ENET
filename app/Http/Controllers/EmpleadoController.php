<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $query = Empleado::query();

        // Aplicar búsqueda por nombre o email del usuario
        if ($request->filled('search_empleado')) {
            $search = $request->search_empleado;
            $query->whereHas('usuario', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Aplicar búsqueda por ID del empleado
        if ($request->filled('search_id')) {
            $search = $request->search_id;
            $query->where('id', $search);
        }

        if ($request->filled('search_puesto')) {
            $search = $request->search_puesto;
            $query->where('puesto', 'like', "%{$search}%");
        }

        if ($request->filled('search_salario')) {
            $search = $request->search_salario;
            $query->where('salario', $search);
        }

        if ($request->filled('search_estado')) {
            $search = $request->search_estado;
            $query->where('estado', $search);
        }

        // Aplicar filtro de fecha
        if ($request->filled('search_hiring_date')) {
            $date = $request->search_hiring_date;
            $query->whereDate('fecha_contratacion', $date);
        }

        // Aplicar todas las condiciones y obtener resultados
        $registros = $query->with(['usuario' => function ($subQuery) {
            $subQuery->select('id', 'name', 'email'); // Incluir 'id' es importante para la relación
        }])
            ->whereHas('usuario') // Solo empleados con usuario válido
            ->whereNotNull('usuario_id') // Asegurar que usuario_id no sea null
            ->select(['id', 'usuario_id', 'puesto', 'nivel', 'salario', 'estado', 'fecha_contratacion'])
            ->orderBy('fecha_contratacion', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Respuesta AJAX
        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-empleados-contenido', compact(['registros']))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} empleados"
            ]);
        }

        return view('administracion.empleados', compact('registros'));
    }
    public function crear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuario_id' => 'required|integer|exists:users,id',
            'puesto' => 'required|string|max:255',
            'fecha_contratacion' => 'required|date|before_or_equal:today',
            'salario' => 'required|string|max:255',
            'estado' => 'nullable|string|in:activo,inactivo,vacaciones,licencia',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            // Crear el empleado
            Empleado::create([
                'id' => $request->usuario_id,
                'usuario_id' => $request->usuario_id,
                'puesto' => $request->puesto,
                'nivel' => "0",
                'fecha_contratacion' => $request->fecha_contratacion,
                'salario' => $request->salario,
                'estado' => $request->estado ?? 'activo',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Empleado creada exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Error al crear el empleado",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Empleado $empleado)
    {
        $validator = Validator::make($request->all(), [
            'puesto' => 'required|string|max:255',
            'fecha_contratacion' => 'required|date|before_or_equal:today',
            'salario' => 'required|string|max:255',
            'estado' => 'nullable|string|in:activo,inactivo,vacaciones,licencia',
        ]);
        try {
            $empleado->update([
                'puesto' => $request->puesto,
                'fecha_contratacion' => $request->fecha_contratacion,
                'salario' => $request->salario,
                'estado' => $request->estado,
            ]);

            return response()->json([
                'message' => 'Empleado actualizado exitosamente',
                'data' => $empleado->fresh()
            ]);
        } catch (\Exception $e) {

            return response()->json([

                'message' => 'Error al actualizar el empleado',
                'error' => $e->getMessage()

            ], 500);
        }
    }

    public function destroy(Empleado $empleado)
    {
        try {
            $empleado->delete();

            return response()->json([
                'message' => 'Empleado eliminado exitosamente'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error al eliminar el empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
