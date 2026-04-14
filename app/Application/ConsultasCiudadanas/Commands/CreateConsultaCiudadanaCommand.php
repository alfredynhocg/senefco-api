<?php

namespace App\Application\ConsultasCiudadanas\Commands;

final readonly class CreateConsultaCiudadanaCommand
{
    public function __construct(
        public string $ciudadano_nombre,
        public ?string $ciudadano_ci,
        public ?string $ciudadano_email,
        public ?string $ciudadano_telefono,
        public string $tipo,
        public string $asunto,
        public string $descripcion,
        public string $estado,
    ) {}
}
