<?php

namespace App\Infrastructure\TramiteSolicitudes\Models;

use App\Infrastructure\TramitesCatalogo\Models\Tramite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TramiteEtapa extends Model
{
    protected $table = 'tramite_etapas';

    protected $fillable = [
        'tramite_id',
        'nombre',
        'descripcion',
        'instruccion_ciudadano',
        'orden',
        'es_final',
    ];

    protected $casts = [
        'es_final' => 'boolean',
        'orden' => 'integer',
    ];

    public function tramite(): BelongsTo
    {
        return $this->belongsTo(Tramite::class, 'tramite_id');
    }
}
