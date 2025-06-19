<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Requests\Traits\AutorizarEmpleado;


class ViajeRequest extends FormRequest
{
    use AutorizarEmpleado;

    public function authorize(): bool
    {
        return $this->autorizarEmpleado();
    }

    public function rules(): array
    {
        if ($this->isMethod('DELETE')) {
            return [];
        }
        $isUpdating = $this->isMethod('PUT') || $this->isMethod('PATCH');
        $viajeId = $this->route('viaje');

        $rules = [
            'nombre' => ['required', 'string', 'max:255', 'min:3'],
            'tipo' => ['required', Rule::in(['bus', 'avion', 'tren', 'crucero'])],
            'origen' => ['required', 'string', 'max:255', 'min:2'],
            'destino' => ['required', 'string', 'max:255', 'min:2', 'different:origen'],
            'empresa' => ['required', 'string', 'max:255', 'min:2'],
            'numero_viaje' => [
                'required',
                'string',
                'max:255',
                $isUpdating
                    ? Rule::unique('viajes', 'numero_viaje')->ignore($viajeId)
                    : 'unique:viajes,numero_viaje'
            ],
            'capacidad_total' => ['required', 'integer', 'min:1', 'max:1000'],
            'asientos_disponibles' => ['required', 'integer', 'min:0', 'lte:capacidad_total'],
            'precio_base' => ['required', 'numeric', 'min:0.01', 'max:999999.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'clases' => ['required', Rule::in(['economica', 'business', 'primera'])],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'activo' => ['sometimes', 'boolean']
        ];

        // Validación de fechas diferente para crear vs editar
        if ($isUpdating) {
            // En edición, permitir fechas pasadas pero validar lógica
            $rules['fecha_salida'] = ['required', 'date'];
            $rules['fecha_llegada'] = ['required', 'date', 'after:fecha_salida'];
        } else {
            // En creación, fecha debe ser futura
            $rules['fecha_salida'] = ['required', 'date', 'after:now'];
            $rules['fecha_llegada'] = ['required', 'date', 'after:fecha_salida'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            // Nombre
            'nombre.required' => 'El nombre del viaje es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',

            // Tipo
            'tipo.required' => 'El tipo de transporte es obligatorio.',
            'tipo.in' => 'El tipo de transporte debe ser: bus, avión, tren o crucero.',

            // Origen
            'origen.required' => 'El lugar de origen es obligatorio.',
            'origen.string' => 'El origen debe ser una cadena de texto.',
            'origen.max' => 'El origen no puede exceder los 255 caracteres.',
            'origen.min' => 'El origen debe tener al menos 2 caracteres.',

            // Destino
            'destino.required' => 'El lugar de destino es obligatorio.',
            'destino.string' => 'El destino debe ser una cadena de texto.',
            'destino.max' => 'El destino no puede exceder los 255 caracteres.',
            'destino.min' => 'El destino debe tener al menos 2 caracteres.',
            'destino.different' => 'El destino debe ser diferente al origen.',

            // Fechas
            'fecha_salida.required' => 'La fecha de salida es obligatoria.',
            'fecha_salida.date' => 'La fecha de salida debe ser una fecha válida.',
            'fecha_salida.after' => 'La fecha de salida debe ser posterior a la fecha actual.',

            'fecha_llegada.required' => 'La fecha de llegada es obligatoria.',
            'fecha_llegada.date' => 'La fecha de llegada debe ser una fecha válida.',
            'fecha_llegada.after' => 'La fecha de llegada debe ser posterior a la fecha de salida.',

            // Empresa
            'empresa.required' => 'El nombre de la empresa es obligatorio.',
            'empresa.string' => 'La empresa debe ser una cadena de texto.',
            'empresa.max' => 'El nombre de la empresa no puede exceder los 255 caracteres.',
            'empresa.min' => 'El nombre de la empresa debe tener al menos 2 caracteres.',

            // Número de viaje
            'numero_viaje.required' => 'El número de viaje es obligatorio.',
            'numero_viaje.string' => 'El número de viaje debe ser una cadena de texto.',
            'numero_viaje.max' => 'El número de viaje no puede exceder los 255 caracteres.',
            'numero_viaje.unique' => 'Este número de viaje ya está registrado.',

            // Capacidad
            'capacidad_total.required' => 'La capacidad total es obligatoria.',
            'capacidad_total.integer' => 'La capacidad total debe ser un número entero.',
            'capacidad_total.min' => 'La capacidad total debe ser al menos 1.',
            'capacidad_total.max' => 'La capacidad total no puede exceder 1000 pasajeros.',

            // Asientos disponibles
            'asientos_disponibles.required' => 'Los asientos disponibles son obligatorios.',
            'asientos_disponibles.integer' => 'Los asientos disponibles deben ser un número entero.',
            'asientos_disponibles.min' => 'Los asientos disponibles no pueden ser negativos.',
            'asientos_disponibles.lte' => 'Los asientos disponibles no pueden exceder la capacidad total.',

            // Precio
            'precio_base.required' => 'El precio base es obligatorio.',
            'precio_base.numeric' => 'El precio base debe ser un número.',
            'precio_base.min' => 'El precio base debe ser mayor a 0.',
            'precio_base.max' => 'El precio base no puede exceder 999,999.99.',
            'precio_base.regex' => 'El precio base debe tener máximo 2 decimales.',

            // Clases
            'clases.required' => 'La clase es obligatoria.',
            'clases.in' => 'La clase debe ser: económica, business o primera.',

            // Descripción
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los 1000 caracteres.',

            // Activo
            'activo.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre del viaje',
            'tipo' => 'tipo de transporte',
            'origen' => 'lugar de origen',
            'destino' => 'lugar de destino',
            'fecha_salida' => 'fecha de salida',
            'fecha_llegada' => 'fecha de llegada',
            'empresa' => 'empresa',
            'numero_viaje' => 'número de viaje',
            'capacidad_total' => 'capacidad total',
            'asientos_disponibles' => 'asientos disponibles',
            'precio_base' => 'precio base',
            'clases' => 'clase',
            'descripcion' => 'descripción',
            'activo' => 'estado activo',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Convertir el checkbox 'activo' a boolean si viene como string
        if ($this->has('activo')) {
            $this->merge([
                'activo' => $this->boolean('activo')
            ]);
        }

        // Si no viene el campo activo, establecer como true por defecto
        if (!$this->has('activo')) {
            $this->merge([
                'activo' => true
            ]);
        }

        // Convierte precio_base a un numero
        if ($this->has('precio_base')) {
            $this->merge([
                'precio_base' => number_format((float)$this->precio_base, 2, '.', '')
            ]);
        }
    }
}
