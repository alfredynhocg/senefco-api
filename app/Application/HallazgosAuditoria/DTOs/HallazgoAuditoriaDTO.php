<?php

namespace App\Application\HallazgosAuditoria\DTOs;

final readonly class HallazgoAuditoriaDTO
{
    public function __construct(
        public int $id,
        public int $auditoria_id,
        public string $tipo,
        public string $descripcion,
        public ?string $recomendacion,
        public string $estado_seguimiento,
        public ?int $secretaria_id,
        public ?string $secretaria_nombre,
        public ?string $fecha_limite,
        public ?string $respuesta_unidad,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            auditoria_id: (int) $model->auditoria_id,
            tipo: $model->tipo,
            descripcion: $model->descripcion,
            recomendacion: $model->recomendacion,
            estado_seguimiento: $model->estado_seguimiento,
            secretaria_id: $model->secretaria_responsable_id,
            secretaria_nombre: $model->secretariaResponsable?->nombre,
            fecha_limite: $model->fecha_limite?->toDateString(),
            respuesta_unidad: $model->respuesta_unidad,
        );
    }
}
