<?php

namespace App\Infrastructure\Auditorias\Models;

use App\Infrastructure\HallazgosAuditoria\Models\HallazgoAuditoria;
use App\Infrastructure\Secretarias\Models\Secretaria;
use App\Infrastructure\TiposAuditoria\Models\TipoAuditoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Auditoria extends Model
{
    protected $table = 'auditorias';

    protected $fillable = [
        'tipo_auditoria_id',
        'secretaria_auditada_id',
        'publicado_por',
        'codigo_auditoria',
        'titulo',
        'objeto_examen',
        'entidad_auditora',
        'gestion_auditada',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'informe_pdf_url',
        'imagen_url',
        'publico',
        'activo',
        'slug',
    ];

    protected $casts = [
        'tipo_auditoria_id' => 'integer',
        'secretaria_auditada_id' => 'integer',
        'publicado_por' => 'integer',
        'gestion_auditada' => 'integer',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'publico' => 'boolean',
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->codigo_auditoria.'-'.$model->titulo);
            }
        });
    }

    public function tipo()
    {
        return $this->belongsTo(TipoAuditoria::class, 'tipo_auditoria_id');
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_auditada_id');
    }

    public function hallazgos()
    {
        return $this->hasMany(HallazgoAuditoria::class, 'auditoria_id');
    }
}
