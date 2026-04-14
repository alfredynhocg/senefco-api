<?php

namespace App\Application\InformesAuditoria\Queries;

final readonly class GetInformeAuditoriaByIdQuery
{
    public function __construct(public int $id) {}
}
