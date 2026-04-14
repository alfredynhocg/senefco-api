<?php

namespace App\Infrastructure\EjesPeiPortal\Models;

use Illuminate\Database\Eloquent\Model;

class EjePeiPortal extends Model
{
    protected $table = 'ejes_pei_portal';

    protected $fillable = [
        'nombre', 'descripcion', 'color', 'imagen_url', 'orden', 'activo',
    ];

    protected $casts = [
        'orden' => 'integer',
        'activo' => 'boolean',
    ];
}
