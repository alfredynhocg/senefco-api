<?php

namespace App\Application\ConsultasCiudadanas\Commands;

final readonly class ResponderConsultaCommand
{
    public function __construct(
        public int $id,
        public string $respuesta,
        public string $estado,
    ) {}
}
