<?php

namespace App\Application\PlanesGobierno\Commands;

final readonly class CreatePlanGobiernoCommand
{
    public function __construct(
        public string $titulo,
        public int $gestion_inicio,
        public int $gestion_fin,
        public ?string $descripcion = null,
        public ?string $documento_pdf_url = null,
        public ?int $publicado_por = null,
        public bool $vigente = true,
    ) {}
}
