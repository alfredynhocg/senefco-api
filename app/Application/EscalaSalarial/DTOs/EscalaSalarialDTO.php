<?php

namespace App\Application\EscalaSalarial\DTOs;

final readonly class EscalaSalarialDTO
{
    public function __construct(
        public int $id,
        public string $nivel,
        public string $descripcion_cargo,
        public float $sueldo_basico,
        public ?string $categoria,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            nivel: $model->nivel,
            descripcion_cargo: $model->descripcion_cargo,
            sueldo_basico: (float) $model->sueldo_basico,
            categoria: $model->categoria,
        );
    }
}
