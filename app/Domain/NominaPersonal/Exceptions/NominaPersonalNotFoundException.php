<?php

namespace App\Domain\NominaPersonal\Exceptions;

use RuntimeException;

class NominaPersonalNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Registro de nómina '{$id}' no encontrado.", 404);
    }
}
