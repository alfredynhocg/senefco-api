<?php

namespace App\Domain\ConsultasCiudadanas\Exceptions;

class ConsultaCiudadanaNotFoundException extends \RuntimeException
{
    public function __construct(int $id)
    {
        parent::__construct("Consulta ciudadana '{$id}' no encontrada.", 404);
    }
}
