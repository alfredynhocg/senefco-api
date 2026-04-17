<?php

namespace App\Infrastructure\Subcenefcos\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcenefco extends Model
{
    protected $table = 'subcenefcos';

    public $timestamps = false; // Based on migration having only created_at

    protected $fillable = [
        'nombre',
        'zona_cobertura',
        'direccion_fisica',
        'telefono',
        'email',
        'imagen_url',
        'latitud',
        'longitud',
        'tramites_disponibles',
        'activa',
        'slug',
        'created_at',
    ];

    protected $casts = [
        'activa' => 'boolean',
        'latitud' => 'double',
        'longitud' => 'double',
        'created_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nombre);
            }
            if (empty($model->created_at)) {
                $model->created_at = now();
            }
        });
    }
}
