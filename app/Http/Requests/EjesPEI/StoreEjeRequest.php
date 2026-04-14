<?php

namespace App\Http\Requests\EjesPEI;

use Illuminate\Foundation\Http\FormRequest;

class StoreEjeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pei_id' => ['required', 'integer', 'exists:plan_estrategico_institucional,id'],
            'numero_eje' => ['required', 'integer'],
            'nombre' => ['required', 'string', 'max:200'],
            'descripcion' => ['nullable', 'string'],
            'color_hex' => ['nullable', 'string', 'max:20'],
            'total_objetivos' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
