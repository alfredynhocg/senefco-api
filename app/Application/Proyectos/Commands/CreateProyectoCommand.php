<?php

namespace App\Application\Proyectos\Commands;

final readonly class CreateProyectoCommand
{
    public function __construct(
        public int $estado_id,
        public int $secretaria_id,
        public string $nombre,
        public ?string $codigo_sipfe = null,
        public ?string $descripcion = null,
        public float $presupuesto_total = 0,
        public ?string $ubicacion_texto = null,
        public ?float $latitud = null,
        public ?float $longitud = null,
        public ?string $contratista = null,
        public ?string $fecha_inicio_estimada = null,
        public ?string $fecha_fin_estimada = null,
        public ?string $imagen_portada_url = null,
        public bool $publico = true,
    ) {}
}
