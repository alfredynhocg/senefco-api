<?php

namespace App\Application\TramitesCatalogo\Commands;

final readonly class CreateTramiteCommand
{
    public function __construct(
        public int $tipo_tramite_id,
        public int $unidad_responsable_id,
        public ?int $creado_por,
        public string $nombre,
        public ?string $descripcion = null,
        public ?string $procedimiento = null,
        public ?float $costo = 0,
        public string $moneda = 'BOB',
        public ?int $dias_habiles_resolucion = null,
        public ?string $normativa_base = null,
        public ?string $url_formulario = null,
        public string $modalidad = 'presencial',
        public bool $activo = true,
    ) {}
}
