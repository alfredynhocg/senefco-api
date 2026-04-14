<?php

namespace App\Infrastructure\RedesSociales\Models;

use App\Domain\RedesSociales\Enums\TipoRedSocial;
use Illuminate\Database\Eloquent\Model;

class RedSocial extends Model
{
    public $timestamps = false;

    protected $table = 'redes_sociales';

    protected $fillable = [
        'plataforma',
        'url',
        'nombre_cuenta',
        'icono_clase',
        'activo',
        'orden',
    ];

    protected $casts = [
        'plataforma' => TipoRedSocial::class,
        'activo' => 'boolean',
        'orden' => 'integer',
    ];
}
