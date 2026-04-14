<?php

namespace App\Infrastructure\ValoresIndicador\Models;

use App\Infrastructure\IndicadoresGestion\Models\IndicadorGestion;
use Illuminate\Database\Eloquent\Model;

class ValorIndicador extends Model
{
    protected $table = 'valores_indicador';

    public $timestamps = false; // Migration has created_at only

    protected $fillable = [
        'indicador_id',
        'valor',
        'mes',
        'gestion',
        'fecha_registro',
        'fuente',
        'registrado_por',
    ];

    protected $casts = [
        'indicador_id' => 'integer',
        'valor' => 'decimal:4',
        'mes' => 'integer',
        'gestion' => 'integer',
        'fecha_registro' => 'date',
        'registrado_por' => 'integer',
    ];

    public function indicador()
    {
        return $this->belongsTo(IndicadorGestion::class, 'indicador_id');
    }
}
