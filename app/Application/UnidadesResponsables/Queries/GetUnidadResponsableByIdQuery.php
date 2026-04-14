<?php

namespace App\Application\UnidadesResponsables\Queries;

final readonly class GetUnidadResponsableByIdQuery
{
    public function __construct(public int $id) {}
}
