<?php

namespace App\Application\AudienciasPublicas\DTOs;

final readonly class AudienciaPublicaDTO
{
    public function __construct(
        public int $id,
        public string $titulo,
        public ?string $descripcion,
        public string $tipo,
        public string $estado,
        public ?string $acta_url,
        public ?string $afiche_url,
        public array $imagenes,
        public ?string $video_url,
        public ?string $enlace_virtual,
        public ?int $asistentes,
        public ?string $slug,
        public ?string $created_at,
        public ?string $secretaria_nombre = null,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            titulo: $model->titulo,
            descripcion: $model->descripcion,
            tipo: $model->tipo,
            estado: $model->estado,
            acta_url: $model->acta_url,
            afiche_url: $model->afiche_url,
            imagenes: $model->imagenes ?? [],
            video_url: $model->video_url,
            enlace_virtual: $model->enlace_virtual,
            asistentes: $model->asistentes ? (int) $model->asistentes : null,
            slug: $model->slug,
            created_at: $model->created_at?->toIso8601String(),
            secretaria_nombre: null,
        );
    }
}
