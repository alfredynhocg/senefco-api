<?php

namespace App\Http\Requests\PlanesGobierno;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanGobiernoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:200'],
            'gestion_inicio' => ['required', 'integer', 'min:2000', 'max:2100'],
            'gestion_fin' => ['required', 'integer', 'after_or_equal:gestion_inicio'],
            'descripcion' => ['nullable', 'string'],
            'documento_pdf_url' => ['nullable', 'string', 'max:255'],
            'vigente' => ['nullable', 'boolean'],
        ];
    }
}
