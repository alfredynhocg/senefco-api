<?php

namespace App\Application\PlanesGobierno\DTOs;

final readonly class PlanGobiernoDTO
{
    public function __construct(
        public int $id,
        public string $titulo,
        public int $gestion_inicio,
        public int $gestion_fin,
        public ?string $descripcion,
        public ?string $documento_pdf_url,
        public bool $vigente,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            titulo: $model->titulo,
            gestion_inicio: (int) $model->gestion_inicio,
            gestion_fin: (int) $model->gestion_fin,
            descripcion: $model->descripcion,
            documento_pdf_url: $model->documento_pdf_url,
            vigente: (bool) $model->vigente,
        );
    }
}
