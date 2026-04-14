<?php

namespace App\Application\NominaPersonal\Commands;

final readonly class CreateNominaPersonalCommand
{
    public function __construct(
        public int $secretaria_id,
        public string $nombre,
        public string $apellido,
        public string $cargo,
        public int $gestion,
        public ?string $ci = null,
        public ?string $nivel_salarial = null,
        public string $tipo_contrato = 'planta',
        public bool $activo = true,
        public ?int $usuario_id = null,
    ) {}
}
