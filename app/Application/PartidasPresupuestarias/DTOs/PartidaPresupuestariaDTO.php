<?php

namespace App\Application\PartidasPresupuestarias\DTOs;

final readonly class PartidaPresupuestariaDTO
{
    public function __construct(
        public int $id,
        public int $presupuesto_id,
        public string $codigo_partida,
        public ?string $descripcion,
        public float $monto_asignado,
        public float $monto_ejecutado,
        public ?string $categoria,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            presupuesto_id: (int) $model->presupuesto_id,
            codigo_partida: $model->codigo_partida,
            descripcion: $model->descripcion,
            monto_asignado: (float) $model->monto_asignado,
            monto_ejecutado: (float) ($model->monto_ejecutado ?? 0),
            categoria: $model->categoria,
        );
    }
}
