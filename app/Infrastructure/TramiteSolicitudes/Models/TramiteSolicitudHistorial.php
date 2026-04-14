<?php

namespace App\Infrastructure\TramiteSolicitudes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TramiteSolicitudHistorial extends Model
{
    protected $table = 'tramite_solicitud_historial';

    protected $fillable = [
        'solicitud_id',
        'etapa_orden',
        'etapa_nombre',
        'observacion',
    ];

    public function solicitud(): BelongsTo
    {
        return $this->belongsTo(TramiteSolicitud::class, 'solicitud_id');
    }
}
