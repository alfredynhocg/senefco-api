<?php

namespace App\Domain\UnidadesResponsables\Exceptions;

use RuntimeException;

class UnidadResponsableNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Unidad responsable '{$id}' no encontrada.", 404);
    }
}
