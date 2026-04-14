<?php

namespace App\Application\TiposTramite\Queries;

final readonly class GetTipoTramiteByIdQuery
{
    public function __construct(public int $id) {}
}
