<?php

namespace App\Infrastructure\Items\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'descripcion', 'tipo', 'precio',
        'imagen_url', 'enlace_url', 'orden', 'publicado', 'activo',
    ];

    protected $casts = [
        'precio' => 'float',
        'orden' => 'integer',
        'publicado' => 'boolean',
        'activo' => 'boolean',
        'created_at' => 'datetime',
    ];
}
