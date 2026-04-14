<?php

namespace App\Application\AudienciasPublicas\Commands;

final readonly class UpdateAudienciaPublicaCommand
{
    public function __construct(
        public int $id,
        public array $data,
    ) {}
}
