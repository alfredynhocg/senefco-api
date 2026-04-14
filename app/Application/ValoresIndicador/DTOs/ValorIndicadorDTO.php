<?php

namespace App\Application\ValoresIndicador\DTOs;

final readonly class ValorIndicadorDTO
{
    public function __construct(
        public int $id,
        public int $indicador_id,
        public float $valor,
        public ?int $mes,
        public int $gestion,
        public ?string $fecha_registro,
        public ?string $fuente,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            indicador_id: (int) $model->indicador_id,
            valor: (float) $model->valor,
            mes: $model->mes,
            gestion: (int) $model->gestion,
            fecha_registro: $model->fecha_registro?->toDateString(),
            fuente: $model->fuente,
        );
    }
}
