<?php

namespace App\Application\AudienciasPublicas\Commands;

final readonly class DeleteAudienciaPublicaCommand
{
    public function __construct(public int $id) {}
}
