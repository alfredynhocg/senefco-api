<?php

namespace App\Domain\InformesAuditoria\Exceptions;

class InformeAuditoriaNotFoundException extends \RuntimeException
{
    public function __construct(int|string $id)
    {
        parent::__construct("Informe de auditoría '{$id}' no encontrado.", 404);
    }
}
