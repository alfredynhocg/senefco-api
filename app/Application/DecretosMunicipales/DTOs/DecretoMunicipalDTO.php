<?php

namespace App\Application\DecretosMunicipales\DTOs;

final readonly class DecretoMunicipalDTO
{
    public function __construct(
        public int $id,
        public string $numero,
        public string $tipo,
        public string $titulo,
        public string $slug,
        public ?string $descripcion,
        public ?string $pdf_url,
        public ?string $pdf_nombre,
        public string $estado,
        public ?string $fecha_promulgacion,
        public int $anio,
        public bool $publicado_en_web,
        public ?int $publicado_por,
        public ?string $created_at,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            numero: $model->numero,
            tipo: $model->tipo,
            titulo: $model->titulo,
            slug: $model->slug,
            descripcion: $model->descripcion,
            pdf_url: $model->pdf_url
                ? (str_starts_with($model->pdf_url, '/storage/') || str_starts_with($model->pdf_url, 'http')
                    ? $model->pdf_url
                    : '/storage/'.$model->pdf_url)
                : null,
            pdf_nombre: $model->pdf_nombre,
            estado: $model->estado,
            fecha_promulgacion: $model->fecha_promulgacion
                ? (is_string($model->fecha_promulgacion)
                    ? $model->fecha_promulgacion
                    : $model->fecha_promulgacion->toDateString())
                : null,
            anio: (int) $model->anio,
            publicado_en_web: (bool) $model->publicado_en_web,
            publicado_por: $model->publicado_por,
            created_at: $model->created_at?->toIso8601String(),
        );
    }
}
