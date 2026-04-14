<?php

namespace App\Application\PartidasPresupuestarias\Queries;

final readonly class GetPartidasByPresupuestoQuery
{
    public function __construct(public int $presupuestoId) {}
}
