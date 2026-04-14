<?php

namespace App\Application\DecretosMunicipales\Queries;

final readonly class GetDecretoMunicipalByIdQuery
{
    public function __construct(public int $id) {}
}
