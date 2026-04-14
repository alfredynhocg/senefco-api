<?php

namespace App\Infrastructure\Eventos\Models;

use App\Infrastructure\TiposEvento\Models\TipoEvento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Evento extends Model
{
    protected $table = 'eventos';

    public $timestamps = false;

    protected $fillable = [
        'tipo_evento_id',
        'creado_por',
        'titulo',
        'slug',
        'descripcion',
        'lugar',
        'latitud',
        'longitud',
        'fecha_inicio',
        'fecha_fin',
        'todo_el_dia',
        'estado',
        'url_transmision',
        'publico',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'created_at' => 'datetime',
        'todo_el_dia' => 'boolean',
        'publico' => 'boolean',
        'latitud' => 'double',
        'longitud' => 'double',
    ];

    public function tipoEvento(): BelongsTo
    {
        return $this->belongsTo(TipoEvento::class, 'tipo_evento_id');
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->titulo);
            }
        });
    }
}
