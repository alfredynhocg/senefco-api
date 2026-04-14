<?php

namespace App\Http\Requests\DecretosMunicipales;

use Illuminate\Foundation\Http\FormRequest;

class StoreDecretoMunicipalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numero'             => ['required', 'string', 'max:50', 'unique:decretos_municipales,numero'],
            'tipo'               => ['required', 'string', 'in:decreto,resolucion,ordenanza'],
            'titulo'             => ['required', 'string', 'max:300'],
            'descripcion'        => ['nullable', 'string'],
            'pdf_url'            => ['nullable', 'string', 'max:500'],
            'pdf_nombre'         => ['nullable', 'string', 'max:300'],
            'estado'             => ['required', 'string', 'in:borrador,publicado'],
            'fecha_promulgacion' => ['nullable', 'date'],
            'anio'               => ['required', 'integer', 'min:1900', 'max:2100'],
            'publicado_en_web'   => ['boolean'],
        ];
    }
}
