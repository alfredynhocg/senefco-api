<?php

namespace App\Http\Requests\EjecucionPresupuestaria;

use Illuminate\Foundation\Http\FormRequest;

class StoreEjecucionPresupuestariaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'partida_id' => ['required', 'integer', 'exists:partidas_presupuestarias,id'],
            'monto_devengado' => ['required', 'numeric', 'min:0'],
            'mes' => ['required', 'integer', 'min:1', 'max:12'],
            'gestion' => ['required', 'integer', 'min:2000', 'max:2100'],
            'proyecto_id' => ['nullable', 'integer', 'exists:proyectos,id'],
            'monto_pagado' => ['nullable', 'numeric', 'min:0'],
            'descripcion_gasto' => ['nullable', 'string', 'max:200'],
            'fecha_registro' => ['nullable', 'date'],
        ];
    }
}
