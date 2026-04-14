<?php

namespace App\Infrastructure\EstadosProyecto\Models;

use App\Infrastructure\Proyectos\Models\Proyecto;
use Illuminate\Database\Eloquent\Model;

class EstadoProyecto extends Model
{
    protected $table = 'estados_proyecto';

    public $timestamps = false;

    protected $fillable = ['nombre', 'color_hex', 'activo'];

    protected $casts = ['activo' => 'boolean'];

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'estado_id');
    }
}
