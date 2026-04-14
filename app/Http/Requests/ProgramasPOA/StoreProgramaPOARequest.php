<?php

namespace App\Http\Requests\ProgramasPOA;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramaPOARequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'poa_id' => ['required', 'integer', 'exists:poa,id'],
            'nombre' => ['required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'presupuesto_asignado' => ['nullable', 'numeric', 'min:0'],
            'meta_indicador' => ['nullable', 'integer', 'min:0'],
            'unidad_medida' => ['nullable', 'string', 'max:100'],
            'estado' => ['nullable', 'string', 'in:no_iniciado,en_proceso,completado,suspendido'],
        ];
    }
}
