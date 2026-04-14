<?php

namespace App\Application\TramitesCatalogo\DTOs;

final readonly class TramiteDTO
{
    public function __construct(
        public int $id,
        public int $tipo_tramite_id,
        public int $unidad_responsable_id,
        public ?int $creado_por,
        public string $nombre,
        public string $slug,
        public ?string $descripcion,
        public ?string $procedimiento,
        public ?float $costo,
        public string $moneda,
        public ?int $dias_habiles_resolucion,
        public ?string $normativa_base,
        public ?string $url_formulario,
        public string $modalidad,
        public bool $activo,
        public ?string $created_at,
        public ?string $tipo_nombre = null,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            tipo_tramite_id: (int) $model->tipo_tramite_id,
            unidad_responsable_id: (int) $model->unidad_responsable_id,
            creado_por: $model->creado_por ? (int) $model->creado_por : null,
            nombre: $model->nombre,
            slug: $model->slug,
            descripcion: $model->descripcion,
            procedimiento: $model->procedimiento,
            costo: $model->costo ? (float) $model->costo : null,
            moneda: $model->moneda,
            dias_habiles_resolucion: $model->dias_habiles_resolucion ? (int) $model->dias_habiles_resolucion : null,
            normativa_base: $model->normativa_base,
            url_formulario: $model->url_formulario,
            modalidad: $model->modalidad,
            activo: (bool) $model->activo,
            created_at: $model->created_at?->toIso8601String(),
            tipo_nombre: $model->tipoTramite?->nombre,
        );
    }
}
