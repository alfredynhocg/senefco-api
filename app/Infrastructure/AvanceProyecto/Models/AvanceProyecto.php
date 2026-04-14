<?php

namespace App\Infrastructure\AvanceProyecto\Models;

use App\Infrastructure\Proyectos\Models\Proyecto;
use Illuminate\Database\Eloquent\Model;

class AvanceProyecto extends Model
{
    protected $table = 'avances_proyecto';

    public $timestamps = false; // Migration has created_at only

    protected $fillable = [
        'proyecto_id',
        'porcentaje_fisico',
        'monto_financiero_ejecutado',
        'descripcion_avance',
        'fecha_reporte',
        'fotografia_url',
        'registrado_por',
    ];

    protected $casts = [
        'proyecto_id' => 'integer',
        'porcentaje_fisico' => 'decimal:2',
        'monto_financiero_ejecutado' => 'decimal:2',
        'fecha_reporte' => 'date',
        'registrado_por' => 'integer',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
