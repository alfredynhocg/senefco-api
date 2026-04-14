<?php

namespace App\Application\NominaPersonal\Queries;

final readonly class GetNominaPersonalByIdQuery
{
    public function __construct(public int $id) {}
}
