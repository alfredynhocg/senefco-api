<?php

namespace App\Application\PlanesGobierno\Queries;

final readonly class GetPlanGobiernoByIdQuery
{
    public function __construct(public int $id) {}
}
