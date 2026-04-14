<?php

namespace App\Application\IndicadoresGestion\Commands;

final readonly class CreateIndicadorCommand
{
    public function __construct(
        public int $categoria_id,
        public string $nombre,
        public ?string $descripcion = null,
        public ?string $unidad_medida = null,
        public ?string $frecuencia_actualizacion = null,
        public bool $publico = true,
        public bool $activo = true,
        public int $orden_dashboard = 0,
    ) {}
}
