<?php

namespace App\Application\EjesPeiPortal\DTOs;

final readonly class EjePeiPortalDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public ?string $descripcion,
        public ?string $color,
        public ?string $imagen_url,
        public int $orden,
        public bool $activo,
        public ?string $created_at,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            nombre: $model->nombre,
            descripcion: $model->descripcion,
            color: $model->color,
            imagen_url: $model->imagen_url,
            orden: (int) $model->orden,
            activo: (bool) $model->activo,
            created_at: $model->created_at?->toIso8601String(),
        );
    }
}
