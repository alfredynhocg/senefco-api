<?php

namespace App\Infrastructure\TiposTramite\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TipoTramite extends Model
{
    protected $table = 'tipos_tramite';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'slug',
        'icono_url',
        'color_hex',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'orden' => 'integer',
    ];

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
