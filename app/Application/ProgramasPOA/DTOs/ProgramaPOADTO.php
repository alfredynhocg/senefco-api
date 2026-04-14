<?php

namespace App\Application\ProgramasPOA\DTOs;

final readonly class ProgramaPOADTO
{
    public function __construct(
        public int $id,
        public int $poa_id,
        public string $nombre,
        public ?string $descripcion,
        public ?float $presupuesto_asignado,
        public ?int $meta_indicador,
        public ?string $unidad_medida,
        public string $estado,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: (int) $model->id,
            poa_id: (int) $model->poa_id,
            nombre: $model->nombre,
            descripcion: $model->descripcion,
            presupuesto_asignado: $model->presupuesto_asignado ? (float) $model->presupuesto_asignado : null,
            meta_indicador: $model->meta_indicador ? (int) $model->meta_indicador : null,
            unidad_medida: $model->unidad_medida,
            estado: $model->estado,
        );
    }
}
