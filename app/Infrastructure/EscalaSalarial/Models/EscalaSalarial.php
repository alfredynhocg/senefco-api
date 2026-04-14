<?php

namespace App\Infrastructure\EscalaSalarial\Models;

use Illuminate\Database\Eloquent\Model;

class EscalaSalarial extends Model
{
    protected $table = 'escala_salarial';

    public $timestamps = false;

    protected $fillable = [
        'nivel',
        'descripcion_cargo',
        'sueldo_basico',
        'categoria',
    ];

    protected $casts = [
        'sueldo_basico' => 'decimal:2',
    ];
}
