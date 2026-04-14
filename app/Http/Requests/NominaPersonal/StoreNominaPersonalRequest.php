<?php

namespace App\Http\Requests\NominaPersonal;

use Illuminate\Foundation\Http\FormRequest;

class StoreNominaPersonalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'secretaria_id' => ['required', 'integer', 'exists:secretarias,id'],
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'ci' => ['nullable', 'string', 'max:20'],
            'cargo' => ['required', 'string', 'max:200'],
            'nivel_salarial' => ['nullable', 'string', 'max:50'],
            'tipo_contrato' => ['nullable', 'string', 'in:planta,consultor,eventual'],
            'gestion' => ['required', 'integer', 'min:2000', 'max:2100'],
            'activo' => ['nullable', 'boolean'],
        ];
    }
}
