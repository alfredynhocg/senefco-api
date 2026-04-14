<?php

namespace App\Infrastructure\UnidadesResponsables\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadResponsable extends Model
{
    protected $table = 'unidades_responsables';

    public $timestamps = false;

    protected $fillable = [
        'secretaria_id',
        'nombre',
        'direccion',
        'telefono',
        'email',
        'horario',
        'activa',
    ];

    protected $casts = [
        'activa' => 'boolean',
    ];

    public function secretaria()
    {
        return $this->belongsTo(\App\Infrastructure\Secretarias\Models\Secretaria::class, 'secretaria_id');
    }
}
