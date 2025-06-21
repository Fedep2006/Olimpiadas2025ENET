<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nombre_servicio_id' => [
                'required',
                'integer',
                'exists:servicios,id'
            ],
            'empresa_id' => [
                'required',
                'integer',
                'exists:empresas,id'
            ],
            'precio' => [
                'required',
                'numeric',
                'min:0',
                'decimal:0,2'
            ],
            'por_noche' => [
                'boolean'
            ],
            'serviciable_type' => [
                'required',
                'string',
                'max:255'
            ],
            'serviciable_id' => [
                'required',
                'integer',
                'min:1'
            ]
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['nombre_servicio_id'][0] = 'sometimes';
            $rules['empresa_id'][0] = 'sometimes';
            $rules['precio'][0] = 'sometimes';
            $rules['serviciable_type'][0] = 'sometimes';
            $rules['serviciable_id'][0] = 'sometimes';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'nombre_servicio_id.required' => 'El nombre del servicio es obligatorio.',
            'nombre_servicio_id.exists' => 'El servicio seleccionado no existe.',
            'empresa_id.required' => 'La empresa es obligatoria.',
            'empresa_id.exists' => 'La empresa seleccionada no existe.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'precio.decimal' => 'El precio debe tener máximo 2 decimales.',
            'por_noche.boolean' => 'El campo por noche debe ser verdadero o falso.',
            'serviciable_type.required' => 'El tipo de entidad relacionada es obligatorio.',
            'serviciable_type.string' => 'El tipo de entidad debe ser texto.',
            'serviciable_type.max' => 'El tipo de entidad no puede exceder 255 caracteres.',
            'serviciable_id.required' => 'El ID de la entidad relacionada es obligatorio.',
            'serviciable_id.integer' => 'El ID de la entidad debe ser un número entero.',
            'serviciable_id.min' => 'El ID de la entidad debe ser mayor a 0.'
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre_servicio_id' => 'nombre del servicio',
            'empresa_id' => 'empresa',
            'precio' => 'precio',
            'por_noche' => 'por noche',
            'serviciable_type' => 'tipo de entidad',
            'serviciable_id' => 'ID de entidad'
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('por_noche')) {
            $this->merge([
                'por_noche' => false
            ]);
        }
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Validación personalizada para verificar que la combinación serviciable_type + serviciable_id existe
            if ($this->filled(['serviciable_type', 'serviciable_id'])) {
                $modelClass = $this->serviciable_type;

                // Verificar que la clase del modelo existe
                if (!class_exists($modelClass)) {
                    $validator->errors()->add('serviciable_type', 'El tipo de modelo especificado no existe.');
                    return;
                }

                // Verificar que el registro existe en la tabla correspondiente
                if (!$modelClass::find($this->serviciable_id)) {
                    $validator->errors()->add('serviciable_id', 'El registro especificado no existe para este tipo de entidad.');
                }
            }
        });
    }
}
