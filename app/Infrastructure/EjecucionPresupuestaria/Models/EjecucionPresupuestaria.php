<?php

namespace App\Infrastructure\EjecucionPresupuestaria\Models;

use App\Infrastructure\PartidasPresupuestarias\Models\PartidaPresupuestaria;
use Illuminate\Database\Eloquent\Model;

class EjecucionPresupuestaria extends Model
{
    protected $table = 'ejecucion_presupuestaria';

    public $timestamps = false;

    protected $fillable = [
        'partida_id',
        'proyecto_id',
        'monto_devengado',
        'monto_pagado',
        'mes',
        'gestion',
        'descripcion_gasto',
        'fecha_registro',
        'registrado_por',
    ];

    protected $casts = [
        'partida_id' => 'integer',
        'proyecto_id' => 'integer',
        'monto_devengado' => 'decimal:2',
        'monto_pagado' => 'decimal:2',
        'mes' => 'integer',
        'gestion' => 'integer',
        'registrado_por' => 'integer',
        'fecha_registro' => 'date',
        'created_at' => 'datetime',
    ];

    public function partida()
    {
        return $this->belongsTo(PartidaPresupuestaria::class, 'partida_id');
    }
}
