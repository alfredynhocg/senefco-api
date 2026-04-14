<?php

namespace App\Http\Requests\UnidadesResponsables;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnidadResponsableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'secretaria_id' => ['required', 'integer', 'exists:secretarias,id'],
            'nombre' => ['required', 'string', 'max:200'],
            'direccion' => ['nullable', 'string', 'max:200'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:150'],
            'horario' => ['nullable', 'string', 'max:80'],
            'activa' => ['nullable', 'boolean'],
        ];
    }
}
