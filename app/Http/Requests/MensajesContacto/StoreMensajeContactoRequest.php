<?php

namespace App\Http\Requests\MensajesContacto;

use Illuminate\Foundation\Http\FormRequest;

class StoreMensajeContactoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_remitente' => ['required', 'string', 'max:150'],
            'email_remitente' => ['required', 'email', 'max:150'],
            'telefono_remitente' => ['nullable', 'string', 'max:50'],
            'asunto' => ['required', 'string', 'max:200'],
            'mensaje' => ['required', 'string'],
            'secretaria_destino_id' => ['nullable', 'integer', 'exists:secretarias,id'],
        ];
    }
}
