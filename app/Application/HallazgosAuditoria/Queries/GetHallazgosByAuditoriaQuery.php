<?php

namespace App\Application\HallazgosAuditoria\Queries;

final readonly class GetHallazgosByAuditoriaQuery
{
    public function __construct(public int $auditoriaId) {}
}
