<?php

namespace App\Domain\Items\Exceptions;

class ItemNotFoundException extends \RuntimeException
{
    public function __construct(int $id)
    {
        parent::__construct("Ítem '{$id}' no encontrado.", 404);
    }
}
