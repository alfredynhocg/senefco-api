<?php

namespace App\Application\AvanceProyecto\Queries;

final readonly class GetAvancesByProyectoQuery
{
    public function __construct(public int $proyectoId) {}
}
