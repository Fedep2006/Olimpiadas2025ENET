<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\AutorizarEmpleado;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class EmpresaRequest extends FormRequest
{
    use AutorizarEmpleado;

    public function authorize(): bool
    {
        $empresa = $this->route('empresa');
        $empresaId = is_object($empresa) ? $empresa->id : $empresa;

        // Si es update/delete y la empresa es la ID 1, denegar
        if (($this->isMethod('put') || $this->isMethod('patch') || $this->isMethod('delete')) && $empresaId == 1) {
            return false;
        }

        return $this->autorizarEmpleado();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('DELETE')) {
            return [];
        }
        $rules = [
            'nombre' => [
                'required',
                'string',
                'max:255',
                'min:2',
            ],
            'tipo' => [
                'required',
                'string',
                Rule::in(['hospedajes', 'viajes', 'paquetes']),
            ],
        ];

        // Si es una actualización, excluir el registro actual de la validación única
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['nombre'][] = Rule::unique('empresas', 'nombre')->ignore($this->route('empresa'));
        } else {
            // Para creación, validar que el nombre sea único
            $rules['nombre'][] = Rule::unique('empresas', 'nombre');
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la empresa es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'nombre.min' => 'El nombre debe tener al menos 2 caracteres.',
            'nombre.unique' => 'Ya existe una empresa con este nombre.',

            'tipo.required' => 'El tipo de empresa es obligatorio.',
            'tipo.string' => 'El tipo debe ser una cadena de texto.',
            'tipo.in' => 'El tipo debe ser: hospedajes, viajes o paquetes.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre de la empresa',
            'tipo' => 'tipo de empresa',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new ValidationException($validator);
        }

        parent::failedValidation($validator);
    }
}
