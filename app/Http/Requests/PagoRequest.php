<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reserva_id' => 'nullable|exists:reservas,id',
            'estado' => 'sometimes|string|in:pendiente,procesando,completado,fallido,cancelado',
            'cardholder_name' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\s]+$/',
            'card_number' => 'required|string|regex:/^\d{13,19}$/|luhn',
            'expiration_month' => 'required|string|size:2|regex:/^(0[1-9]|1[0-2])$/',
            'expiration_year' => 'required|string|size:4|regex:/^\d{4}$/|date_format:Y|after_or_equal:' . date('Y'),
            'cvv' => 'required|string|regex:/^\d{3,4}$/',
            'amount' => 'required|numeric|min:0.01|max:999999.99|decimal:0,2',
        ];
    }

    public function messages(): array
    {
        return [
            'reserva_id.exists' => 'La reserva seleccionada no existe.',
            'estado.in' => 'El estado debe ser: pendiente, procesando, completado, fallido o cancelado.',
            'cardholder_name.required' => 'El nombre del titular de la tarjeta es obligatorio.',
            'cardholder_name.regex' => 'El nombre del titular solo puede contener letras y espacios.',
            'card_number.required' => 'El número de tarjeta es obligatorio.',
            'card_number.regex' => 'El número de tarjeta debe contener entre 13 y 19 dígitos.',
            'card_number.luhn' => 'El número de tarjeta no es válido.',
            'expiration_month.required' => 'El mes de expiración es obligatorio.',
            'expiration_month.regex' => 'El mes de expiración debe ser un valor entre 01 y 12.',
            'expiration_year.required' => 'El año de expiración es obligatorio.',
            'expiration_year.regex' => 'El año de expiración debe tener 4 dígitos.',
            'expiration_year.after_or_equal' => 'La tarjeta no puede estar expirada.',
            'cvv.required' => 'El código CVV es obligatorio.',
            'cvv.regex' => 'El CVV debe contener 3 o 4 dígitos.',
            'amount.required' => 'El monto es obligatorio.',
            'amount.min' => 'El monto debe ser mayor a 0.',
            'amount.max' => 'El monto no puede superar los 999,999.99.',
            'amount.decimal' => 'El monto puede tener máximo 2 decimales.',
        ];
    }

    public function attributes(): array
    {
        return [
            'reserva_id' => 'reserva',
            'cardholder_name' => 'nombre del titular',
            'card_number' => 'número de tarjeta',
            'expiration_month' => 'mes de expiración',
            'expiration_year' => 'año de expiración',
            'cvv' => 'código CVV',
            'amount' => 'monto',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            if ($this->filled(['expiration_month', 'expiration_year'])) {
                $currentDate = now();
                $expirationDate = \Carbon\Carbon::createFromDate(
                    $this->expiration_year,
                    $this->expiration_month,
                    1
                )->endOfMonth();

                if ($expirationDate->isBefore($currentDate)) {
                    $validator->errors()->add('expiration_year', 'La tarjeta está expirada.');
                }
            }

            if ($this->filled('card_number')) {
                $cardNumber = preg_replace('/\D/', '', $this->card_number);

                // Visa: comienza con 4
                // MasterCard: comienza con 5
                // American Express: comienza con 34 o 37
                // Discover: comienza con 6
                $validPrefixes = ['4', '5', '34', '37', '6'];
                $isValidPrefix = false;

                foreach ($validPrefixes as $prefix) {
                    if (str_starts_with($cardNumber, $prefix)) {
                        $isValidPrefix = true;
                        break;
                    }
                }

                if (!$isValidPrefix) {
                    $validator->errors()->add('card_number', 'Tipo de tarjeta no soportado.');
                }
            }
        });
    }

    protected function prepareForValidation()
    {

        if ($this->has('card_number')) {
            $this->merge([
                'card_number' => preg_replace('/[\s\-]/', '', $this->card_number),
            ]);
        }


        if ($this->has('expiration_month')) {
            $this->merge([
                'expiration_month' => str_pad($this->expiration_month, 2, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
