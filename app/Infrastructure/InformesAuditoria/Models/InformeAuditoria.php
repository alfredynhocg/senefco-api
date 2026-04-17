<?php

namespace App\Infrastructure\InformesAuditoria\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class InformeAuditoria extends Model
{
    use SoftDeletes;

    protected $table = 'informes_auditoria';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'pdf_url',
        'pdf_nombre',
        'estado',
        'fecha',
        'anio',
        'publicado_en_web',
        'publicado_por',
    ];

    protected $casts = [
        'fecha' => 'date',
        'publicado_en_web' => 'boolean',
        'anio' => 'integer',
        'publicado_por' => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $base = Str::slug($model->nombre);
                $slug = $base;
                $i = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $base.'-'.$i++;
                }
                $model->slug = $slug;
            }
        });
    }
}
