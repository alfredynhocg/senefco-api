<?php

namespace App\Application\FormulariosTramite\Queries;

final readonly class GetFormularioByIdQuery
{
    public function __construct(public int $id) {}
}
