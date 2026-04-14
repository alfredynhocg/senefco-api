<?php

namespace App\Domain\ContactosMunicipales\Exceptions;

use RuntimeException;

class ContactoMunicipalNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Contacto municipal '{$id}' no encontrado.", 404);
    }
}
