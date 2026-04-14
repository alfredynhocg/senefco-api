<?php

namespace App\Application\Presupuestos\Commands;

final readonly class CreatePresupuestoCommand
{
    public function __construct(
        public int $secretaria_id,
        public int $gestion,
        public float $monto_aprobado,
        public ?float $monto_modificado = null,
        public string $estado = 'aprobado',
        public ?string $documento_url = null,
        public ?string $fecha_aprobacion = null,
        public ?int $aprobado_por = null,
    ) {}
}
