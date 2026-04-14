<?php

namespace App\Infrastructure\DecretosMunicipales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class DecretoMunicipal extends Model
{
    use SoftDeletes;

    protected $table = 'decretos_municipales';

    protected $fillable = [
        'numero',
        'tipo',
        'titulo',
        'slug',
        'descripcion',
        'pdf_url',
        'pdf_nombre',
        'estado',
        'fecha_promulgacion',
        'anio',
        'publicado_en_web',
        'publicado_por',
    ];

    protected $casts = [
        'publicado_en_web'   => 'boolean',
        'fecha_promulgacion' => 'date',
        'anio'               => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->numero.'-'.$model->titulo);
            }
        });
    }
}
