<?php

namespace App\Application\UnidadesResponsables\Commands;

final readonly class CreateUnidadResponsableCommand
{
    public function __construct(
        public int $secretaria_id,
        public string $nombre,
        public ?string $direccion = null,
        public ?string $telefono = null,
        public ?string $email = null,
        public ?string $horario = null,
        public bool $activa = true,
    ) {}
}
