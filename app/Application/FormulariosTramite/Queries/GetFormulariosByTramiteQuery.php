<?php

namespace App\Application\FormulariosTramite\Queries;

final readonly class GetFormulariosByTramiteQuery
{
    public function __construct(public int $tramiteId) {}
}
