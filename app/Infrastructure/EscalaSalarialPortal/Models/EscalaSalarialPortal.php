<?php

namespace App\Infrastructure\EscalaSalarialPortal\Models;

use Illuminate\Database\Eloquent\Model;

class EscalaSalarialPortal extends Model
{
    protected $table = 'escala_salarial_portal';

    protected $fillable = [
        'anio', 'secretaria', 'cargo', 'nivel', 'categoria',
        'salario_basico', 'bono_antiguedad', 'bono_produccion', 'otros_bonos', 'publicado',
    ];

    protected $casts = [
        'anio' => 'integer',
        'salario_basico' => 'float',
        'bono_antiguedad' => 'float',
        'bono_produccion' => 'float',
        'otros_bonos' => 'float',
        'publicado' => 'boolean',
    ];
}
