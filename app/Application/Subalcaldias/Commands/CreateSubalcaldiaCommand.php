<?php

namespace App\Application\Subcenefcos\Commands;

final readonly class CreateSubcenefcoCommand
{
    public function __construct(
        public string $nombre,
        public ?string $zona_cobertura = null,
        public ?string $direccion_fisica = null,
        public ?string $telefono = null,
        public ?string $email = null,
        public ?string $imagen_url = null,
        public ?float $latitud = null,
        public ?float $longitud = null,
        public ?string $tramites_disponibles = null,
        public bool $activa = true,
    ) {}
}
