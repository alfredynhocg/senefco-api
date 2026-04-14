<?php

namespace App\Infrastructure\TramiteSolicitudes\Models;

use App\Infrastructure\TramitesCatalogo\Models\Tramite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TramiteSolicitud extends Model
{
    protected $table = 'tramite_solicitudes';

    protected $fillable = [
        'tramite_id',
        'numero_seguimiento',
        'phone',
        'nombre_ciudadano',
        'ci',
        'etapa_actual',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'etapa_actual' => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::created(function (TramiteSolicitud $solicitud) {
            $solicitud->update([
                'numero_seguimiento' => 'TRM-'.now()->format('Ym').'-'.str_pad((string) $solicitud->id, 5, '0', STR_PAD_LEFT),
            ]);
        });
    }

    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class, 'tramite_id');
    }

    public function historial(): HasMany
    {
        return $this->hasMany(TramiteSolicitudHistorial::class, 'solicitud_id')->orderBy('id');
    }

    public function etapas(): HasMany
    {
        return $this->tramite->etapas()->orderBy('orden');
    }
}
