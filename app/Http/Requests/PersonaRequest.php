<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $personaId = $this->route('persona') ? $this->route('persona')->id : null;

        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'apellido' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'dni' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9A-Za-z\-\.]+$/',
                Rule::unique('personas', 'dni')->ignore($personaId)
            ],
            'fecha_nacimiento' => [
                'required',
                'date',
                'before:today',
                'after:1900-01-01'
            ],
            'nacionalidad' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'
            ],
            'direccion' => [
                'nullable',
                'string',
                'max:255'
            ],
            'ciudad' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\.]+$/'
            ],
            'pais' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\.]+$/'
            ],
            'telefono' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[\+]?[0-9\s\-\(\)]+$/'
            ]
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',

            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser texto.',
            'apellido.max' => 'El apellido no puede exceder los 255 caracteres.',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios.',

            'dni.required' => 'El DNI es obligatorio.',
            'dni.string' => 'El DNI debe ser texto.',
            'dni.max' => 'El DNI no puede exceder los 20 caracteres.',
            'dni.unique' => 'Este DNI ya está registrado en el sistema.',
            'dni.regex' => 'El DNI tiene un formato inválido.',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'fecha_nacimiento.after' => 'La fecha de nacimiento debe ser posterior a 1900.',

            'nacionalidad.required' => 'La nacionalidad es obligatoria.',
            'nacionalidad.string' => 'La nacionalidad debe ser texto.',
            'nacionalidad.max' => 'La nacionalidad no puede exceder los 255 caracteres.',
            'nacionalidad.regex' => 'La nacionalidad solo puede contener letras y espacios.',

            'direccion.string' => 'La dirección debe ser texto.',
            'direccion.max' => 'La dirección no puede exceder los 255 caracteres.',

            'ciudad.string' => 'La ciudad debe ser texto.',
            'ciudad.max' => 'La ciudad no puede exceder los 255 caracteres.',
            'ciudad.regex' => 'La ciudad solo puede contener letras, espacios, guiones y puntos.',

            'pais.string' => 'El país debe ser texto.',
            'pais.max' => 'El país no puede exceder los 255 caracteres.',
            'pais.regex' => 'El país solo puede contener letras, espacios, guiones y puntos.',

            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede exceder los 20 caracteres.',
            'telefono.regex' => 'El formato del teléfono es inválido.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'apellido' => 'apellido',
            'dni' => 'DNI',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'nacionalidad' => 'nacionalidad',
            'direccion' => 'dirección',
            'ciudad' => 'ciudad',
            'pais' => 'país',
            'telefono' => 'teléfono',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Limpiar y normalizar datos antes de la validación
        $this->merge([
            'nombre' => trim($this->nombre ?? ''),
            'apellido' => trim($this->apellido ?? ''),
            'dni' => trim($this->dni ?? ''),
            'nacionalidad' => trim($this->nacionalidad ?? ''),
            'direccion' => $this->direccion ? trim($this->direccion) : null,
            'ciudad' => $this->ciudad ? trim($this->ciudad) : null,
            'pais' => $this->pais ? trim($this->pais) : null,
            'telefono' => $this->telefono ? trim($this->telefono) : null,
        ]);
    }
}
