<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        $usuarioObjetivo = $this->route('user');

        if ($usuarioObjetivo) {
            return Auth::user()->nivel > $usuarioObjetivo->nivel;
        }

        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('DELETE')) {
            return [];
        }

        $isCreating = $this->isMethod('POST');
        $isUpdating = $this->isMethod('PUT') || $this->isMethod('PATCH');

        // Reglas base para ambos casos
        $rules = [
            'name' => ['required', 'string', 'max:255', 'min:2'],
            'email' => [
                'required',
                'email',
                'max:255',
                $isUpdating
                    ? Rule::unique('users', 'email')->ignore($this->route('user'))
                    : 'unique:users,email'
            ],
            'nivel' => ['required', 'integer', 'in:0,1,2'],
        ];


        // Password solo requerido en creación
        if ($isCreating) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
            $rules['password_confirmation'] = ['required', 'string', 'min:8'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Debe proporcionar un email válido.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'nivel.required' => 'El nivel de usuario es obligatorio.',
            'nivel.in' => 'El nivel debe ser 0 (usuario), 1 (moderador) o 2 (admin).',
        ];
    }
    protected function prepareForValidation(): void
    {
        // Limpiar email de espacios
        if ($this->has('email')) {
            $this->merge([
                'email' => Str::lower(trim($this->email))
            ]);
        }

        // Limpiar nombre
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name)
            ]);
        }

        // Convertir nivel a integer
        if ($this->has('nivel')) {
            $this->merge([
                'nivel' => (int) $this->nivel
            ]);
        }
    }
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        // Si hay password y password_confirmation, y son iguales, remover confirmation
        if (isset($validated['password']) && isset($validated['password_confirmation'])) {
            if ($validated['password'] === $validated['password_confirmation']) {
                unset($validated['password_confirmation']);
            }
        }

        // Si password está vacío en actualización, removerlo completamente
        if (($this->isMethod('PUT') || $this->isMethod('PATCH')) &&
            isset($validated['password']) && empty($validated['password'])
        ) {
            unset($validated['password']);
        }

        return $key ? data_get($validated, $key, $default) : $validated;
    }
}
