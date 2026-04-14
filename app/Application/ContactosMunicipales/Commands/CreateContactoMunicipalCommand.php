<?php

namespace App\Application\ContactosMunicipales\Commands;

final readonly class CreateContactoMunicipalCommand
{
    public function __construct(
        public string $nombre_area,
        public ?string $telefono = null,
        public ?string $interno = null,
        public ?string $encargado = null,
        public int $orden = 0,
        public bool $activo = true,
    ) {}
}
