<?php

namespace App\Application\InformesAuditoria\DTOs;

final readonly class InformeAuditoriaDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public string $slug,
        public ?string $descripcion,
        public ?string $pdf_url,
        public ?string $pdf_nombre,
        public string $estado,
        public ?string $fecha,
        public int $anio,
        public bool $publicado_en_web,
        public ?int $publicado_por,
        public ?string $created_at,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id:               $model->id,
            nombre:           $model->nombre,
            slug:             $model->slug,
            descripcion:      $model->descripcion,
            pdf_url:          $model->pdf_url
                ? (str_starts_with($model->pdf_url, '/storage/') || str_starts_with($model->pdf_url, 'http')
                    ? $model->pdf_url
                    : '/storage/'.$model->pdf_url)
                : null,
            pdf_nombre:       $model->pdf_nombre,
            estado:           $model->estado,
            fecha:            $model->fecha
                ? (is_string($model->fecha) ? $model->fecha : $model->fecha->toDateString())
                : null,
            anio:             (int) $model->anio,
            publicado_en_web: (bool) $model->publicado_en_web,
            publicado_por:    $model->publicado_por,
            created_at:       $model->created_at?->toIso8601String(),
        );
    }
}
