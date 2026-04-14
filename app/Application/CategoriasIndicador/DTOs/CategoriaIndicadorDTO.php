<?php

namespace App\Application\CategoriasIndicador\DTOs;

final readonly class CategoriaIndicadorDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public ?string $icono,
        public ?string $color_hex,
        public bool $activa,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            nombre: $model->nombre,
            icono: $model->icono,
            color_hex: $model->color_hex,
            activa: (bool) $model->activa,
        );
    }
}
