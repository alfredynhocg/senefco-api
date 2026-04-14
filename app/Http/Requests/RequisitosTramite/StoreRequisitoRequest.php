<?php

namespace App\Http\Requests\RequisitosTramite;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequisitoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tramite_id' => ['required', 'exists:tramites_catalogo,id'],
            'nombre' => ['required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'obligatorio' => ['nullable', 'boolean'],
            'tipo' => ['nullable', 'string', 'max:50'],
            'orden' => ['nullable', 'integer'],
        ];
    }
}
