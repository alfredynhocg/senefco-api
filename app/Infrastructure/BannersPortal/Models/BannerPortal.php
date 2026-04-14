<?php

namespace App\Infrastructure\BannersPortal\Models;

use Illuminate\Database\Eloquent\Model;

class BannerPortal extends Model
{
    protected $table = 'banners';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen_url',
        'enlace_url',
        'fecha_inicio',
        'fecha_fin',
        'activo',
        'orden',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'activo' => 'boolean',
        'orden' => 'integer',
    ];
}
