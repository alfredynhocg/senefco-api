<?php

namespace App\Application\HallazgosAuditoria\Commands;

final readonly class CreateHallazgoAuditoriaCommand
{
    public function __construct(
        public int $auditoria_id,
        public string $descripcion,
        public string $tipo = 'hallazgo',
        public ?string $recomendacion = null,
        public string $estado_seguimiento = 'pendiente',
        public ?int $secretaria_responsable_id = null,
        public ?string $fecha_limite = null,
    ) {}
}
