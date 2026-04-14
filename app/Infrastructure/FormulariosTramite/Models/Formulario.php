<?php

namespace App\Infrastructure\FormulariosTramite\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $table = 'formularios_tramite';

    public $timestamps = false;

    protected $fillable = [
        'tramite_id',
        'nombre',
        'archivo_url',
        'formato',
        'fecha_actualizacion',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_actualizacion' => 'date',
    ];
}
