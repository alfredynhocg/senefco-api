<?php

namespace App\Application\RequisitosTramite\DTOs;

final readonly class RequisitoDTO
{
    public function __construct(
        public int $id,
        public int $tramite_id,
        public string $nombre,
        public ?string $descripcion,
        public bool $obligatorio,
        public string $tipo,
        public int $orden,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            tramite_id: (int) $model->tramite_id,
            nombre: $model->nombre,
            descripcion: $model->descripcion,
            obligatorio: (bool) $model->obligatorio,
            tipo: $model->tipo,
            orden: (int) $model->orden,
        );
    }
}
