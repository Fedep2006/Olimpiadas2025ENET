<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaqueteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_total' => 'required|numeric|min:0|max:99999999.99',
            'duracion' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'cupo_minimo' => 'required|integer|min:1',
            'cupo_maximo' => 'nullable|integer|min:1',
            'numero_paquete' => 'required|string|max:255',
            'hecho_por_usuario' => 'boolean',
            'activo' => 'boolean',
        ];

        // Validación adicional para que cupo_maximo sea mayor que cupo_minimo
        if ($this->filled('cupo_maximo') && $this->filled('cupo_minimo')) {
            $rules['cupo_maximo'] = array_merge($rules['cupo_maximo'], ['gte:cupo_minimo']);
        }

        // Validación única para numero_paquete (excluir el registro actual en edición)
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $paqueteId = $this->route('paquete') ? $this->route('paquete')->id : $this->route('id');
            $rules['numero_paquete'] = array_merge($rules['numero_paquete'], ['unique:paquetes,numero_paquete,' . $paqueteId]);
        } else {
            $rules['numero_paquete'] = array_merge($rules['numero_paquete'], ['unique:paquetes,numero_paquete']);
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del paquete es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',

            'descripcion.string' => 'La descripción debe ser una cadena de texto.',

            'precio_total.required' => 'El precio total es obligatorio.',
            'precio_total.numeric' => 'El precio debe ser un número válido.',
            'precio_total.min' => 'El precio no puede ser negativo.',
            'precio_total.max' => 'El precio excede el límite permitido.',

            'duracion.required' => 'La duración del paquete es obligatoria.',
            'duracion.string' => 'La duración debe ser una cadena de texto.',
            'duracion.max' => 'La duración no puede exceder los 255 caracteres.',

            'ubicacion.required' => 'La ubicación es obligatoria.',
            'ubicacion.string' => 'La ubicación debe ser una cadena de texto.',
            'ubicacion.max' => 'La ubicación no puede exceder los 255 caracteres.',

            'cupo_minimo.required' => 'El cupo mínimo es obligatorio.',
            'cupo_minimo.integer' => 'El cupo mínimo debe ser un número entero.',
            'cupo_minimo.min' => 'El cupo mínimo debe ser al menos 1.',

            'cupo_maximo.integer' => 'El cupo máximo debe ser un número entero.',
            'cupo_maximo.min' => 'El cupo máximo debe ser al menos 1.',
            'cupo_maximo.gte' => 'El cupo máximo debe ser mayor o igual al cupo mínimo.',

            'numero_paquete.required' => 'El número de paquete es obligatorio.',
            'numero_paquete.string' => 'El número de paquete debe ser una cadena de texto.',
            'numero_paquete.max' => 'El número de paquete no puede exceder los 255 caracteres.',
            'numero_paquete.unique' => 'Este número de paquete ya está en uso.',

            'hecho_por_usuario.boolean' => 'El campo "hecho por usuario" debe ser verdadero o falso.',
            'activo.boolean' => 'El campo "activo" debe ser verdadero o falso.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'nombre' => 'nombre del paquete',
            'descripcion' => 'descripción',
            'precio_total' => 'precio total',
            'duracion' => 'duración',
            'ubicacion' => 'ubicación',
            'cupo_minimo' => 'cupo mínimo',
            'cupo_maximo' => 'cupo máximo',
            'numero_paquete' => 'número de paquete',
            'hecho_por_usuario' => 'hecho por usuario',
            'activo' => 'activo',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Limpiar espacios en blanco
        $this->merge([
            'nombre' => trim($this->nombre ?? ''),
            'ubicacion' => trim($this->ubicacion ?? ''),
            'descripcion' => trim($this->descripcion ?? ''),
        ]);
    }
}
