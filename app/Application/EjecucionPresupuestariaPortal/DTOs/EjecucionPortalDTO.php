<?php

namespace App\Application\EjecucionPresupuestariaPortal\DTOs;

final readonly class EjecucionPortalDTO
{
    public function __construct(
        public int $id,
        public int $anio,
        public string $periodo,
        public ?int $mes,
        public ?int $trimestre,
        public ?int $semestre,
        public string $unidad_ejecutora,
        public ?string $programa,
        public ?string $fuente_financiamiento,
        public float $presupuesto_inicial,
        public float $presupuesto_vigente,
        public float $ejecutado,
        public float $porcentaje_ejecucion,
        public ?string $descripcion,
        public ?string $archivo_url,
        public ?string $archivo_nombre,
        public bool $publicado,
        public ?string $created_at,
    ) {}

    public static function fromModel(object $model): self
    {
        $vigente = (float) $model->presupuesto_vigente;
        $ejecutado = (float) $model->ejecutado;
        $porcentaje = $vigente > 0 ? round(($ejecutado / $vigente) * 100, 2) : 0;

        return new self(
            id: $model->id,
            anio: (int) $model->anio,
            periodo: $model->periodo,
            mes: $model->mes ? (int) $model->mes : null,
            trimestre: $model->trimestre ? (int) $model->trimestre : null,
            semestre: $model->semestre ? (int) $model->semestre : null,
            unidad_ejecutora: $model->unidad_ejecutora,
            programa: $model->programa,
            fuente_financiamiento: $model->fuente_financiamiento,
            presupuesto_inicial: (float) $model->presupuesto_inicial,
            presupuesto_vigente: $vigente,
            ejecutado: $ejecutado,
            porcentaje_ejecucion: $porcentaje,
            descripcion: $model->descripcion,
            archivo_url: $model->archivo_url,
            archivo_nombre: $model->archivo_nombre,
            publicado: (bool) $model->publicado,
            created_at: $model->created_at?->toIso8601String(),
        );
    }
}
