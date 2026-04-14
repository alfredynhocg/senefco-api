<?php

namespace App\Http\Requests\POA;

use Illuminate\Foundation\Http\FormRequest;

class StorePOARequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plan_gobierno_id' => ['required', 'integer', 'exists:planes_gobierno,id'],
            'secretaria_id' => ['required', 'integer', 'exists:secretarias,id'],
            'gestion' => ['required', 'integer', 'min:2000', 'max:2100'],
            'titulo' => ['required', 'string', 'max:200'],
            'documento_pdf_url' => ['nullable', 'string', 'max:255'],
            'resumen_ejecutivo_url' => ['nullable', 'string', 'max:255'],
            'estado' => ['nullable', 'string', 'in:borrador,aprobado,vigente,cerrado'],
            'fecha_aprobacion' => ['nullable', 'date'],
        ];
    }
}
