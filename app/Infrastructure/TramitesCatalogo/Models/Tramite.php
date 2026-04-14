<?php

namespace App\Infrastructure\TramitesCatalogo\Models;

use App\Infrastructure\TiposTramite\Models\TipoTramite;
use App\Infrastructure\TramiteSolicitudes\Models\TramiteEtapa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Tramite extends Model
{
    protected $table = 'tramites_catalogo';

    protected $fillable = [
        'tipo_tramite_id',
        'unidad_responsable_id',
        'creado_por',
        'nombre',
        'slug',
        'descripcion',
        'procedimiento',
        'costo',
        'moneda',
        'dias_habiles_resolucion',
        'normativa_base',
        'url_formulario',
        'modalidad',
        'activo',
    ];

    protected $casts = [
        'costo' => 'decimal:2',
        'dias_habiles_resolucion' => 'integer',
        'activo' => 'boolean',
    ];

    public function tipoTramite(): BelongsTo
    {
        return $this->belongsTo(TipoTramite::class, 'tipo_tramite_id');
    }

    public function etapas(): HasMany
    {
        return $this->hasMany(TramiteEtapa::class, 'tramite_id')->orderBy('orden');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nombre);
            }
        });
    }
}
