<?php

namespace App\Application\PEI\DTOs;

final readonly class PEIDTO
{
    public function __construct(
        public int $id,
        public string $titulo,
        public int $anio_inicio,
        public int $anio_fin,
        public ?string $descripcion,
        public ?string $documento_pdf_url,
        public string $estado,
        public ?string $fecha_aprobacion,
        public bool $vigente,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            titulo: $model->titulo,
            anio_inicio: (int) $model->anio_inicio,
            anio_fin: (int) $model->anio_fin,
            descripcion: $model->descripcion,
            documento_pdf_url: $model->documento_pdf_url,
            estado: $model->estado,
            fecha_aprobacion: $model->fecha_aprobacion?->toDateString(),
            vigente: (bool) $model->vigente,
        );
    }
}
