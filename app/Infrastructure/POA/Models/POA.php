<?php

namespace App\Infrastructure\POA\Models;

use App\Infrastructure\PlanesGobierno\Models\PlanGobierno;
use App\Infrastructure\ProgramasPOA\Models\ProgramaPOA;
use App\Infrastructure\Secretarias\Models\Secretaria;
use Illuminate\Database\Eloquent\Model;

class POA extends Model
{
    protected $table = 'poa';

    public $timestamps = false;

    protected $fillable = [
        'plan_gobierno_id',
        'secretaria_id',
        'gestion',
        'titulo',
        'documento_pdf_url',
        'resumen_ejecutivo_url',
        'estado',
        'aprobado_por',
        'fecha_aprobacion',
    ];

    protected $casts = [
        'plan_gobierno_id' => 'integer',
        'secretaria_id' => 'integer',
        'gestion' => 'integer',
        'aprobado_por' => 'integer',
        'fecha_aprobacion' => 'date',
        'created_at' => 'datetime',
    ];

    public function planGobierno()
    {
        return $this->belongsTo(PlanGobierno::class, 'plan_gobierno_id');
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_id');
    }

    public function programas()
    {
        return $this->hasMany(ProgramaPOA::class, 'poa_id');
    }
}
