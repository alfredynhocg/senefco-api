<?php

namespace App\Domain\AudienciasPublicas\Exceptions;

class AudienciaPublicaNotFoundException extends \RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Audiencia pública '{$id}' no encontrada.", 404);
    }
}
