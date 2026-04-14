<?php

namespace App\Domain\TiposTramite\Exceptions;

use RuntimeException;

class TipoTramiteNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Tipo de trámite '{$id}' no encontrado.", 404);
    }
}
