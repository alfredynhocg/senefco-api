<?php

namespace App\Infrastructure\ManualesInstitucionales\Models;

use Illuminate\Database\Eloquent\Model;

class ManualInstitucional extends Model
{
    protected $table = 'manuales_institucionales';

    public $timestamps = false; // Note: Migration has created_at but not updated_at or total timestamps?
    // Let's check migration again: $table->timestampTz('created_at')->nullable()->useCurrent();
    // No updated_at.

    protected $fillable = [
        'tipo',
        'titulo',
        'descripcion',
        'archivo_url',
        'formato',
        'numero_paginas',
        'gestion',
        'version',
        'vigente',
        'publicado_por',
        'fecha_publicacion',
        'descargas',
    ];

    protected $casts = [
        'numero_paginas' => 'integer',
        'gestion' => 'integer',
        'version' => 'integer',
        'vigente' => 'boolean',
        'publicado_por' => 'integer',
        'fecha_publicacion' => 'date',
        'descargas' => 'integer',
    ];
}
