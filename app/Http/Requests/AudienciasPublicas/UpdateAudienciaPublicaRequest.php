<?php

namespace App\Http\Requests\AudienciasPublicas;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAudienciaPublicaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['sometimes', 'required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'tipo' => ['nullable', 'string', 'in:inicial,seguimiento,cierre'],
            'estado' => ['nullable', 'string', 'in:convocada,realizada,cancelada'],
            'acta_url' => ['nullable', 'string', 'max:500'],
            'afiche_url' => ['nullable', 'string', 'max:500'],
            'imagenes' => ['nullable', 'array'],
            'imagenes.*' => ['string', 'max:500'],
            'video_url' => ['nullable', 'string', 'max:500'],
            'enlace_virtual' => ['nullable', 'string', 'max:500'],
            'asistentes' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
