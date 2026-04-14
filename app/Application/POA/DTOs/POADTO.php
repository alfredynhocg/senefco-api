<?php

namespace App\Application\POA\DTOs;

final readonly class POADTO
{
    public function __construct(
        public int $id,
        public int $plan_gobierno_id,
        public int $secretaria_id,
        public int $gestion,
        public string $titulo,
        public ?string $documento_pdf_url,
        public ?string $resumen_ejecutivo_url,
        public string $estado,
        public ?int $aprobado_por,
        public ?string $fecha_aprobacion,
        public ?string $created_at,
        public ?string $secretaria_nombre = null,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            plan_gobierno_id: (int) $model->plan_gobierno_id,
            secretaria_id: (int) $model->secretaria_id,
            gestion: (int) $model->gestion,
            titulo: $model->titulo,
            documento_pdf_url: $model->documento_pdf_url,
            resumen_ejecutivo_url: $model->resumen_ejecutivo_url,
            estado: $model->estado,
            aprobado_por: $model->aprobado_por ? (int) $model->aprobado_por : null,
            fecha_aprobacion: $model->fecha_aprobacion?->toDateString(),
            created_at: $model->created_at?->toIso8601String(),
            secretaria_nombre: $model->secretaria?->nombre,
        );
    }
}
