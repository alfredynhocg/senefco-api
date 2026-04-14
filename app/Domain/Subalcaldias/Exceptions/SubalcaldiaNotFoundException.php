<?php

namespace App\Domain\Subsenefcos\Exceptions;

use RuntimeException;

class SubsenefcoNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Subalcaldía '{$id}' no encontrada.", 404);
    }
}
