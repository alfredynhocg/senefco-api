<?php

namespace App\Infrastructure\PartidasPresupuestarias\Models;

use App\Infrastructure\Presupuestos\Models\Presupuesto;
use Illuminate\Database\Eloquent\Model;

class PartidaPresupuestaria extends Model
{
    protected $table = 'partidas_presupuestarias';

    public $timestamps = false;

    protected $fillable = [
        'presupuesto_id',
        'codigo_partida',
        'descripcion',
        'monto_asignado',
        'categoria',
    ];

    protected $casts = [
        'presupuesto_id' => 'integer',
        'monto_asignado' => 'decimal:2',
        'monto_ejecutado' => 'decimal:2',
    ];

    public function presupuesto()
    {
        return $this->belongsTo(Presupuesto::class, 'presupuesto_id');
    }
}
