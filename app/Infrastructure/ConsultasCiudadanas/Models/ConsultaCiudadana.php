<?php

namespace App\Infrastructure\ConsultasCiudadanas\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultaCiudadana extends Model
{
    protected $table = 'atencion_ciudadana';

    protected $fillable = [
        'ciudadano_nombre',
        'ciudadano_ci',
        'ciudadano_email',
        'ciudadano_telefono',
        'tipo',
        'asunto',
        'descripcion',
        'estado',
        'respuesta',
        'respondido_por',
        'respondido_at',
    ];

    protected $casts = [
        'respondido_at' => 'datetime',
    ];
}
