<?php

namespace App\Http\Requests\Auditorias;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuditoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_auditoria_id' => ['required', 'integer', 'exists:tipos_auditoria,id'],
            'codigo_auditoria' => ['required', 'string', 'max:30', 'unique:auditorias,codigo_auditoria'],
            'titulo' => ['required', 'string', 'max:300'],
            'secretaria_auditada_id' => ['nullable', 'integer', 'exists:secretarias,id'],
            'objeto_examen' => ['nullable', 'string'],
            'entidad_auditora' => ['nullable', 'string', 'max:200'],
            'gestion_auditada' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'estado' => ['nullable', 'string', 'max:50'],
            'informe_pdf_url' => ['nullable', 'string', 'max:255'],
            'publico' => ['nullable', 'boolean'],
        ];
    }
}
