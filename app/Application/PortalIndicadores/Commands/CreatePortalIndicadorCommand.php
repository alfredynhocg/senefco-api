<?php

namespace App\Application\PortalIndicadores\Commands;

final readonly class CreatePortalIndicadorCommand
{
    public function __construct(
        public string $nombre,
        public ?string $descripcion = null,
        public string $categoria = 'otro',
        public string $unidad = '%',
        public ?float $meta = null,
        public ?float $valor_actual = null,
        public ?string $periodo = null,
        public ?string $fecha_medicion = null,
        public string $estado = 'sin_dato',
        public ?string $responsable = null,
        public bool $publicado = false,
        public bool $activo = true,
    ) {}
}
