<?php

namespace App\Http\Requests\EscalaSalarial;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEscalaSalarialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nivel' => ['sometimes', 'required', 'string', 'max:20'],
            'descripcion_cargo' => ['sometimes', 'required', 'string', 'max:150'],
            'sueldo_basico' => ['sometimes', 'required', 'numeric', 'min:0'],
            'categoria' => ['nullable', 'string', 'max:50'],
        ];
    }
}
