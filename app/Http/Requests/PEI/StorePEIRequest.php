<?php

namespace App\Http\Requests\PEI;

use Illuminate\Foundation\Http\FormRequest;

class StorePEIRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:200'],
            'anio_inicio' => ['required', 'integer', 'min:2000', 'max:2100'],
            'anio_fin' => ['required', 'integer', 'after_or_equal:anio_inicio'],
            'descripcion' => ['nullable', 'string'],
            'documento_pdf_url' => ['nullable', 'string', 'max:255'],
            'estado' => ['nullable', 'string', 'in:borrador,aprobado,finalizado'],
            'fecha_aprobacion' => ['nullable', 'date'],
            'vigente' => ['nullable', 'boolean'],
        ];
    }
}
