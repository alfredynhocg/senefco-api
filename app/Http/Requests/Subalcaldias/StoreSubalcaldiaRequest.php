<?php

namespace App\Http\Requests\Subsenefcos;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubsenefcoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:150'],
            'zona_cobertura' => ['nullable', 'string', 'max:200'],
            'direccion_fisica' => ['nullable', 'string', 'max:200'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:150'],
            'imagen_url' => ['nullable', 'string', 'max:255'],
            'latitud' => ['nullable', 'numeric'],
            'longitud' => ['nullable', 'numeric'],
            'tramites_disponibles' => ['nullable', 'string'],
            'activa' => ['nullable', 'boolean'],
        ];
    }
}
