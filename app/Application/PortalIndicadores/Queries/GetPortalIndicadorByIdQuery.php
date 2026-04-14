<?php

namespace App\Application\PortalIndicadores\Queries;

final readonly class GetPortalIndicadorByIdQuery
{
    public function __construct(public int $id) {}
}
