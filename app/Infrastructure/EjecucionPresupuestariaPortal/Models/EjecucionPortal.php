<?php

namespace App\Infrastructure\EjecucionPresupuestariaPortal\Models;

use Illuminate\Database\Eloquent\Model;

class EjecucionPortal extends Model
{
    protected $table = 'ejecucion_presupuestaria_portal';

    protected $fillable = [
        'anio', 'periodo', 'mes', 'trimestre', 'semestre',
        'unidad_ejecutora', 'programa', 'fuente_financiamiento',
        'presupuesto_inicial', 'presupuesto_vigente', 'ejecutado',
        'descripcion', 'archivo_url', 'archivo_nombre', 'publicado',
    ];

    protected $casts = [
        'anio' => 'integer',
        'mes' => 'integer',
        'trimestre' => 'integer',
        'semestre' => 'integer',
        'presupuesto_inicial' => 'float',
        'presupuesto_vigente' => 'float',
        'ejecutado' => 'float',
        'publicado' => 'boolean',
    ];
}
