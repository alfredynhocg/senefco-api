<?php

namespace App\Http\Requests\ValoresIndicador;

use Illuminate\Foundation\Http\FormRequest;

class StoreValorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'indicador_id' => ['required', 'integer', 'exists:indicadores_gestion,id'],
            'valor' => ['required', 'numeric'],
            'gestion' => ['required', 'integer', 'min:2000', 'max:2100'],
            'mes' => ['nullable', 'integer', 'min:1', 'max:12'],
            'fecha_registro' => ['nullable', 'date'],
            'fuente' => ['nullable', 'string'],
        ];
    }
}
