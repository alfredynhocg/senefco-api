<?php

namespace App\Application\PEI\Commands;

final readonly class CreatePEICommand
{
    public function __construct(
        public string $titulo,
        public int $anio_inicio,
        public int $anio_fin,
        public ?string $descripcion = null,
        public ?string $documento_pdf_url = null,
        public string $estado = 'borrador',
        public ?int $aprobado_por = null,
        public ?string $fecha_aprobacion = null,
        public bool $vigente = true,
    ) {}
}
