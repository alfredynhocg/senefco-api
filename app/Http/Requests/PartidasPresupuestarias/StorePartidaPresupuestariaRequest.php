<?php

namespace App\Http\Requests\PartidasPresupuestarias;

use Illuminate\Foundation\Http\FormRequest;

class StorePartidaPresupuestariaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'presupuesto_id' => ['required', 'integer', 'exists:presupuestos,id'],
            'codigo_partida' => ['required', 'string', 'max:30'],
            'descripcion' => ['nullable', 'string', 'max:300'],
            'monto_asignado' => ['required', 'numeric', 'min:0'],
            'categoria' => ['nullable', 'string', 'max:50'],
        ];
    }
}
