<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $query = Empleado::query();

        // Aplicar búsqueda
        if ($request->filled('search_empleado')) {
            $search = $request->search_empleado;
            $query->usuario->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }
        if ($request->filled('search_id')) {
            $search = $request->search_id;
            $query->where('id', $search);
        }

        // Aplicar filtro de fecha
        if ($request->filled('search_hiring_date')) {
            $date = $request->search_hiring_date;
            $query->whereDate('fecha_contratacion', $date);
        }

        // Ordenar por fecha de creación descendente
        $query->select(['id', 'usuario_id', 'persona_id', 'puesto', 'nivel', 'salario', 'estado', 'habilidades', 'observaciones', 'fecha_contratacion'])->orderBy('fecha_contratacion', 'desc');

        // Paginar resultados
        $registros = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-empleados-contenido', compact('registros'))->render();
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
        try {
            // Verificar la informacion
            $validator = Validator::make($request->all(), [
                'usuario_id' => 'required|integer|exists:usuarios,id',
                'persona_id' => 'required|integer|exists:personas,id',
                'puesto' => 'required|string|max:255',
                'nivel' => 'required|integer|in:0,1,2,3',
                'fecha_contratacion' => 'required|date|before_or_equal:today',
                'salario' => 'required|numeric|min:0|max:999999999.99',
                'estado' => 'required|string|in:activo,inactivo,vacaciones,licencia',
                'habilidades' => 'nullable|array|max:50',
                'habilidades.*' => 'required|string|min:2|max:100|distinct',
                'observaciones' => 'nullable|string|max:65535'
            ], [
                'usuario_id.required' => 'La ID del usuario es obligatoria',
                'usuario_id.integer' => 'La ID del usuario tiene que ser un numero',
                'usuario_id.exists' => 'El usuario con esa ID no existe',
                'persona_id.required' => 'La ID de la persona es obligatoria',
                'persona_id.integer' => 'La ID de la persona tiene que ser un numero',
                'persona_id.exists' => 'La persona con esa ID no existe',
                'puesto.required' => 'El puesto es obligatorio',
                'puesto.string' => 'El puesto debe ser texto',
                'puesto.max' => 'El puesto esta escrito incorrectamente',
                'nivel.required' => 'El nivel es obligatorio',
                'nivel.integer' => 'El nivel debe ser un numero',
                'nivel.in' => 'El nivel solo puede ser de 0 a 3',
                'fecha_contratacion.required' => 'La fecha de contratacion es obligatoria',
                'fecha_contratacion.date' => 'La fecha esta escrita incorrectamente',
                'fecha_contratacion.before_or_equal' => 'La fecha es incorrecta',
                'salario.required' => 'El salario es obligatorio',
                'salario.numeric' => 'El salario debe ser un numero',
                'salario.min' => 'El salario no puede ser negativo',
                'salario.max' => 'El salario es muy largo',
                'estado.required' => 'El estado es obligatorio',
                'estado.string' => 'El estado debe ser texto',
                'estado.in' => 'El estado es incorrecto',
                'habilidades.array' => 'Las habilidades deben ser una array',
                'habilidades.max' => 'Las habilidades no pueden superar las 50',
                'habilidades.*.required' => 'La habilidad es obligatoria',
                'habilidades.*.string' => 'La habilidad debe ser texto',
                'habilidades.*.min' => 'La habilidad es muy corta',
                'habilidades.*.max' => 'La habilidad es muy larga',
                'habilidades.*.distinct' => 'Esta habilidad ya esta repetida',
                'observaciones.string' => 'La observacion debe ser texto',
                'observaciones.max' => 'La observacion es muy larga',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            } else {
                // Crear el empleado
                Empleado::create([
                    'usuario_id' => $request->usuario_id,
                    'persona_id' => $request->persona_id,
                    'puesto' => $request->puesto,
                    'nivel' => $request->nivel,
                    'fecha_contratacion' => $request->fecha_contratacion,
                    'salario' => $request->salario,
                    'estado' => $request->estado,
                    'habilidades' => $request->habilidades,
                    'observaciones' => $request->observaciones,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Empleado creada exitosamente'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Empleado $registro)
    {
        $request->validate([
            'id' => 'required|integer|exists:empleados,id',
            'usuario_id' => 'required|integer|exists:usuarios,id',
            'persona_id' => 'required|integer|exists:personas,id',
            'puesto' => 'required|string|max:255',
            'nivel' => 'required|integer|in:0,1,2,3',
            'fecha_contratacion' => 'required|date|before_or_equal:today',
            'salario' => 'required|numeric|min:0|max:999999999.99',
            'estado' => 'required|string|in:activo,inactivo,vacaciones,licencia',
            'habilidades' => 'required|array|max:50',
            'habilidades.*' => 'required|string|min:2|max:100|distinct',
            'observaciones' => 'nullable|string|max:65535'
        ]);

        try {
            $registro->update($request->validated());

            return response()->json([
                'message' => 'Empleado actualizado exitosamente',
                'data' => $registro->fresh()
            ]);
        } catch (\Exception $e) {

            return response()->json([

                'message' => 'Error al actualizar el empleado',
                'error' => $e->getMessage()

            ], 500);
        }
    }

    public function destroy(Empleado $registro)
    {
        try {
            $registro->deleted_at = now();
            $registro->save();

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
