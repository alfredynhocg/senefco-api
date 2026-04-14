<?php

namespace App\Application\TramitesCatalogo\Queries;

final readonly class GetTramiteByIdQuery
{
    public function __construct(public int $id) {}
}
