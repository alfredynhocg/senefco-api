<?php

namespace App\Application\ConsultasCiudadanas\Commands;

final readonly class DeleteConsultaCiudadanaCommand
{
    public function __construct(public int $id) {}
}
