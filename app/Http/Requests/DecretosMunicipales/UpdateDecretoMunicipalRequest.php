<?php

namespace App\Http\Requests\DecretosMunicipales;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDecretoMunicipalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'numero'             => ['sometimes', 'string', 'max:50', "unique:decretos_municipales,numero,{$id}"],
            'tipo'               => ['sometimes', 'string', 'in:decreto,resolucion,ordenanza'],
            'titulo'             => ['sometimes', 'string', 'max:300'],
            'descripcion'        => ['nullable', 'string'],
            'pdf_url'            => ['nullable', 'string', 'max:500'],
            'pdf_nombre'         => ['nullable', 'string', 'max:300'],
            'estado'             => ['sometimes', 'string', 'in:borrador,publicado'],
            'fecha_promulgacion' => ['nullable', 'date'],
            'anio'               => ['sometimes', 'integer', 'min:1900', 'max:2100'],
            'publicado_en_web'   => ['boolean'],
        ];
    }
}
