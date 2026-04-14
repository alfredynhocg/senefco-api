<?php

namespace App\Http\Requests\TiposTramite;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoTramiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100'],
            'icono_url' => ['nullable', 'string', 'max:255'],
            'color_hex' => ['nullable', 'string', 'max:50'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer'],
        ];
    }
}
