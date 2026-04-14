<?php

namespace App\Application\BannersPortal\DTOs;

final readonly class BannerPortalDTO
{
    public function __construct(
        public int $id,
        public ?string $titulo,
        public ?string $descripcion,
        public string $imagen_url,
        public ?string $enlace_url,
        public ?string $fecha_inicio,
        public ?string $fecha_fin,
        public bool $activo,
        public int $orden,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            titulo: $model->titulo,
            descripcion: $model->descripcion,
            imagen_url: $model->imagen_url,
            enlace_url: $model->enlace_url,
            fecha_inicio: $model->fecha_inicio?->toDateString(),
            fecha_fin: $model->fecha_fin?->toDateString(),
            activo: (bool) $model->activo,
            orden: (int) $model->orden,
        );
    }
}
