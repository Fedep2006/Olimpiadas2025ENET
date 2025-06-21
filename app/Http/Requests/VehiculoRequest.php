<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehiculoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $vehiculoId = $this->route('vehiculo') ? $this->route('vehiculo')->id : null;

        return [
            'tipo' => [
                'required',
                'string',
                Rule::in(['auto', 'camioneta', 'moto', 'bicicleta'])
            ],
            'marca' => [
                'required',
                'string',
                'max:255',
                'min:2'
            ],
            'modelo' => [
                'required',
                'string',
                'max:255',
                'min:2'
            ],
            'antiguedad' => [
                'required',
                'string',
                'max:255',
                'regex:/^\d{4}$/' // Valida que sea un año de 4 dígitos
            ],
            'patente' => [
                'required',
                'string',
                'max:10',
                'min:6',
                'regex:/^[A-Za-z0-9\-\s]+$/', // Permite letras, números, guiones y espacios
                Rule::unique('vehiculos', 'patente')->ignore($vehiculoId)
            ],
            'color' => [
                'required',
                'string',
                'max:255',
                'min:3'
            ],
            'capacidad_pasajeros' => [
                'required',
                'integer',
                'min:1',
                'max:50'
            ],
            'pais' => [
                'required',
                'string',
                'max:255',
                'min:2'
            ],
            'ubicacion' => [
                'required',
                'string',
                'max:255',
                'min:5'
            ],
            'precio_por_dia' => [
                'required',
                'numeric',
                'min:0.01',
                'max:99999999.99',
                'decimal:0,2'
            ],
            'disponible' => [
                'required',
                'boolean'
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:2000'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'tipo.required' => 'El tipo de vehículo es obligatorio.',
            'tipo.in' => 'El tipo de vehículo debe ser: auto, camioneta, moto o bicicleta.',

            'marca.required' => 'La marca del vehículo es obligatoria.',
            'marca.min' => 'La marca debe tener al menos 2 caracteres.',
            'marca.max' => 'La marca no puede exceder los 255 caracteres.',

            'modelo.required' => 'El modelo del vehículo es obligatorio.',
            'modelo.min' => 'El modelo debe tener al menos 2 caracteres.',
            'modelo.max' => 'El modelo no puede exceder los 255 caracteres.',

            'antiguedad.required' => 'El año de fabricación es obligatorio.',
            'antiguedad.regex' => 'El año debe tener formato YYYY (4 dígitos).',

            'patente.required' => 'La patente del vehículo es obligatoria.',
            'patente.unique' => 'Esta patente ya está registrada en el sistema.',
            'patente.min' => 'La patente debe tener al menos 6 caracteres.',
            'patente.max' => 'La patente no puede exceder los 10 caracteres.',
            'patente.regex' => 'La patente solo puede contener letras, números, guiones y espacios.',

            'color.required' => 'El color del vehículo es obligatorio.',
            'color.min' => 'El color debe tener al menos 3 caracteres.',
            'color.max' => 'El color no puede exceder los 255 caracteres.',

            'capacidad_pasajeros.required' => 'La capacidad de pasajeros es obligatoria.',
            'capacidad_pasajeros.integer' => 'La capacidad de pasajeros debe ser un número entero.',
            'capacidad_pasajeros.min' => 'La capacidad mínima es de 1 pasajero.',
            'capacidad_pasajeros.max' => 'La capacidad máxima es de 50 pasajeros.',

            'pais.required' => 'El país es obligatorio.',
            'pais.min' => 'El país debe tener al menos 2 caracteres.',
            'pais.max' => 'El país no puede exceder los 255 caracteres.',

            'ubicacion.required' => 'La ubicación es obligatoria.',
            'ubicacion.min' => 'La ubicación debe tener al menos 5 caracteres.',
            'ubicacion.max' => 'La ubicación no puede exceder los 255 caracteres.',

            'precio_por_dia.required' => 'El precio por día es obligatorio.',
            'precio_por_dia.numeric' => 'El precio debe ser un valor numérico.',
            'precio_por_dia.min' => 'El precio mínimo es de 0.01.',
            'precio_por_dia.max' => 'El precio máximo es de 99,999,999.99.',
            'precio_por_dia.decimal' => 'El precio puede tener máximo 2 decimales.',

            'disponible.required' => 'El estado de disponibilidad es obligatorio.',
            'disponible.boolean' => 'El estado de disponibilidad debe ser verdadero o falso.',

            'descripcion.max' => 'La descripción no puede exceder los 2000 caracteres.'
        ];
    }

    public function attributes(): array
    {
        return [
            'tipo' => 'tipo de vehículo',
            'marca' => 'marca',
            'modelo' => 'modelo',
            'antiguedad' => 'año de fabricación',
            'patente' => 'patente',
            'color' => 'color',
            'capacidad_pasajeros' => 'capacidad de pasajeros',
            'pais' => 'país',
            'ubicacion' => 'ubicación',
            'precio_por_dia' => 'precio por día',
            'disponible' => 'disponibilidad',
            'descripcion' => 'descripción'
        ];
    }
    protected function prepareForValidation(): void
    {

        // Limpiar espacios en blanco
        $this->merge([
            'tipo' => trim($this->tipo ?? ''),
            'marca' => trim($this->marca ?? ''),
            'modelo' => trim($this->modelo ?? ''),
            'color' => trim($this->color ?? ''),
            'pais' => trim($this->pais ?? ''),
            'ubicacion' => trim($this->ubicacion ?? ''),
            'descripcion' => trim($this->descripcion ?? ''),
        ]);

        // Convierte precio_base a un numero
        if ($this->has('precio_base')) {
            $this->merge([
                'precio_base' => number_format((float)$this->precio_base, 2, '.', '')
            ]);
        }
    }
}
