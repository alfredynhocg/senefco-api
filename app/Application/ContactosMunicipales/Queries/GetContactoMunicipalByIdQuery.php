<?php

namespace App\Application\ContactosMunicipales\Queries;

final readonly class GetContactoMunicipalByIdQuery
{
    public function __construct(public int $id) {}
}
