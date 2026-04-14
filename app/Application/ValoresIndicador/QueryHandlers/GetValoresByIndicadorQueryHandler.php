<?php

namespace App\Application\ValoresIndicador\QueryHandlers;

use App\Application\ValoresIndicador\Queries\GetValoresByIndicadorQuery;
use App\Domain\ValoresIndicador\Contracts\ValorIndicadorRepositoryInterface;

class GetValoresByIndicadorQueryHandler
{
    public function __construct(private readonly ValorIndicadorRepositoryInterface $repository) {}

    public function handle(GetValoresByIndicadorQuery $query): array
    {
        return $this->repository->findByIndicador($query->indicadorId);
    }
}
