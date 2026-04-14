<?php

namespace App\Http\Requests\IndicadoresGestion;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndicadorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'categoria_id' => ['required', 'integer', 'exists:categorias_indicador,id'],
            'nombre' => ['required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'unidad_medida' => ['nullable', 'string', 'max:100'],
            'frecuencia_actualizacion' => ['nullable', 'string', 'max:100'],
            'publico' => ['nullable', 'boolean'],
            'activo' => ['nullable', 'boolean'],
            'orden_dashboard' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
