<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PersonaReservaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reserva_id' => [
                'required',
                'integer',
                'exists:reservas,id'
            ],
            'persona_id' => [
                'required',
                'integer',
                'exists:personas,id'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'reserva_id.required' => 'La reserva es obligatoria.',
            'reserva_id.integer' => 'El ID de reserva debe ser un número entero.',
            'reserva_id.exists' => 'La reserva seleccionada no existe.',

            'persona_id.required' => 'La persona es obligatoria.',
            'persona_id.integer' => 'El ID de persona debe ser un número entero.',
            'persona_id.exists' => 'La persona seleccionada no existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'reserva_id' => 'reserva',
            'persona_id' => 'persona',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Personaliza la respuesta de error si es necesario
        parent::failedValidation($validator);
    }
}
