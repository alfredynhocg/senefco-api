<?php

namespace App\Application\ContactosMunicipales\Commands;

final readonly class UpdateContactoMunicipalCommand
{
    public function __construct(public int $id, public array $data) {}
}
