<?php

namespace App\Application\PortalIndicadores\DTOs;

final readonly class PortalIndicadorDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public ?string $descripcion,
        public string $categoria,
        public string $unidad,
        public ?float $meta,
        public ?float $valor_actual,
        public ?string $periodo,
        public ?string $fecha_medicion,
        public string $estado,
        public ?string $responsable,
        public bool $publicado,
        public bool $activo,
        public ?string $created_at,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            nombre: $model->nombre,
            descripcion: $model->descripcion,
            categoria: $model->categoria,
            unidad: $model->unidad,
            meta: $model->meta !== null ? (float) $model->meta : null,
            valor_actual: $model->valor_actual !== null ? (float) $model->valor_actual : null,
            periodo: $model->periodo,
            fecha_medicion: $model->fecha_medicion?->toIso8601String(),
            estado: $model->estado,
            responsable: $model->responsable,
            publicado: (bool) $model->publicado,
            activo: (bool) $model->activo,
            created_at: $model->created_at?->toIso8601String(),
        );
    }
}
