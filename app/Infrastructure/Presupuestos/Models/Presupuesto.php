<?php

namespace App\Infrastructure\Presupuestos\Models;

use App\Infrastructure\PartidasPresupuestarias\Models\PartidaPresupuestaria;
use App\Infrastructure\Secretarias\Models\Secretaria;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table = 'presupuestos';

    public $timestamps = false;

    protected $fillable = [
        'secretaria_id',
        'gestion',
        'monto_aprobado',
        'monto_modificado',
        'estado',
        'documento_url',
        'fecha_aprobacion',
        'aprobado_por',
    ];

    protected $casts = [
        'secretaria_id' => 'integer',
        'gestion' => 'integer',
        'monto_aprobado' => 'decimal:2',
        'monto_modificado' => 'decimal:2',
        'fecha_aprobacion' => 'date',
        'aprobado_por' => 'integer',
        'created_at' => 'datetime',
    ];

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_id');
    }

    public function partidas()
    {
        return $this->hasMany(PartidaPresupuestaria::class, 'presupuesto_id');
    }

    public function ejecuciones()
    {
        return $this->hasMany(EjecucionPresupuestaria::class, 'presupuesto_id');
    }
}
