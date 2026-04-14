<?php

namespace App\Application\Subsenefcos\DTOs;

final readonly class SubsenefcoDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public ?string $zona_cobertura,
        public ?string $direccion_fisica,
        public ?string $telefono,
        public ?string $email,
        public ?string $imagen_url,
        public ?float $latitud,
        public ?float $longitud,
        public ?string $tramites_disponibles,
        public bool $activa,
        public string $slug,
        public ?string $created_at,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            nombre: $model->nombre,
            zona_cobertura: $model->zona_cobertura,
            direccion_fisica: $model->direccion_fisica,
            telefono: $model->telefono,
            email: $model->email,
            imagen_url: $model->imagen_url,
            latitud: $model->latitud ? (float) $model->latitud : null,
            longitud: $model->longitud ? (float) $model->longitud : null,
            tramites_disponibles: $model->tramites_disponibles,
            activa: (bool) $model->activa,
            slug: $model->slug,
            created_at: $model->created_at?->toIso8601String(),
        );
    }
}
