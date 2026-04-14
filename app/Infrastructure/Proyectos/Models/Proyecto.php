<?php

namespace App\Infrastructure\Proyectos\Models;

use App\Infrastructure\AvanceProyecto\Models\AvanceProyecto;
use App\Infrastructure\EstadosProyecto\Models\EstadoProyecto;
use App\Infrastructure\Secretarias\Models\Secretaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'codigo_sipfe',
        'estado_id',
        'secretaria_id',
        'nombre',
        'slug',
        'descripcion',
        'presupuesto_total',
        'ubicacion_texto',
        'latitud',
        'longitud',
        'contratista',
        'fecha_inicio_estimada',
        'fecha_fin_estimada',
        'imagen_portada_url',
        'publico',
    ];

    protected $casts = [
        'estado_id' => 'integer',
        'secretaria_id' => 'integer',
        'presupuesto_total' => 'decimal:2',
        'latitud' => 'decimal:8',
        'longitud' => 'decimal:8',
        'fecha_inicio_estimada' => 'date',
        'fecha_fin_estimada' => 'date',
        'publico' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn ($m) => $m->slug = $m->slug ?? Str::slug($m->nombre));
    }

    public function estado()
    {
        return $this->belongsTo(EstadoProyecto::class, 'estado_id');
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_id');
    }

    public function avances()
    {
        return $this->hasMany(AvanceProyecto::class, 'proyecto_id');
    }

    public function ultimoAvance()
    {
        return $this->hasOne(AvanceProyecto::class, 'proyecto_id')->latest('fecha_reporte')->latest('id');
    }
}
