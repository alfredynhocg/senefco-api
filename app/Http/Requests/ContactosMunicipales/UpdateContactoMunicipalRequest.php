<?php

namespace App\Http\Requests\ContactosMunicipales;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactoMunicipalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_area' => ['sometimes', 'required', 'string', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:50'],
            'interno' => ['nullable', 'string', 'max:10'],
            'encargado' => ['nullable', 'string', 'max:150'],
            'orden' => ['sometimes', 'required', 'integer'],
            'activo' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
