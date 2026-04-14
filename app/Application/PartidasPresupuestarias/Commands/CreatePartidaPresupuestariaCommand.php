<?php

namespace App\Application\PartidasPresupuestarias\Commands;

final readonly class CreatePartidaPresupuestariaCommand
{
    public function __construct(
        public int $presupuesto_id,
        public string $codigo_partida,
        public float $monto_asignado,
        public ?string $descripcion = null,
        public ?string $categoria = null,
    ) {}
}
