<?php

namespace App\Http\Requests\FormulariosTramite;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormularioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tramite_id' => ['required', 'exists:tramites_catalogo,id'],
            'nombre' => ['required', 'string', 'max:200'],
            'archivo_url' => ['required', 'string', 'max:255'],
            'formato' => ['nullable', 'string', 'max:10'],
            'fecha_actualizacion' => ['nullable', 'date'],
            'activo' => ['nullable', 'boolean'],
        ];
    }
}
