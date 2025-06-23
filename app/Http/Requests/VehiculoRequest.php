<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class VehiculoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $vehiculoId = $this->route('vehiculo')?->id;

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
                'max:255'
            ],
            'patente' => [
                'required',
                'string',
                'max:10',
                'min:4',
                'regex:/^[A-Z0-9\-\s]+$/i',
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
            'vehiculos_disponibles' => [
                'required',
                'integer',
                'min:0',
                'max:1000'
            ],
            'pais_id' => [
                'required',
                'integer',
                'exists:paises,id'
            ],
            'provincia_id' => [
                'required',
                'integer',
                'exists:provincias,id'
            ],
            'ciudad_id' => [
                'required',
                'integer',
                'exists:ciudades,id'
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
                'max:999999.99',
                'decimal:0,2'
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:2000'
            ],
            'disponible' => [
                'boolean'
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

            'antiguedad.required' => 'La antigüedad del vehículo es obligatoria.',
            'antiguedad.max' => 'La antigüedad no puede exceder los 255 caracteres.',

            'patente.required' => 'La patente del vehículo es obligatoria.',
            'patente.unique' => 'Esta patente ya está registrada en el sistema.',
            'patente.min' => 'La patente debe tener al menos 4 caracteres.',
            'patente.max' => 'La patente no puede exceder los 10 caracteres.',
            'patente.regex' => 'La patente solo puede contener letras, números, guiones y espacios.',

            'color.required' => 'El color del vehículo es obligatorio.',
            'color.min' => 'El color debe tener al menos 3 caracteres.',
            'color.max' => 'El color no puede exceder los 255 caracteres.',

            'capacidad_pasajeros.required' => 'La capacidad de pasajeros es obligatoria.',
            'capacidad_pasajeros.integer' => 'La capacidad de pasajeros debe ser un número entero.',
            'capacidad_pasajeros.min' => 'La capacidad de pasajeros debe ser al menos 1.',
            'capacidad_pasajeros.max' => 'La capacidad de pasajeros no puede exceder 50.',

            'vehiculos_disponibles.required' => 'La cantidad de vehículos disponibles es obligatoria.',
            'vehiculos_disponibles.integer' => 'La cantidad debe ser un número entero.',
            'vehiculos_disponibles.min' => 'La cantidad de vehículos disponibles no puede ser negativa.',
            'vehiculos_disponibles.max' => 'La cantidad de vehículos disponibles no puede exceder 1000.',

            'pais_id.required' => 'El país es obligatorio.',
            'pais_id.exists' => 'El país seleccionado no existe.',

            'provincia_id.required' => 'La provincia es obligatoria.',
            'provincia_id.exists' => 'La provincia seleccionada no existe.',

            'ciudad_id.required' => 'La ciudad es obligatoria.',
            'ciudad_id.exists' => 'La ciudad seleccionada no existe.',

            'ubicacion.required' => 'La ubicación del vehículo es obligatoria.',
            'ubicacion.min' => 'La ubicación debe tener al menos 5 caracteres.',
            'ubicacion.max' => 'La ubicación no puede exceder los 255 caracteres.',

            'precio_por_dia.required' => 'El precio por día es obligatorio.',
            'precio_por_dia.numeric' => 'El precio por día debe ser un número válido.',
            'precio_por_dia.min' => 'El precio por día debe ser mayor a 0.',
            'precio_por_dia.max' => 'El precio por día no puede exceder 999,999.99.',
            'precio_por_dia.decimal' => 'El precio por día puede tener máximo 2 decimales.',

            'descripcion.max' => 'La descripción no puede exceder los 2000 caracteres.',

            'disponible.boolean' => 'El campo disponible debe ser verdadero o falso.'
        ];
    }

    public function attributes(): array
    {
        return [
            'tipo' => 'tipo de vehículo',
            'marca' => 'marca',
            'modelo' => 'modelo',
            'antiguedad' => 'antigüedad',
            'patente' => 'patente',
            'color' => 'color',
            'capacidad_pasajeros' => 'capacidad de pasajeros',
            'vehiculos_disponibles' => 'vehículos disponibles',
            'pais_id' => 'país',
            'provincia_id' => 'provincia',
            'ciudad_id' => 'ciudad',
            'ubicacion' => 'ubicación',
            'precio_por_dia' => 'precio por día',
            'descripcion' => 'descripción',
            'disponible' => 'disponibilidad'
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('patente')) {
            $this->merge([
                'patente' => Str::upper(trim($this->patente))
            ]);
        }

        $textFields = ['marca', 'modelo', 'color', 'ubicacion', 'descripcion'];
        foreach ($textFields as $field) {
            if ($this->has($field)) {
                $this->merge([
                    $field => trim($this->$field)
                ]);
            }
        }
    }
}
