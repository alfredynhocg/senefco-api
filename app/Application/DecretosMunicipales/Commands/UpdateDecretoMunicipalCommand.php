<?php

namespace App\Application\DecretosMunicipales\Commands;

final readonly class UpdateDecretoMunicipalCommand
{
    public function __construct(
        public int $id,
        public array $data,
    ) {}
}
