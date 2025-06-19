<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\AutorizarEmpleado;
use Illuminate\Foundation\Http\FormRequest;

class VehiculoRequest extends FormRequest
{
    use AutorizarEmpleado;

    public function authorize(): bool
    {
        return $this->autorizarEmpleado();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
