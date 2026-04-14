<?php

namespace App\Application\TiposTramite\QueryHandlers;

use App\Application\TiposTramite\DTOs\TipoTramiteDTO;
use App\Application\TiposTramite\Queries\GetTipoTramiteByIdQuery;
use App\Domain\TiposTramite\Contracts\TipoTramiteRepositoryInterface;

class GetTipoTramiteByIdQueryHandler
{
    public function __construct(private readonly TipoTramiteRepositoryInterface $repository) {}

    public function handle(GetTipoTramiteByIdQuery $query): TipoTramiteDTO
    {
        return $this->repository->findById($query->id);
    }
}
