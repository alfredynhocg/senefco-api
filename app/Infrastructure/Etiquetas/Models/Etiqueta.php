<?php

namespace App\Infrastructure\Etiquetas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Etiqueta extends Model
{
    protected $table = 'etiquetas';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'slug',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nombre);
            }
        });
    }
}
