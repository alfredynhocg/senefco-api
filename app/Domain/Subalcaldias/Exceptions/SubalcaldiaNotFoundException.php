<?php

namespace App\Domain\Subcenefcos\Exceptions;

use RuntimeException;

class SubcenefcoNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Subalcaldía '{$id}' no encontrada.", 404);
    }
}
