<?php

namespace App\Http\Requests\HallazgosAuditoria;

use Illuminate\Foundation\Http\FormRequest;

class StoreHallazgoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'auditoria_id' => ['required', 'integer', 'exists:auditorias,id'],
            'descripcion' => ['required', 'string'],
            'tipo' => ['nullable', 'string', 'max:50'],
            'recomendacion' => ['nullable', 'string'],
            'estado_seguimiento' => ['nullable', 'string', 'max:50'],
            'secretaria_responsable_id' => ['nullable', 'integer', 'exists:secretarias,id'],
            'fecha_limite' => ['nullable', 'date'],
        ];
    }
}
