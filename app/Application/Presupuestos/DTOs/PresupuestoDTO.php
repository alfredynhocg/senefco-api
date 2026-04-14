<?php

namespace App\Application\Presupuestos\DTOs;

final readonly class PresupuestoDTO
{
    public function __construct(
        public int $id,
        public int $secretaria_id,
        public int $gestion,
        public float $monto_aprobado,
        public ?float $monto_modificado,
        public string $estado,
        public ?string $documento_url,
        public ?string $fecha_aprobacion,
        public ?int $aprobado_por,
        public ?string $created_at,
        public ?string $secretaria_nombre = null,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            secretaria_id: (int) $model->secretaria_id,
            gestion: (int) $model->gestion,
            monto_aprobado: (float) $model->monto_aprobado,
            monto_modificado: $model->monto_modificado ? (float) $model->monto_modificado : null,
            estado: $model->estado,
            documento_url: $model->documento_url,
            fecha_aprobacion: $model->fecha_aprobacion?->toDateString(),
            aprobado_por: $model->aprobado_por ? (int) $model->aprobado_por : null,
            created_at: $model->created_at?->toIso8601String(),
            secretaria_nombre: $model->secretaria?->nombre,
        );
    }
}
