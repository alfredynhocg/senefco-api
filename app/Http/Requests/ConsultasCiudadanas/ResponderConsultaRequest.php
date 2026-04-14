<?php

namespace App\Http\Requests\ConsultasCiudadanas;

use Illuminate\Foundation\Http\FormRequest;

class ResponderConsultaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'respuesta' => ['required', 'string'],
            'estado' => ['required', 'in:pendiente,en_proceso,respondido,cerrado'],
        ];
    }
}
