<?php

namespace App\Application\EjecucionPresupuestaria\Queries;

final readonly class GetEjecucionByPresupuestoQuery
{
    public function __construct(public int $presupuestoId) {}
}
