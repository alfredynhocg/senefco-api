<?php

namespace App\Infrastructure\CategoriasIndicador\Models;

use App\Infrastructure\IndicadoresGestion\Models\IndicadorGestion;
use Illuminate\Database\Eloquent\Model;

class CategoriaIndicador extends Model
{
    protected $table = 'categorias_indicador';

    public $timestamps = false;

    protected $fillable = ['nombre', 'icono', 'color_hex', 'activa'];

    protected $casts = ['activa' => 'boolean'];

    public function indicadores()
    {
        return $this->hasMany(IndicadorGestion::class, 'categoria_id');
    }
}
