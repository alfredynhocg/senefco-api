<?php

namespace App\Http\Requests\ConsultasCiudadanas;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultaCiudadanaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ciudadano_nombre' => ['required', 'string', 'max:150'],
            'ciudadano_ci' => ['nullable', 'string', 'max:20'],
            'ciudadano_email' => ['nullable', 'email', 'max:150'],
            'ciudadano_telefono' => ['nullable', 'string', 'max:20'],
            'tipo' => ['required', 'in:consulta,queja,sugerencia,denuncia,solicitud'],
            'asunto' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'estado' => ['nullable', 'in:pendiente,en_proceso,respondido,cerrado'],
        ];
    }
}
