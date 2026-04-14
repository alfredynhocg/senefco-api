<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:250'],
            'descripcion' => ['nullable', 'string'],
            'tipo' => ['sometimes', 'string', 'in:servicio,tramite,producto,recurso,otro'],
            'precio' => ['nullable', 'numeric', 'min:0'],
            'imagen_url' => ['nullable', 'string', 'max:500'],
            'enlace_url' => ['nullable', 'string', 'max:500'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'publicado' => ['nullable', 'boolean'],
            'activo' => ['nullable', 'boolean'],
        ];
    }
}
