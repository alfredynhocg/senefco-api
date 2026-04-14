<?php

namespace App\Http\Requests\AvanceProyecto;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'proyecto_id' => ['required', 'integer', 'exists:proyectos,id'],
            'porcentaje_fisico' => ['required', 'numeric', 'min:0', 'max:100'],
            'monto_financiero_ejecutado' => ['required', 'numeric', 'min:0'],
            'fecha_reporte' => ['required', 'date'],
            'descripcion_avance' => ['nullable', 'string'],
            'fotografia_url' => ['nullable', 'string', 'max:255'],
        ];
    }
}
