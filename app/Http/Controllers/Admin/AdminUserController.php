<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

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
        $query->select(['id', 'name', 'email', 'created_at', 'nivel'])->orderBy('created_at', 'desc');

        // Paginar resultados
        $registros = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.tablas.tabla-usuarios-contenido', compact('registros'))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} usuarios"
            ]);
        }

        return view('administracion.usuarios', compact('registros'));
    }

    public function create(UserRequest $request)
    {
        try {
            // Crear el usuario
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            User::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado exitosamente'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UserRequest $request, User $user)
    {

        try {
            $user->update($request->validated());

            return response()->json([
                'message' => 'Usuario actualizado exitosamente',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();


            return response()->json([
                'message' => 'Usuario eliminado exitosamente',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'message' => 'Error al eliminar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
