<?php

namespace App\Application\InformesAuditoria\Commands;

final readonly class CreateInformeAuditoriaCommand
{
    public function __construct(
        public string $nombre,
        public ?string $descripcion,
        public ?string $pdf_url,
        public ?string $pdf_nombre,
        public string $estado,
        public ?string $fecha,
        public int $anio,
        public bool $publicado_en_web,
        public ?int $publicado_por,
    ) {}
}
