<?php

namespace App\Application\RequisitosTramite\Commands;

final readonly class CreateRequisitoCommand
{
    public function __construct(
        public int $tramite_id,
        public string $nombre,
        public ?string $descripcion = null,
        public bool $obligatorio = true,
        public string $tipo = 'documento',
        public int $orden = 0,
    ) {}
}
