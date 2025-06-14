<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function crear(Request $request)
    {
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:users,name',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
            ], [
                'name.required' => 'El nombre es obligatorio',
                'name.string' => 'El nombre debe ser texto',
                'name.max' => 'El nombre no puede tener más de 255 caracteres',
                'name.unique' => 'Este nombre de usuario ya está registrado',
                'email.required' => 'El correo electrónico es obligatorio',
                'email.string' => 'El correo electrónico debe ser texto',
                'email.email' => 'El correo electrónico debe ser válido',
                'email.max' => 'El correo electrónico no puede tener más de 255 caracteres',
                'email.unique' => 'Este correo electrónico ya está registrado',
                'password.required' => 'La contraseña es obligatoria',
                'password.string' => 'La contraseña debe ser texto',
                'password.min' => 'La contraseña debe tener al menos 8 caracteres'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            } else {
                // Create the user
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Usuario creado exitosamente'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

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
        if ($request->filled('search_id')) {
            $search = $request->search_id;
            $query->where('id', $search);
        }

        // Aplicar filtro de fecha
        if ($request->filled('search_registration_date')) {
            $date = $request->search_registration_date;
            $query->whereDate('created_at', $date);
        }

        // Ordenar por fecha de creación descendente
        $query->select(['id', 'name', 'email', 'created_at'])->orderBy('created_at', 'desc');

        // Paginar resultados
        $registros = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.tabla-contenido', compact('registros'))->render();
            $pagination = view('administracion.partials.pagination', compact('registros'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$registros->firstItem()} - {$registros->lastItem()} de {$registros->total()} usuarios"
            ]);
        }

        return view('administracion.usuarios', compact('registros'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Usuario actualizado exitosamente',
                    'user' => $user
                ]);
            }

            return redirect()->back()->with('success', 'Usuario actualizado exitosamente');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Error al actualizar el usuario',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Error al actualizar el usuario');
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            if (request()->ajax()) {
                return response()->json([
                    'message' => 'Usuario eliminado exitosamente'
                ]);
            }

            return redirect()->back()->with('success', 'Usuario eliminado exitosamente');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'message' => 'Error al eliminar el usuario',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Error al eliminar el usuario');
        }
    }
}
