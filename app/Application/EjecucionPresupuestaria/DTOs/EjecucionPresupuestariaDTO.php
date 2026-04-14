<?php

namespace App\Application\EjecucionPresupuestaria\DTOs;

final readonly class EjecucionPresupuestariaDTO
{
    public function __construct(
        public int $id,
        public int $partida_id,
        public ?int $proyecto_id,
        public float $monto_devengado,
        public ?float $monto_pagado,
        public int $mes,
        public int $gestion,
        public ?string $descripcion_gasto,
        public ?string $fecha_registro,
        public ?int $registrado_por,
        public ?string $created_at,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            partida_id: (int) $model->partida_id,
            proyecto_id: $model->proyecto_id ? (int) $model->proyecto_id : null,
            monto_devengado: (float) $model->monto_devengado,
            monto_pagado: $model->monto_pagado ? (float) $model->monto_pagado : null,
            mes: (int) $model->mes,
            gestion: (int) $model->gestion,
            descripcion_gasto: $model->descripcion_gasto,
            fecha_registro: $model->fecha_registro?->toDateString(),
            registrado_por: $model->registrado_por ? (int) $model->registrado_por : null,
            created_at: $model->created_at?->toIso8601String(),
        );
    }
}
