<?php

namespace App\Application\AudienciasPublicas\Queries;

final readonly class GetAudienciaPublicaByIdQuery
{
    public function __construct(public int $id) {}
}
