<?php

namespace App\Application\NominaPersonal\DTOs;

final readonly class NominaPersonalDTO
{
    public function __construct(
        public int $id,
        public ?int $usuario_id,
        public int $secretaria_id,
        public string $nombre,
        public string $apellido,
        public ?string $ci,
        public string $cargo,
        public ?string $nivel_salarial,
        public string $tipo_contrato,
        public int $gestion,
        public bool $activo,
        public ?string $created_at,
        public ?string $secretaria_nombre = null,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            usuario_id: $model->usuario_id ? (int) $model->usuario_id : null,
            secretaria_id: (int) $model->secretaria_id,
            nombre: $model->nombre,
            apellido: $model->apellido,
            ci: $model->ci,
            cargo: $model->cargo,
            nivel_salarial: $model->nivel_salarial,
            tipo_contrato: $model->tipo_contrato,
            gestion: (int) $model->gestion,
            activo: (bool) $model->activo,
            created_at: $model->created_at?->toIso8601String(),
            secretaria_nombre: $model->secretaria?->nombre,
        );
    }
}
