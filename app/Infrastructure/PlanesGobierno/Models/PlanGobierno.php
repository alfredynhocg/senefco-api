<?php

namespace App\Infrastructure\PlanesGobierno\Models;

use Illuminate\Database\Eloquent\Model;

class PlanGobierno extends Model
{
    protected $table = 'planes_gobierno';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'gestion_inicio',
        'gestion_fin',
        'descripcion',
        'documento_pdf_url',
        'publicado_por',
        'vigente',
    ];

    protected $casts = [
        'gestion_inicio' => 'integer',
        'gestion_fin' => 'integer',
        'publicado_por' => 'integer',
        'vigente' => 'boolean',
    ];
}
