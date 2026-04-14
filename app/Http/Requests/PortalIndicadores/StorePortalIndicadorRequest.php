<?php

namespace App\Http\Requests\PortalIndicadores;

use Illuminate\Foundation\Http\FormRequest;

class StorePortalIndicadorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:250'],
            'descripcion' => ['nullable', 'string'],
            'categoria' => ['required', 'string', 'in:social,economico,infraestructura,salud,educacion,medioambiente,seguridad,otro'],
            'unidad' => ['required', 'string', 'max:50'],
            'meta' => ['nullable', 'numeric'],
            'valor_actual' => ['nullable', 'numeric'],
            'periodo' => ['nullable', 'string', 'max:100'],
            'fecha_medicion' => ['nullable', 'date'],
            'estado' => ['nullable', 'string', 'in:en_meta,por_encima,por_debajo,sin_dato'],
            'responsable' => ['nullable', 'string', 'max:200'],
            'publicado' => ['nullable', 'boolean'],
            'activo' => ['nullable', 'boolean'],
        ];
    }
}
