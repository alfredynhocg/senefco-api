<?php

namespace App\Infrastructure\TiposAuditoria\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAuditoria extends Model
{
    protected $table = 'tipos_auditoria';

    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion', 'activo'];

    protected $casts = ['activo' => 'boolean'];
}
