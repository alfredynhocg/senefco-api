<?php

namespace App\Application\ProgramasPOA\QueryHandlers;

use App\Application\ProgramasPOA\Queries\GetProgramasByPOAQuery;
use App\Domain\ProgramasPOA\Contracts\ProgramaPOARepositoryInterface;

class GetProgramasByPOAQueryHandler
{
    public function __construct(private readonly ProgramaPOARepositoryInterface $repository) {}

    public function handle(GetProgramasByPOAQuery $query): array
    {
        return $this->repository->findByPoa($query->poaId);
    }
}
