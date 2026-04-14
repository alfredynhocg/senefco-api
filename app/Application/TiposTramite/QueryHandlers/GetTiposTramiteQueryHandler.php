<?php

namespace App\Application\TiposTramite\QueryHandlers;

use App\Application\TiposTramite\Queries\GetTiposTramiteQuery;
use App\Domain\TiposTramite\Contracts\TipoTramiteRepositoryInterface;

class GetTiposTramiteQueryHandler
{
    public function __construct(private readonly TipoTramiteRepositoryInterface $repository) {}

    public function handle(GetTiposTramiteQuery $query): array
    {
        return $this->repository->paginate($query->pagination);
    }
}
