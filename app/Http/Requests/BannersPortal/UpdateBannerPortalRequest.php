<?php

namespace App\Http\Requests\BannersPortal;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerPortalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['nullable', 'string', 'max:150'],
            'descripcion' => ['nullable', 'string'],
            'imagen_url' => ['sometimes', 'required', 'string', 'max:255'],
            'enlace_url' => ['nullable', 'string', 'max:255'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'activo' => ['sometimes', 'required', 'boolean'],
            'orden' => ['sometimes', 'required', 'integer'],
        ];
    }
}
