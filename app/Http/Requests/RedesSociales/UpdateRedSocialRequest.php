<?php

namespace App\Http\Requests\RedesSociales;

use App\Domain\RedesSociales\Enums\TipoRedSocial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRedSocialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('plataforma')) {
            $this->merge(['plataforma' => strtolower($this->plataforma)]);
        }
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'plataforma' => ['sometimes', 'required', 'string', Rule::enum(TipoRedSocial::class), Rule::unique('redes_sociales', 'plataforma')->ignore($id)],
            'url' => ['sometimes', 'required', 'url', 'max:255'],
            'nombre_cuenta' => ['nullable', 'string', 'max:100'],
            'icono_clase' => ['nullable', 'string', 'max:100'],
            'activo' => ['nullable', 'boolean'],
            'orden' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
