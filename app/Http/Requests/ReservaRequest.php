<?php

namespace App\Http\Requests;

use App\Models\Reserva;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ReservaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'usuario_id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'paquete_id' => [
                'required',
                'integer',
                'exists:paquetes,id'
            ],
            'fecha_inicio' => [
                'required',
                'date',
                'after:now'
            ],
            'fecha_fin' => [
                'required',
                'date',
                'after:fecha_inicio'
            ],
            'estado' => [
                'sometimes',
                'string',
                Rule::in(['pendiente', 'confirmada', 'cancelada', 'completada'])
            ],
            'precio_total' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99'
            ],
            'codigo_reserva' => [
                'sometimes',
                'string',
                'size:8',
                'alpha_num'
            ]
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $reservaId = $this->route('reserva') ? $this->route('reserva')->id : $this->route('id');

            if (isset($rules['codigo_reserva'])) {
                $rules['codigo_reserva'][] = Rule::unique('reservas', 'codigo_reserva')->ignore($reservaId);
            }

            $rules['usuario_id'] = array_merge(['sometimes'], $rules['usuario_id']);
            $rules['paquete_id'] = array_merge(['sometimes'], $rules['paquete_id']);
            $rules['fecha_inicio'] = array_merge(['sometimes'], $rules['fecha_inicio']);
            $rules['fecha_fin'] = array_merge(['sometimes'], $rules['fecha_fin']);
            $rules['precio_total'] = array_merge(['sometimes'], $rules['precio_total']);
        } else {

            if (isset($rules['codigo_reserva'])) {
                $rules['codigo_reserva'][] = Rule::unique('reservas', 'codigo_reserva');
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'usuario_id.required' => 'El usuario es obligatorio.',
            'usuario_id.exists' => 'El usuario seleccionado no existe.',
            'paquete_id.required' => 'El paquete es obligatorio.',
            'paquete_id.exists' => 'El paquete seleccionado no existe.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.after' => 'La fecha de inicio debe ser posterior a la fecha actual.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'estado.in' => 'El estado debe ser: pendiente, confirmada, cancelada o completada.',
            'precio_total.required' => 'El precio total es obligatorio.',
            'precio_total.numeric' => 'El precio total debe ser un número.',
            'precio_total.min' => 'El precio total no puede ser negativo.',
            'precio_total.max' => 'El precio total excede el límite máximo.',
            'codigo_reserva.size' => 'El código de reserva debe tener exactamente 8 caracteres.',
            'codigo_reserva.alpha_num' => 'El código de reserva solo puede contener letras y números.',
            'codigo_reserva.unique' => 'Este código de reserva ya está en uso.',
        ];
    }

    public function attributes(): array
    {
        return [
            'usuario_id' => 'usuario',
            'paquete_id' => 'paquete',
            'fecha_inicio' => 'fecha de inicio',
            'fecha_fin' => 'fecha de fin',
            'precio_total' => 'precio total',
            'codigo_reserva' => 'código de reserva',
        ];
    }

    protected function prepareForValidation(): void
    {

        if (!$this->has('codigo_reserva') && $this->isMethod('POST')) {
            $this->merge([
                'codigo_reserva' => $this->generateUniqueCode()
            ]);
        }


        if (!$this->has('estado') && $this->isMethod('POST')) {
            $this->merge([
                'estado' => 'pendiente'
            ]);
        }
    }
    private function generateUniqueCode(): string
    {
        do {
            $code = Str::upper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8));
        } while (Reserva::where('codigo_reserva', $code)->exists());

        return $code;
    }
}
