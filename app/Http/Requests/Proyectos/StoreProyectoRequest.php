<?php

namespace App\Http\Requests\Proyectos;

use Illuminate\Foundation\Http\FormRequest;

class StoreProyectoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:200'],
            'codigo_sipfe' => ['nullable', 'string', 'max:50', 'unique:proyectos,codigo_sipfe'],
            'estado_id' => ['required', 'integer', 'exists:estados_proyecto,id'],
            'secretaria_id' => ['required', 'integer', 'exists:secretarias,id'],
            'descripcion' => ['nullable', 'string'],
            'presupuesto_total' => ['required', 'numeric', 'min:0'],
            'ubicacion_texto' => ['nullable', 'string', 'max:255'],
            'latitud' => ['nullable', 'numeric'],
            'longitud' => ['nullable', 'numeric'],
            'contratista' => ['nullable', 'string', 'max:200'],
            'fecha_inicio_estimada' => ['nullable', 'date'],
            'fecha_fin_estimada' => ['nullable', 'date', 'after_or_equal:fecha_inicio_estimada'],
            'imagen_portada_url' => ['nullable', 'string', 'max:255'],
            'publico' => ['nullable', 'boolean'],
        ];
    }
}
