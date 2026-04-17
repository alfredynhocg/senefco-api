<?php

namespace App\Http\Requests\InformesAuditoria;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformeAuditoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'pdf_url' => ['nullable', 'string', 'max:500'],
            'pdf_nombre' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'string', 'in:borrador,publicado'],
            'fecha' => ['nullable', 'date'],
            'anio' => ['required', 'integer', 'min:2000', 'max:2100'],
            'publicado_en_web' => ['boolean'],
        ];
    }
}
