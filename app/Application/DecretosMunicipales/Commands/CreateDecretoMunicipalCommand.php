<?php

namespace App\Application\DecretosMunicipales\Commands;

final readonly class CreateDecretoMunicipalCommand
{
    public function __construct(
        public string $numero,
        public string $tipo,
        public string $titulo,
        public ?string $descripcion,
        public ?string $pdf_url,
        public ?string $pdf_nombre,
        public string $estado,
        public ?string $fecha_promulgacion,
        public int $anio,
        public bool $publicado_en_web,
        public ?int $publicado_por,
    ) {}
}
