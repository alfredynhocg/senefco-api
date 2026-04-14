<?php

namespace App\Application\EjesPEI\DTOs;

final readonly class EjePEIDTO
{
    public function __construct(
        public int $id,
        public int $pei_id,
        public int $numero_eje,
        public string $nombre,
        public ?string $descripcion,
        public ?string $color_hex,
        public int $total_objetivos,
        public int $objetivos_cumplidos,
        public float $porcentaje_avance,
    ) {}

    public static function fromModel(object $model): self
    {
        $avance = $model->total_objetivos > 0
            ? round(($model->objetivos_cumplidos / $model->total_objetivos) * 100, 2)
            : 0;

        return new self(
            id: $model->id,
            pei_id: (int) $model->pei_id,
            numero_eje: (int) $model->numero_eje,
            nombre: $model->nombre,
            descripcion: $model->descripcion,
            color_hex: $model->color_hex,
            total_objetivos: (int) $model->total_objetivos,
            objetivos_cumplidos: (int) $model->objetivos_cumplidos,
            porcentaje_avance: (float) $avance,
        );
    }
}
