<?php

namespace App\Application\DecretosMunicipales\Commands;

final readonly class DeleteDecretoMunicipalCommand
{
    public function __construct(public int $id) {}
}
