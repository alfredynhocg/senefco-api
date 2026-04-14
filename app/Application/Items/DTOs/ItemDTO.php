<?php

namespace App\Application\Items\DTOs;

final readonly class ItemDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public ?string $descripcion,
        public string $tipo,
        public ?float $precio,
        public ?string $imagen_url,
        public ?string $enlace_url,
        public int $orden,
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
            tipo: $model->tipo,
            precio: $model->precio !== null ? (float) $model->precio : null,
            imagen_url: $model->imagen_url,
            enlace_url: $model->enlace_url,
            orden: (int) $model->orden,
            publicado: (bool) $model->publicado,
            activo: (bool) $model->activo,
            created_at: $model->created_at?->toIso8601String(),
        );
    }
}
