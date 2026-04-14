<?php

namespace App\Application\TramitesCatalogo\QueryHandlers;

use App\Application\TramitesCatalogo\DTOs\TramiteDTO;
use App\Application\TramitesCatalogo\Queries\GetTramiteByIdQuery;
use App\Domain\TramitesCatalogo\Contracts\TramiteRepositoryInterface;

class GetTramiteByIdQueryHandler
{
    public function __construct(private readonly TramiteRepositoryInterface $repository) {}

    public function handle(GetTramiteByIdQuery $query): TramiteDTO
    {
        return $this->repository->findById($query->id);
    }
}
