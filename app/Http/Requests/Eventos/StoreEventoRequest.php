<?php

namespace App\Http\Requests\Eventos;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_evento_id' => ['required', 'integer', 'exists:tipos_evento,id'],
            'titulo' => ['required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'lugar' => ['nullable', 'string', 'max:200'],
            'latitud' => ['nullable', 'numeric'],
            'longitud' => ['nullable', 'numeric'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'todo_el_dia' => ['nullable', 'boolean'],
            'estado' => ['nullable', 'string', 'in:programado,en_curso,realizado,cancelado'],
            'url_transmision' => ['nullable', 'string', 'max:255'],
            'publico' => ['nullable', 'boolean'],
        ];
    }
}
