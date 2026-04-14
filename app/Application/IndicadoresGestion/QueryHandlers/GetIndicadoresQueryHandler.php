<?php

namespace App\Application\IndicadoresGestion\QueryHandlers;

use App\Application\IndicadoresGestion\Queries\GetIndicadoresQuery;
use App\Domain\IndicadoresGestion\Contracts\IndicadorGestionRepositoryInterface;

class GetIndicadoresQueryHandler
{
    public function __construct(private readonly IndicadorGestionRepositoryInterface $repository) {}

    public function handle(GetIndicadoresQuery $query): array
    {
        return $this->repository->all($query->filters);
    }
}
