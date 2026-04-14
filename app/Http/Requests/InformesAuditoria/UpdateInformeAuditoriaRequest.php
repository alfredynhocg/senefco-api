<?php

namespace App\Http\Requests\InformesAuditoria;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInformeAuditoriaRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nombre'           => ['sometimes', 'string', 'max:300'],
            'descripcion'      => ['nullable', 'string'],
            'pdf_url'          => ['nullable', 'string', 'max:500'],
            'pdf_nombre'       => ['nullable', 'string', 'max:255'],
            'estado'           => ['sometimes', 'string', 'in:borrador,publicado'],
            'fecha'            => ['nullable', 'date'],
            'anio'             => ['sometimes', 'integer', 'min:2000', 'max:2100'],
            'publicado_en_web' => ['boolean'],
        ];
    }
}
