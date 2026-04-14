<?php

namespace App\Application\Comunicados\QueryHandlers;

use App\Application\Comunicados\Queries\GetComunicadosQuery;
use App\Domain\Comunicados\Contracts\ComunicadoRepositoryInterface;

class GetComunicadosQueryHandler
{
    public function __construct(
        private readonly ComunicadoRepositoryInterface $repository
    ) {}

    public function handle(GetComunicadosQuery $query): array
    {
        return $this->repository->paginate([
            'pageIndex' => $query->pageIndex,
            'pageSize' => $query->pageSize,
            'query' => $query->query,
            'estado' => $query->estado,
            'soloActivos' => $query->soloActivos,
        ]);
    }
}
