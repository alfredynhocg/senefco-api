<?php

namespace App\Application\ConsultasCiudadanas\Queries;

final readonly class GetConsultaCiudadanaByIdQuery
{
    public function __construct(public int $id) {}
}
