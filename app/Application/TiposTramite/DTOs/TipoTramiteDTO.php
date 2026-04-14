<?php

namespace App\Application\TiposTramite\DTOs;

final readonly class TipoTramiteDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public ?string $slug,
        public ?string $icono_url,
        public ?string $color_hex,
        public bool $activo,
        public int $orden,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            nombre: $model->nombre,
            slug: $model->slug,
            icono_url: $model->icono_url,
            color_hex: $model->color_hex,
            activo: (bool) $model->activo,
            orden: (int) $model->orden,
        );
    }
}
