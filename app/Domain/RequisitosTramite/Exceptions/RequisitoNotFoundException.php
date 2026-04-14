<?php

namespace App\Domain\RequisitosTramite\Exceptions;

use RuntimeException;

class RequisitoNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Requisito '{$id}' no encontrado.", 404);
    }
}
