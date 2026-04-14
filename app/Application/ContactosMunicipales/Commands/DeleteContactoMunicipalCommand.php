<?php

namespace App\Application\ContactosMunicipales\Commands;

final readonly class DeleteContactoMunicipalCommand
{
    public function __construct(public int $id) {}
}
