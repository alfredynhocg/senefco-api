<?php

namespace App\Application\RedesSociales\DTOs;

final readonly class RedSocialDTO
{
    public function __construct(
        public int $id,
        public string $plataforma,
        public string $url,
        public ?string $nombre_cuenta,
        public ?string $icono_clase,
        public bool $activo,
        public int $orden,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            plataforma: $model->plataforma instanceof \BackedEnum ? $model->plataforma->value : $model->plataforma,
            url: $model->url,
            nombre_cuenta: $model->nombre_cuenta,
            icono_clase: $model->icono_clase,
            activo: (bool) $model->activo,
            orden: $model->orden,
        );
    }
}
