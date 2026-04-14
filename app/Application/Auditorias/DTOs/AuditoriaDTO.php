<?php

namespace App\Application\Auditorias\DTOs;

final readonly class AuditoriaDTO
{
    public function __construct(
        public int $id,
        public int $tipo_auditoria_id,
        public string $tipo_nombre,
        public ?int $secretaria_id,
        public ?string $secretaria_nombre,
        public string $codigo_auditoria,
        public string $titulo,
        public ?string $objeto_examen,
        public ?string $entidad_auditora,
        public ?int $gestion_auditada,
        public ?string $fecha_inicio,
        public ?string $fecha_fin,
        public string $estado,
        public ?string $informe_pdf_url,
        public bool $publico,
        public string $slug,
        public ?string $imagen_url,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            tipo_auditoria_id: (int) $model->tipo_auditoria_id,
            tipo_nombre: $model->tipo?->nombre ?? '',
            secretaria_id: $model->secretaria_auditada_id,
            secretaria_nombre: $model->secretaria?->nombre,
            codigo_auditoria: $model->codigo_auditoria,
            titulo: $model->titulo,
            objeto_examen: $model->objeto_examen,
            entidad_auditora: $model->entidad_auditora,
            gestion_auditada: $model->gestion_auditada,
            fecha_inicio: $model->fecha_inicio?->toDateString(),
            fecha_fin: $model->fecha_fin?->toDateString(),
            estado: $model->estado,
            informe_pdf_url: $model->informe_pdf_url,
            publico: (bool) $model->publico,
            slug: $model->slug,
            imagen_url: $model->imagen_url,
        );
    }
}
