<?php

namespace App\Application\ManualesInstitucionales\Queries;

final readonly class GetManualByIdQuery
{
    public function __construct(public int $id) {}
}
