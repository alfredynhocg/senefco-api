<?php

namespace App\Application\DirectorioInstitucional\QueryHandlers;

use App\Application\DirectorioInstitucional\Queries\GetDirectorioQuery;
use App\Domain\DirectorioInstitucional\Contracts\DirectorioInstitucionalRepositoryInterface;

class GetDirectorioQueryHandler
{
    public function __construct(
        private readonly DirectorioInstitucionalRepositoryInterface $repository
    ) {}

    public function handle(GetDirectorioQuery $query): array
    {
        return $this->repository->paginate(
            $query->pageIndex,
            $query->pageSize,
            $query->query,
            $query->activo,
        );
    }
}
