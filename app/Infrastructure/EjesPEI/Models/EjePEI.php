<?php

namespace App\Infrastructure\EjesPEI\Models;

use App\Infrastructure\PEI\Models\PlanEstrategicoInstitucional;
use Illuminate\Database\Eloquent\Model;

class EjePEI extends Model
{
    protected $table = 'ejes_pei';

    public $timestamps = false; // Note: Migration has updated_at but not created_at?
    // $table->timestampTz('updated_at')->nullable();

    protected $fillable = [
        'pei_id',
        'numero_eje',
        'nombre',
        'descripcion',
        'color_hex',
        'total_objetivos',
        'objetivos_cumplidos',
        'activo',
    ];

    protected $casts = [
        'pei_id' => 'integer',
        'numero_eje' => 'integer',
        'total_objetivos' => 'integer',
        'objetivos_cumplidos' => 'integer',
        'activo' => 'boolean',
    ];

    public function pei()
    {
        return $this->belongsTo(PlanEstrategicoInstitucional::class, 'pei_id');
    }
}
