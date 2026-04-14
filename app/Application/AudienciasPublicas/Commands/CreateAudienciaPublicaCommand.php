<?php

namespace App\Application\AudienciasPublicas\Commands;

final readonly class CreateAudienciaPublicaCommand
{
    public function __construct(
        public string $titulo,
        public ?string $descripcion = null,
        public string $tipo = 'inicial',
        public string $estado = 'convocada',
        public ?string $acta_url = null,
        public ?string $afiche_url = null,
        public array $imagenes = [],
        public ?string $video_url = null,
        public ?string $enlace_virtual = null,
        public ?int $asistentes = null,
    ) {}
}
