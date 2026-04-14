<?php

namespace App\Application\ConsultasCiudadanas\DTOs;

final readonly class ConsultaCiudadanaDTO
{
    public function __construct(
        public int $id,
        public string $ciudadano_nombre,
        public ?string $ciudadano_ci,
        public ?string $ciudadano_email,
        public ?string $ciudadano_telefono,
        public string $tipo,
        public string $asunto,
        public string $descripcion,
        public string $estado,
        public ?string $respuesta,
        public ?string $respondido_por,
        public ?string $respondido_at,
        public ?string $created_at,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            ciudadano_nombre: $model->ciudadano_nombre,
            ciudadano_ci: $model->ciudadano_ci,
            ciudadano_email: $model->ciudadano_email,
            ciudadano_telefono: $model->ciudadano_telefono,
            tipo: $model->tipo,
            asunto: $model->asunto,
            descripcion: $model->descripcion,
            estado: $model->estado,
            respuesta: $model->respuesta,
            respondido_por: $model->respondido_por,
            respondido_at: $model->respondido_at?->toIso8601String(),
            created_at: $model->created_at?->toIso8601String(),
        );
    }
}
