<?php

namespace App\Infrastructure\ContactosMunicipales\Models;

use Illuminate\Database\Eloquent\Model;

class ContactoMunicipal extends Model
{
    protected $table = 'contactos_municipales';

    public $timestamps = false;

    protected $fillable = [
        'nombre_area',
        'telefono',
        'interno',
        'encargado',
        'orden',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'orden' => 'integer',
    ];
}
