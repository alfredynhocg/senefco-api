<?php

namespace App\Infrastructure\HallazgosAuditoria\Models;

use App\Infrastructure\Auditorias\Models\Auditoria;
use App\Infrastructure\Secretarias\Models\Secretaria;
use Illuminate\Database\Eloquent\Model;

class HallazgoAuditoria extends Model
{
    protected $table = 'hallazgos_auditoria';

    protected $fillable = [
        'auditoria_id',
        'tipo',
        'descripcion',
        'recomendacion',
        'estado_seguimiento',
        'secretaria_responsable_id',
        'fecha_limite',
        'respuesta_unidad',
    ];

    protected $casts = [
        'auditoria_id' => 'integer',
        'secretaria_responsable_id' => 'integer',
        'fecha_limite' => 'date',
    ];

    public function auditoria()
    {
        return $this->belongsTo(Auditoria::class, 'auditoria_id');
    }

    public function secretariaResponsable()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_responsable_id');
    }
}
