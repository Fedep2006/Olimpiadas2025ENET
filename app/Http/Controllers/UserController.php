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
            }

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
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // Aplicar filtro de fecha
        if ($request->filled('registration_date')) {
            $query->whereDate('created_at', $request->registration_date);
        }

        // Ordenar por fecha de creación descendente
        $query->orderBy('created_at', 'desc');

        // Paginar resultados
        $users = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {
            $view = view('administracion.partials.users-table', compact('users'))->render();
            $pagination = view('administracion.partials.pagination', compact('users'))->render();

            return response()->json([
                'view' => $view,
                'pagination' => $pagination,
                'paginationInfo' => "Mostrando {$users->firstItem()} - {$users->lastItem()} de {$users->total()} usuarios"
            ]);
        }

        return view('administracion.usuarios', compact('users'));
    }
}
