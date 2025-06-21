<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class ServicioReservadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'reserva_id' => [
                'required',
                'integer',
                'exists:reservas,id'
            ],
            'servicio_id' => [
                'required',
                'integer',
                'exists:servicios,id'
            ],
        ];

        if ($this->isMethod('post')) {
            $rules['reserva_id'][] = function ($attribute, $value, $fail) {
                $exists = DB::table('reservas_servicios')
                    ->where('reserva_id', $value)
                    ->where('servicio_id', $this->servicio_id)
                    ->exists();

                if ($exists) {
                    $fail('Esta combinación de reserva y servicio ya existe.');
                }
            };
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $reservaServicioId = $this->route('reserva_servicio') ?? $this->route('id');

            $rules['reserva_id'][] = function ($attribute, $value, $fail) use ($reservaServicioId) {
                $exists = DB::table('reservas_servicios')
                    ->where('reserva_id', $value)
                    ->where('servicio_id', $this->servicio_id)
                    ->where('id', '!=', $reservaServicioId)
                    ->exists();

                if ($exists) {
                    $fail('Esta combinación de reserva y servicio ya existe.');
                }
            };
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'reserva_id.required' => 'La reserva es obligatoria.',
            'reserva_id.integer' => 'La reserva debe ser un número válido.',
            'reserva_id.exists' => 'La reserva seleccionada no existe.',

            'servicio_id.required' => 'El servicio es obligatorio.',
            'servicio_id.integer' => 'El servicio debe ser un número válido.',
            'servicio_id.exists' => 'El servicio seleccionado no existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'reserva_id' => 'reserva',
            'servicio_id' => 'servicio',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422)
            );
        }

        parent::failedValidation($validator);
    }
}
