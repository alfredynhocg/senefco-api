<?php

namespace App\Application\ProgramasPOA\Commands;

final readonly class CreateProgramaPOACommand
{
    public function __construct(
        public int $poa_id,
        public string $nombre,
        public ?string $descripcion = null,
        public ?float $presupuesto_asignado = null,
        public ?int $meta_indicador = null,
        public ?string $unidad_medida = null,
        public string $estado = 'no_iniciado',
    ) {}
}
