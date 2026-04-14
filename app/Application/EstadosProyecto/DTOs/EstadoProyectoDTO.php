<?php

namespace App\Application\EstadosProyecto\DTOs;

final readonly class EstadoProyectoDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public ?string $color_hex,
        public bool $activo,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            nombre: $model->nombre,
            color_hex: $model->color_hex,
            activo: (bool) $model->activo,
        );
    }
}
