<?php

namespace App\Http\Requests;

use App\Models\Hospedaje;
use App\Models\Vehiculo;
use App\Models\Viaje;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PaqueteContenidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'paquete_id' => [
                'required',
                'integer',
                'exists:paquetes,id'
            ],
            'contenido_type' => [
                'required',
                'string',
                Rule::in([
                    Viaje::class,
                    Hospedaje::class,
                    Vehiculo::class
                ])
            ],
            'contenido_id' => [
                'required',
                'integer',
                'min:1'
            ]
        ];

        if ($this->contenido_type) {
            switch ($this->contenido_type) {
                case Viaje::class:
                    $rules['contenido_id'][] = 'exists:viajes,id';
                    break;
                case Hospedaje::class:
                    $rules['contenido_id'][] = 'exists:hospedajes,id';
                    break;
                case Vehiculo::class:
                    $rules['contenido_id'][] = 'exists:vehiculos,id';
                    break;
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'paquete_id.required' => 'El paquete es obligatorio.',
            'paquete_id.exists' => 'El paquete seleccionado no existe.',
            'contenido_type.required' => 'El tipo de contenido es obligatorio.',
            'contenido_type.in' => 'El tipo de contenido debe ser válido.',
            'contenido_id.required' => 'El contenido es obligatorio.',
            'contenido_id.integer' => 'El ID del contenido debe ser un número.',
            'contenido_id.min' => 'El ID del contenido debe ser mayor a 0.',
            'contenido_id.exists' => 'El contenido seleccionado no existe en la tabla correspondiente.'
        ];
    }

    public function attributes(): array
    {
        return [
            'paquete_id' => 'paquete',
            'contenido_type' => 'tipo de contenido',
            'contenido_id' => 'contenido'
        ];
    }

    protected function prepareForValidation(): void
    {

        if ($this->has('tipo_contenido')) {
            $tipoCompleto = match ($this->tipo_contenido) {
                'viaje' => Viaje::class,
                'hospedaje' => Hospedaje::class,
                'vehiculo' => Vehiculo::class,
                default => $this->tipo_contenido
            };

            $this->merge([
                'contenido_type' => $tipoCompleto
            ]);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Los datos proporcionados no son válidos.',
                    'errors' => $validator->errors()
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}
