<?php

namespace App\Domain\FormulariosTramite\Exceptions;

use RuntimeException;

class FormularioNotFoundException extends RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Formulario '{$id}' no encontrado.", 404);
    }
}
