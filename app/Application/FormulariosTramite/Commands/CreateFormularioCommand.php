<?php

namespace App\Application\FormulariosTramite\Commands;

final readonly class CreateFormularioCommand
{
    public function __construct(
        public int $tramite_id,
        public string $nombre,
        public string $archivo_url,
        public string $formato = 'PDF',
        public ?string $fecha_actualizacion = null,
        public bool $activo = true,
    ) {}
}
