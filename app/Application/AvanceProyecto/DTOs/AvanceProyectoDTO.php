<?php

namespace App\Application\AvanceProyecto\DTOs;

final readonly class AvanceProyectoDTO
{
    public function __construct(
        public int $id,
        public int $proyecto_id,
        public float $porcentaje_fisico,
        public float $monto_financiero_ejecutado,
        public ?string $descripcion_avance,
        public string $fecha_reporte,
        public ?string $fotografia_url,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            proyecto_id: (int) $model->proyecto_id,
            porcentaje_fisico: (float) $model->porcentaje_fisico,
            monto_financiero_ejecutado: (float) $model->monto_financiero_ejecutado,
            descripcion_avance: $model->descripcion_avance,
            fecha_reporte: $model->fecha_reporte->toDateString(),
            fotografia_url: $model->fotografia_url,
        );
    }
}
