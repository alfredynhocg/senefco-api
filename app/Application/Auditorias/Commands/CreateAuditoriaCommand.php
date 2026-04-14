<?php

namespace App\Application\Auditorias\Commands;

final readonly class CreateAuditoriaCommand
{
    public function __construct(
        public int $tipo_auditoria_id,
        public string $codigo_auditoria,
        public string $titulo,
        public ?int $secretaria_auditada_id = null,
        public ?string $objeto_examen = null,
        public ?string $entidad_auditora = null,
        public ?int $gestion_auditada = null,
        public ?string $fecha_inicio = null,
        public ?string $fecha_fin = null,
        public string $estado = 'planificada',
        public ?string $informe_pdf_url = null,
        public bool $publico = false,
        public ?int $publicado_por = null,
    ) {}
}
