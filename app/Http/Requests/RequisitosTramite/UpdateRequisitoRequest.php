<?php

namespace App\Http\Requests\RequisitosTramite;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequisitoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'obligatorio' => ['sometimes', 'required', 'boolean'],
            'tipo' => ['sometimes', 'required', 'string', 'max:50'],
            'orden' => ['sometimes', 'required', 'integer'],
        ];
    }
}
