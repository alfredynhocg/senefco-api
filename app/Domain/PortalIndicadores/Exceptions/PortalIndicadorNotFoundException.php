<?php

namespace App\Domain\PortalIndicadores\Exceptions;

class PortalIndicadorNotFoundException extends \RuntimeException
{
    public function __construct(int $id)
    {
        parent::__construct("Indicador de gestión '{$id}' no encontrado.", 404);
    }
}
