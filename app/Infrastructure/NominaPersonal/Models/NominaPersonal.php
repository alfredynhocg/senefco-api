<?php

namespace App\Infrastructure\NominaPersonal\Models;

use App\Infrastructure\Secretarias\Models\Secretaria;
use Illuminate\Database\Eloquent\Model;

class NominaPersonal extends Model
{
    protected $table = 'nomina_personal';

    protected $fillable = [
        'usuario_id',
        'secretaria_id',
        'nombre',
        'apellido',
        'ci',
        'cargo',
        'nivel_salarial',
        'tipo_contrato',
        'gestion',
        'activo',
    ];

    protected $casts = [
        'usuario_id' => 'integer',
        'secretaria_id' => 'integer',
        'gestion' => 'integer',
        'activo' => 'boolean',
        'created_at' => 'datetime',
    ];

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_id');
    }
}
