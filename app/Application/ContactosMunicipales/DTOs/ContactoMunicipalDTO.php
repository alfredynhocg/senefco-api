<?php

namespace App\Application\ContactosMunicipales\DTOs;

final readonly class ContactoMunicipalDTO
{
    public function __construct(
        public int $id,
        public string $nombre_area,
        public ?string $telefono,
        public ?string $interno,
        public ?string $encargado,
        public int $orden,
        public bool $activo,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            nombre_area: $model->nombre_area,
            telefono: $model->telefono,
            interno: $model->interno,
            encargado: $model->encargado,
            orden: (int) $model->orden,
            activo: (bool) $model->activo,
        );
    }
}
