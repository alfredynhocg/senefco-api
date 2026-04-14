<?php

namespace App\Application\PreguntasFrecuentes\Commands;

final readonly class UpdatePreguntaFrecuenteCommand
{
    public function __construct(
        public int $id,
        public string $pregunta,
        public string $respuesta,
        public ?string $categoria = null,
        public int $orden = 0,
        public bool $activo = true,
    ) {}
}
