<?php

namespace App\Infrastructure\RequisitosTramite\Models;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    protected $table = 'requisitos_tramite';

    public $timestamps = false;

    protected $fillable = [
        'tramite_id',
        'nombre',
        'descripcion',
        'obligatorio',
        'tipo',
        'orden',
    ];

    protected $casts = [
        'obligatorio' => 'boolean',
        'orden' => 'integer',
    ];
}
