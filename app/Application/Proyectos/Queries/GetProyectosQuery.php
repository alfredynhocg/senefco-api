<?php

namespace App\Application\Proyectos\Queries;

final readonly class GetProyectosQuery
{
    public function __construct(public array $filters = []) {}
}
