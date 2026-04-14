<?php

namespace App\Application\Eventos\Commands;

final readonly class CreateEventoCommand
{
    public function __construct(
        public int $tipo_evento_id,
        public int $creado_por,
        public string $titulo,
        public ?string $descripcion = null,
        public ?string $lugar = null,
        public ?float $latitud = null,
        public ?float $longitud = null,
        public ?string $fecha_inicio = null,
        public ?string $fecha_fin = null,
        public bool $todo_el_dia = false,
        public string $estado = 'programado',
        public ?string $url_transmision = null,
        public bool $publico = true,
    ) {}
}
