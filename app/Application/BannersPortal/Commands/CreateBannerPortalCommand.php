<?php

namespace App\Application\BannersPortal\Commands;

final readonly class CreateBannerPortalCommand
{
    public function __construct(
        public ?string $titulo,
        public ?string $descripcion,
        public string $imagen_url,
        public ?string $enlace_url = null,
        public ?string $fecha_inicio = null,
        public ?string $fecha_fin = null,
        public bool $activo = true,
        public int $orden = 0,
    ) {}
}
