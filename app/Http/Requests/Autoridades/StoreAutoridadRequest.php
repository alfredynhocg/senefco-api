<?php

namespace App\Http\Requests\Autoridades;

use Illuminate\Foundation\Http\FormRequest;

class StoreAutoridadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'secretaria_id' => ['nullable', 'integer', 'exists:secretarias,id'],
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'cargo' => ['required', 'string', 'max:100'],
            'tipo' => ['nullable', 'string', 'in:alcalde,subalcalde,secretario,director,jefe,otro'],
            'perfil_profesional' => ['nullable', 'string'],
            'email_institucional' => ['nullable', 'email', 'max:150'],
            'foto_url' => ['nullable', 'string', 'max:255'],
            'orden' => ['nullable', 'integer', 'min:0'],
            'activo' => ['nullable', 'boolean'],
            'fecha_inicio_cargo' => ['nullable', 'date'],
            'fecha_fin_cargo' => ['nullable', 'date', 'after_or_equal:fecha_inicio_cargo'],
        ];
    }
}
