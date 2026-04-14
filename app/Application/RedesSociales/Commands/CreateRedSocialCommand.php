<?php

namespace App\Application\RedesSociales\Commands;

use App\Shared\Kernel\Contracts\CommandInterface;

final readonly class CreateRedSocialCommand implements CommandInterface
{
    public function __construct(
        public string $plataforma,
        public string $url,
        public ?string $nombre_cuenta = null,
        public ?string $icono_clase = null,
        public bool $activo = true,
        public int $orden = 0,
    ) {}
}
