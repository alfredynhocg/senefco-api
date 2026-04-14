<?php

namespace App\Http\Requests\FormulariosTramite;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormularioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'required', 'string', 'max:200'],
            'archivo_url' => ['sometimes', 'required', 'string', 'max:255'],
            'formato' => ['sometimes', 'required', 'string', 'max:10'],
            'fecha_actualizacion' => ['nullable', 'date'],
            'activo' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
