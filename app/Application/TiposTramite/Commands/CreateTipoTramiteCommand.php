<?php

namespace App\Application\TiposTramite\Commands;

final readonly class CreateTipoTramiteCommand
{
    public function __construct(
        public string $nombre,
        public ?string $icono_url = null,
        public ?string $color_hex = null,
        public bool $activo = true,
        public int $orden = 0,
    ) {}
}
