<?php

namespace App\Http\Requests\EscalaSalarial;

use Illuminate\Foundation\Http\FormRequest;

class StoreEscalaSalarialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nivel' => ['required', 'string', 'max:20'],
            'descripcion_cargo' => ['required', 'string', 'max:150'],
            'sueldo_basico' => ['required', 'numeric', 'min:0'],
            'categoria' => ['nullable', 'string', 'max:50'],
        ];
    }
}
