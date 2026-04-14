<?php

namespace App\Http\Requests\TramitesCatalogo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTramiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_tramite_id' => ['sometimes', 'required', 'exists:tipos_tramite,id'],
            'unidad_responsable_id' => ['sometimes', 'required', 'exists:unidades_responsables,id'],
            'nombre' => ['sometimes', 'required', 'string', 'max:300'],
            'descripcion' => ['nullable', 'string'],
            'procedimiento' => ['nullable', 'string'],
            'costo' => ['nullable', 'numeric'],
            'moneda' => ['sometimes', 'required', 'string', 'max:50'],
            'dias_habiles_resolucion' => ['nullable', 'integer'],
            'normativa_base' => ['nullable', 'string', 'max:100'],
            'url_formulario' => ['nullable', 'string', 'max:255'],
            'modalidad' => ['sometimes', 'required', 'string'],
            'activo' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
