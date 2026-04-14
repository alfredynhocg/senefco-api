<?php

namespace App\Infrastructure\AudienciasPublicas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AudienciaPublica extends Model
{
    protected $table = 'audiencias_publicas';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'estado',
        'acta_url',
        'afiche_url',
        'imagenes',
        'video_url',
        'enlace_virtual',
        'asistentes',
        'activo',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'imagenes' => 'array',
        'activo' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->titulo).'-'.time();
            }
        });
    }
}
