<?php

namespace App\Infrastructure\IndicadoresGestion\Models;

use App\Infrastructure\CategoriasIndicador\Models\CategoriaIndicador;
use App\Infrastructure\ValoresIndicador\Models\ValorIndicador;
use Illuminate\Database\Eloquent\Model;

class IndicadorGestion extends Model
{
    protected $table = 'indicadores_gestion';

    public $timestamps = false;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'unidad_medida',
        'frecuencia_actualizacion',
        'publico',
        'activo',
        'orden_dashboard',
    ];

    protected $casts = [
        'categoria_id' => 'integer',
        'publico' => 'boolean',
        'activo' => 'boolean',
        'orden_dashboard' => 'integer',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaIndicador::class, 'categoria_id');
    }

    public function valores()
    {
        return $this->hasMany(ValorIndicador::class, 'indicador_id');
    }

    public function ultimoValor()
    {
        return $this->hasOne(ValorIndicador::class, 'indicador_id')->latest('gestion')->latest('mes')->latest('id');
    }
}
