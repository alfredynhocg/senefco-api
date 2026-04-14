<?php

namespace App\Http\Requests\UnidadesResponsables;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUnidadResponsableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'secretaria_id' => ['sometimes', 'required', 'integer', 'exists:secretarias,id'],
            'nombre' => ['sometimes', 'required', 'string', 'max:200'],
            'direccion' => ['nullable', 'string', 'max:200'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:150'],
            'horario' => ['nullable', 'string', 'max:80'],
            'activa' => ['nullable', 'boolean'],
        ];
    }
}
