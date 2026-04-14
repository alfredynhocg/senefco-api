<?php

namespace App\Domain\TramitesCatalogo\Exceptions;

use RuntimeException;

class TramiteNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Trámite '{$id}' no encontrado.", 404);
    }
}
