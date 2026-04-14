<?php

namespace App\Application\POA\Commands;

final readonly class CreatePOACommand
{
    public function __construct(
        public int $plan_gobierno_id,
        public int $secretaria_id,
        public int $gestion,
        public string $titulo,
        public ?string $documento_pdf_url = null,
        public ?string $resumen_ejecutivo_url = null,
        public string $estado = 'borrador',
        public ?int $aprobado_por = null,
        public ?string $fecha_aprobacion = null,
    ) {}
}
