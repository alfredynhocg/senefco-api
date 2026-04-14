<?php

namespace App\Application\FormulariosTramite\DTOs;

final readonly class FormularioDTO
{
    public function __construct(
        public int $id,
        public int $tramite_id,
        public string $nombre,
        public string $archivo_url,
        public string $formato,
        public ?string $fecha_actualizacion,
        public bool $activo,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            tramite_id: (int) $model->tramite_id,
            nombre: $model->nombre,
            archivo_url: $model->archivo_url,
            formato: $model->formato,
            fecha_actualizacion: $model->fecha_actualizacion?->toDateString(),
            activo: (bool) $model->activo,
        );
    }
}
