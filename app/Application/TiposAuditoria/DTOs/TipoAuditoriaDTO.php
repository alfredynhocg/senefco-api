<?php

namespace App\Application\TiposAuditoria\DTOs;

final readonly class TipoAuditoriaDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public ?string $descripcion,
        public bool $activo,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            nombre: $model->nombre,
            descripcion: $model->descripcion,
            activo: (bool) $model->activo,
        );
    }
}
