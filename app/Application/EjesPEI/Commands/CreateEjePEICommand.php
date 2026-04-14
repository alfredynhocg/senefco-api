<?php

namespace App\Application\EjesPEI\Commands;

final readonly class CreateEjePEICommand
{
    public function __construct(
        public int $pei_id,
        public int $numero_eje,
        public string $nombre,
        public ?string $descripcion = null,
        public ?string $color_hex = null,
        public int $total_objetivos = 0,
    ) {}
}
