<?php

namespace App\Application\Eventos\DTOs;

final readonly class EventoDTO
{
    public function __construct(
        public int $id,
        public int $tipo_evento_id,
        public int $creado_por,
        public string $titulo,
        public ?string $slug,
        public ?string $descripcion,
        public ?string $lugar,
        public ?float $latitud,
        public ?float $longitud,
        public ?string $fecha_inicio,
        public ?string $fecha_fin,
        public bool $todo_el_dia,
        public string $estado,
        public ?string $url_transmision,
        public bool $publico,
        public ?string $created_at,
        public ?string $tipo_nombre = null,
    ) {}

    public static function fromModel(object $model): self
    {
        return new self(
            id: $model->id,
            tipo_evento_id: (int) $model->tipo_evento_id,
            creado_por: (int) $model->creado_por,
            titulo: $model->titulo,
            slug: $model->slug,
            descripcion: $model->descripcion,
            lugar: $model->lugar,
            latitud: $model->latitud ? (float) $model->latitud : null,
            longitud: $model->longitud ? (float) $model->longitud : null,
            fecha_inicio: $model->fecha_inicio?->toIso8601String(),
            fecha_fin: $model->fecha_fin?->toIso8601String(),
            todo_el_dia: (bool) $model->todo_el_dia,
            estado: $model->estado,
            url_transmision: $model->url_transmision,
            publico: (bool) $model->publico,
            created_at: $model->created_at?->toIso8601String(),
            tipo_nombre: $model->tipoEvento?->nombre,
        );
    }
}
