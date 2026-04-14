<?php

namespace App\Application\ValoresIndicador\Commands;

final readonly class CreateValorIndicadorCommand
{
    public function __construct(
        public int $indicador_id,
        public float $valor,
        public int $gestion,
        public ?int $mes = null,
        public ?string $fecha_registro = null,
        public ?string $fuente = null,
        public ?int $registrado_por = null,
    ) {}
}
