<?php

namespace App\Application\ValoresIndicador\Queries;

final readonly class GetValoresByIndicadorQuery
{
    public function __construct(public int $indicadorId) {}
}
