<?php

namespace App\Application\AvanceProyecto\Commands;

final readonly class CreateAvanceProyectoCommand
{
    public function __construct(
        public int $proyecto_id,
        public float $porcentaje_fisico,
        public float $monto_financiero_ejecutado,
        public string $fecha_reporte,
        public ?string $descripcion_avance = null,
        public ?string $fotografia_url = null,
        public ?int $registrado_por = null,
    ) {}
}
