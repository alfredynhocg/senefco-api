<?php

namespace App\Domain\DecretosMunicipales\Exceptions;

class DecretoMunicipalNotFoundException extends \RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Decreto Municipal '{$id}' no encontrado.", 404);
    }
}
