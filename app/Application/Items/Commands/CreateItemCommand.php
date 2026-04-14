<?php

namespace App\Application\Items\Commands;

final readonly class CreateItemCommand
{
    public function __construct(
        public string $nombre,
        public ?string $descripcion = null,
        public string $tipo = 'servicio',
        public ?float $precio = null,
        public ?string $imagen_url = null,
        public ?string $enlace_url = null,
        public int $orden = 0,
        public bool $publicado = false,
        public bool $activo = true,
    ) {}
}
