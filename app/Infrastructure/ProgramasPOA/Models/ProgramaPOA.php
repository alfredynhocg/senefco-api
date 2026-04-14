<?php

namespace App\Infrastructure\ProgramasPOA\Models;

use App\Infrastructure\POA\Models\POA;
use Illuminate\Database\Eloquent\Model;

class ProgramaPOA extends Model
{
    protected $table = 'programas_poa';

    protected $fillable = [
        'poa_id',
        'nombre',
        'descripcion',
        'presupuesto_asignado',
        'meta_indicador',
        'unidad_medida',
        'estado',
    ];

    protected $casts = [
        'poa_id' => 'integer',
        'presupuesto_asignado' => 'decimal:2',
        'meta_indicador' => 'integer',
    ];

    public function poa()
    {
        return $this->belongsTo(POA::class, 'poa_id');
    }
}
