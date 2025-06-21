<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ViajeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('DELETE')) {
            return [];
        }
        $rules = [
            'empresa_id' => [
                'required',
                'integer',
                'exists:empresas,id',
                Rule::exists('empresas', 'id')->where(function ($query) {
                    $query->where('tipo', 'viajes');
                }),
            ],
            'nombre' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
            'tipo' => [
                'required',
                'string',
                Rule::in(['bus', 'avion', 'tren', 'crucero']),
            ],
            'origen' => [
                'required',
                'string',
                'max:255',
                'min:2',
            ],
            'destino' => [
                'required',
                'string',
                'max:255',
                'min:2',
                'different:origen',
            ],
            'fecha_salida' => [
                'required',
                'date',
                'after:now',
            ],
            'fecha_llegada' => [
                'required',
                'date',
                'after:fecha_salida',
            ],
            'numero_viaje' => [
                'required',
                'string',
                'max:255',
                Rule::unique('viajes', 'numero_viaje')->ignore($this->route('viaje')),
            ],
            'capacidad_total' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],
            'asientos_disponibles' => [
                'required',
                'integer',
                'min:0',
                'lte:capacidad_total',
            ],
            'precio_base' => [
                'required',
                'numeric',
                'min:0.01',
                'max:999999.99',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
            'descripcion' => [
                'nullable',
                'string',
                'max:2000',
            ],
            'activo' => [
                'boolean',
            ],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            // Empresa
            'empresa_id.required' => 'La empresa es obligatoria.',
            'empresa_id.exists' => 'La empresa seleccionada no es válida o no maneja viajes.',

            // Nombre
            'nombre.required' => 'El nombre del viaje es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',

            // Tipo
            'tipo.required' => 'El tipo de viaje es obligatorio.',
            'tipo.in' => 'El tipo de viaje debe ser: bus, avión, tren o crucero.',

            // Origen y Destino
            'origen.required' => 'La ciudad de origen es obligatoria.',
            'origen.min' => 'El origen debe tener al menos 2 caracteres.',
            'destino.required' => 'La ciudad de destino es obligatoria.',
            'destino.min' => 'El destino debe tener al menos 2 caracteres.',
            'destino.different' => 'El destino debe ser diferente al origen.',

            // Fechas
            'fecha_salida.required' => 'La fecha de salida es obligatoria.',
            'fecha_salida.after' => 'La fecha de salida debe ser posterior a la fecha actual.',
            'fecha_llegada.required' => 'La fecha de llegada es obligatoria.',
            'fecha_llegada.after' => 'La fecha de llegada debe ser posterior a la fecha de salida.',

            // Número de viaje
            'numero_viaje.required' => 'El número de viaje es obligatorio.',
            'numero_viaje.unique' => 'Este número de viaje ya existe.',

            // Capacidad
            'capacidad_total.required' => 'La capacidad total es obligatoria.',
            'capacidad_total.min' => 'La capacidad debe ser al menos 1 pasajero.',
            'capacidad_total.max' => 'La capacidad no puede exceder los 1000 pasajeros.',

            // Asientos disponibles
            'asientos_disponibles.required' => 'Los asientos disponibles son obligatorios.',
            'asientos_disponibles.min' => 'Los asientos disponibles no pueden ser negativos.',
            'asientos_disponibles.lte' => 'Los asientos disponibles no pueden ser mayores que la capacidad total.',

            // Precio
            'precio_base.required' => 'El precio base es obligatorio.',
            'precio_base.min' => 'El precio debe ser mayor a 0.',
            'precio_base.max' => 'El precio no puede exceder los $999,999.99.',
            'precio_base.regex' => 'El precio debe tener máximo 2 decimales.',

            // Descripción
            'descripcion.max' => 'La descripción no puede exceder los 2000 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'empresa_id' => 'empresa',
            'numero_viaje' => 'número de viaje',
            'capacidad_total' => 'capacidad total',
            'asientos_disponibles' => 'asientos disponibles',
            'precio_base' => 'precio base',
            'fecha_salida' => 'fecha de salida',
            'fecha_llegada' => 'fecha de llegada',
        ];
    }

    protected function prepareForValidation(): void
    {

        // Limpiar espacios en blanco
        $this->merge([
            'nombre' => trim($this->nombre ?? ''),
            'origen' => trim($this->origen ?? ''),
            'destino' => trim($this->destino ?? ''),
            'numero_viaje' => trim($this->numero_viaje ?? ''),
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
