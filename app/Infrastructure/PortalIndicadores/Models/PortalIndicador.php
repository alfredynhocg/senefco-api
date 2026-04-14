<?php

namespace App\Infrastructure\PortalIndicadores\Models;

use Illuminate\Database\Eloquent\Model;

class PortalIndicador extends Model
{
    protected $table = 'portal_indicadores_gestion';

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'descripcion', 'categoria', 'unidad',
        'meta', 'valor_actual', 'periodo', 'fecha_medicion',
        'estado', 'responsable', 'publicado', 'activo',
    ];

    protected $casts = [
        'meta' => 'float',
        'valor_actual' => 'float',
        'publicado' => 'boolean',
        'activo' => 'boolean',
        'fecha_medicion' => 'datetime',
        'created_at' => 'datetime',
    ];
}
