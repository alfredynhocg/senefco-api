<?php

namespace App\Application\IndicadoresGestion\DTOs;

final readonly class IndicadorGestionDTO
{
    public function __construct(
        public int $id,
        public int $categoria_id,
        public string $categoria_nombre,
        public string $nombre,
        public ?string $descripcion,
        public ?string $unidad_medida,
        public ?string $frecuencia_actualizacion,
        public bool $publico,
        public bool $activo,
        public int $orden_dashboard,
        public ?float $ultimo_valor = null,
        public ?int $ultimo_mes = null,
        public ?int $ultima_gestion = null,
    ) {}

    public static function fromModel(object $model): self
    {
        $ultimo = $model->ultimoValor;

        return new self(
            id: (int) $model->id,
            categoria_id: (int) $model->categoria_id,
            categoria_nombre: $model->categoria?->nombre ?? '',
            nombre: $model->nombre,
            descripcion: $model->descripcion,
            unidad_medida: $model->unidad_medida,
            frecuencia_actualizacion: $model->frecuencia_actualizacion,
            publico: (bool) $model->publico,
            activo: (bool) $model->activo,
            orden_dashboard: (int) $model->orden_dashboard,
            ultimo_valor: $ultimo ? (float) $ultimo->valor : null,
            ultimo_mes: $ultimo ? $ultimo->mes : null,
            ultima_gestion: $ultimo ? $ultimo->gestion : null,
        );
    }
}
