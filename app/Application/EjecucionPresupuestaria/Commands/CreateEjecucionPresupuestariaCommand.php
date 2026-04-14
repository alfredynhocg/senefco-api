<?php

namespace App\Application\EjecucionPresupuestaria\Commands;

final readonly class CreateEjecucionPresupuestariaCommand
{
    public function __construct(
        public int $partida_id,
        public float $monto_devengado,
        public int $mes,
        public int $gestion,
        public ?int $proyecto_id = null,
        public ?float $monto_pagado = null,
        public ?string $descripcion_gasto = null,
        public ?string $fecha_registro = null,
        public ?int $registrado_por = null,
    ) {}
}
