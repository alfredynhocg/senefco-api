<?php

namespace App\Domain\EscalaSalarial\Exceptions;

use RuntimeException;

class EscalaSalarialNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Nivel salarial '{$id}' no encontrado.", 404);
    }
}
