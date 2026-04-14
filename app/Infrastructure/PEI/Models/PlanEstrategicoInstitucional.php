<?php

namespace App\Infrastructure\PEI\Models;

use App\Infrastructure\EjesPEI\Models\EjePEI;
use Illuminate\Database\Eloquent\Model;

class PlanEstrategicoInstitucional extends Model
{
    protected $table = 'plan_estrategico_institucional';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'anio_inicio',
        'anio_fin',
        'descripcion',
        'documento_pdf_url',
        'estado',
        'aprobado_por',
        'fecha_aprobacion',
        'vigente',
    ];

    protected $casts = [
        'anio_inicio' => 'integer',
        'anio_fin' => 'integer',
        'aprobado_por' => 'integer',
        'fecha_aprobacion' => 'date',
        'vigente' => 'boolean',
    ];

    public function ejes()
    {
        return $this->hasMany(EjePEI::class, 'pei_id');
    }
}
