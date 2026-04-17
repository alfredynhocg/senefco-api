<?php

namespace App\Application\Normas\Queries;

final readonly class GetNormaByIdQuery
{
    public function __construct(public int $id) {}
}
