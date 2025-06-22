<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HospedajeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'empresa_id' => 'required|integer|exists:empresas,id',
            'tipo' => 'required|in:hotel,hostal,apartamento,casa,cabaña,resort',
            'habitacion' => 'required|in:individual,doble,triple,cuadruple,suite,familiar',
            'habitaciones_disponibles' => 'required|integer|min:1',
            'capacidad_personas' => 'required|integer|min:1',
            'precio_por_noche' => 'required|numeric|min:0|max:99999999.99',
            'ubicacion' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'estrellas' => 'nullable|integer|min:1|max:5',
            'descripcion' => 'nullable|string',
            'telefono' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'sitio_web' => 'nullable|url|max:255',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'calificacion' => 'nullable|numeric|min:0|max:5|decimal:0,2',
            'activo' => 'boolean',
            'condiciones' => 'required|string',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $hospedajeId = $this->route('hospedaje') ? $this->route('hospedaje')->id : $this->route('id');
            if ($this->filled('email')) {
                $rules['email'] .= '|unique:hospedajes,email,' . $hospedajeId;
            }
            if ($this->filled('empresa_id')) {
                $rules['empresa_id'] .= '|unique:hospedajes,empresa_id,' . $hospedajeId;
            }
        } else {

            if ($this->filled('email')) {
                $rules['email'] .= '|unique:hospedajes,email';
            }

            if ($this->filled('empresa_id')) {
                $rules['empresa_id'] .= '|unique:hospedajes,empresa_id';
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del establecimiento es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'empresa_id.required' => 'Debe seleccionar una empresa.',
            'empresa_id.exists' => 'La empresa seleccionada no existe.',

            'tipo.required' => 'Debe seleccionar un tipo de establecimiento.',
            'tipo.in' => 'El tipo de establecimiento debe ser: hotel, hostal, apartamento, casa, cabaña o resort.',

            'habitacion.required' => 'Debe seleccionar un tipo de habitación.',
            'habitacion.in' => 'El tipo de habitación debe ser: individual, doble, triple, cuadruple, suite o familiar.',

            'habitaciones_disponibles.required' => 'El número de habitaciones disponibles es obligatorio.',
            'habitaciones_disponibles.integer' => 'El número de habitaciones debe ser un número entero.',
            'habitaciones_disponibles.min' => 'Debe haber al menos 1 habitación disponible.',

            'capacidad_personas.required' => 'La capacidad de personas es obligatoria.',
            'capacidad_personas.integer' => 'La capacidad debe ser un número entero.',
            'capacidad_personas.min' => 'La capacidad mínima es de 1 persona.',

            'precio_por_noche.required' => 'El precio por noche es obligatorio.',
            'precio_por_noche.numeric' => 'El precio debe ser un número válido.',
            'precio_por_noche.min' => 'El precio no puede ser negativo.',
            'precio_por_noche.max' => 'El precio excede el límite permitido.',

            'ubicacion.required' => 'La ubicación es obligatoria.',
            'ubicacion.string' => 'La ubicación debe ser una cadena de texto.',
            'ubicacion.max' => 'La ubicación no puede tener más de 255 caracteres.',

            'pais.required' => 'El país es obligatorio.',
            'pais.string' => 'El país debe ser una cadena de texto.',
            'pais.max' => 'El país no puede tener más de 255 caracteres.',

            'ciudad.required' => 'La ciudad es obligatoria.',
            'ciudad.string' => 'La ciudad debe ser una cadena de texto.',
            'ciudad.max' => 'La ciudad no puede tener más de 255 caracteres.',

            'estrellas.integer' => 'Las estrellas deben ser un número entero.',
            'estrellas.min' => 'La clasificación mínima es de 1 estrella.',
            'estrellas.max' => 'La clasificación máxima es de 5 estrellas.',

            'descripcion.string' => 'La descripción debe ser una cadena de texto.',

            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no puede tener más de 255 caracteres.',

            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'sitio_web.url' => 'El sitio web debe ser una URL válida.',
            'sitio_web.max' => 'El sitio web no puede tener más de 255 caracteres.',

            'check_in.date_format' => 'La hora de check-in debe tener el formato HH:MM.',
            'check_out.date_format' => 'La hora de check-out debe tener el formato HH:MM.',

            'calificacion.numeric' => 'La calificación debe ser un número válido.',
            'calificacion.min' => 'La calificación mínima es 0.',
            'calificacion.max' => 'La calificación máxima es 5.',
            'calificacion.decimal' => 'La calificación puede tener máximo 2 decimales.',

            'activo.boolean' => 'El estado activo debe ser verdadero o falso.',

            'condiciones.required' => 'Las condiciones del hospedaje son obligatorias.',
            'condiciones.string' => 'Las condiciones deben ser una cadena de texto.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre del establecimiento',
            'empresa_id' => 'empresa',
            'tipo' => 'tipo de establecimiento',
            'habitacion' => 'tipo de habitación',
            'habitaciones_disponibles' => 'habitaciones disponibles',
            'capacidad_personas' => 'capacidad de personas',
            'precio_por_noche' => 'precio por noche',
            'ubicacion' => 'ubicación',
            'pais' => 'país',
            'ciudad' => 'ciudad',
            'estrellas' => 'clasificación por estrellas',
            'descripcion' => 'descripción',
            'telefono' => 'teléfono',
            'email' => 'correo electrónico',
            'sitio_web' => 'sitio web',
            'check_in' => 'hora de check-in',
            'check_out' => 'hora de check-out',
            'calificacion' => 'calificación',
            'activo' => 'estado activo',
            'condiciones' => 'condiciones',
        ];
    }


    protected function prepareForValidation(): void
    {
        $this->merge([
            'nombre' => trim($this->nombre ?? ''),
            'ubicacion' => trim($this->ubicacion ?? ''),
            'pais' => trim($this->pais ?? ''),
            'ciudad' => trim($this->ciudad ?? ''),
            'descripcion' => trim($this->descripcion ?? ''),
            'condiciones' => trim($this->condiciones ?? ''),
            'email' => $this->email ? trim($this->email) : null,
            'sitio_web' => $this->sitio_web ? trim($this->sitio_web) : null,
            'telefono' => $this->telefono ? trim($this->telefono) : null,
        ]);
        if ($this->has('empresa_id')) {
            $this->merge([
                'empresa_id' => number_format((int)$this->empresa_id)
            ]);
        }
    }
}
