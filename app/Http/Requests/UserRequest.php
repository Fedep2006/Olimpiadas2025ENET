<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\AutorizarEmpleado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    use AutorizarEmpleado;

    public function authorize(): bool
    {
        $usuarioObjetivo = $this->route('user');

        // Si está creando, permitir si es nivel >= 1
        if ($this->isMethod('post')) {
            return $this->autorizarEmpleado();
        }

        // Si está editando o borrando, permitir solo si su nivel es mayor al del objetivo
        if ($usuarioObjetivo) {
            return Auth::user()->nivel > $usuarioObjetivo->nivel;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')?->id ?? null; // Soporta validación para update

        if ($this->isMethod('post')) {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:6'],
                'nivel' => ['required', 'in:0,1,2'],
            ];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', "unique:users,email,{$userId}"],
                'nivel' => ['required', 'in:0,1,2'],
            ];
        }

        if ($this->isMethod('delete')) {
            // No hay campos, pero se puede usar el request para autorizar
            return [];
        }
        return [];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Este correo ya está en uso.',
            'nivel.in' => 'El nivel debe ser 0 (cliente), 1 (empleado) o 2 (superAdmin).',
        ];
    }
}
