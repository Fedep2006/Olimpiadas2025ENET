<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\AutorizarEmpleado;
use Illuminate\Foundation\Http\FormRequest;

class ReservaRequest extends FormRequest
{
    use AutorizarEmpleado;

    public function authorize(): bool
    {
        if ($this->isMethod('DELETE')) {
            return $this->autorizarEmpleado();
        } else {
            return true;
        }
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
