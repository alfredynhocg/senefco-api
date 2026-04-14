<?php

namespace App\Http\Requests\Presupuestos;

use Illuminate\Foundation\Http\FormRequest;

class StorePresupuestoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'secretaria_id' => ['required', 'integer', 'exists:secretarias,id'],
            'gestion' => ['required', 'integer', 'min:2000', 'max:2100'],
            'monto_aprobado' => ['required', 'numeric', 'min:0'],
            'monto_modificado' => ['nullable', 'numeric', 'min:0'],
            'estado' => ['nullable', 'string', 'in:aprobado,modificado,cerrado'],
            'documento_url' => ['nullable', 'string', 'max:255'],
            'fecha_aprobacion' => ['nullable', 'date'],
        ];
    }
}
