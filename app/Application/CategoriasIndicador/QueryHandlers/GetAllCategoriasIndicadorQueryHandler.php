<?php

namespace App\Application\CategoriasIndicador\QueryHandlers;

use App\Application\CategoriasIndicador\Queries\GetAllCategoriasIndicadorQuery;
use App\Domain\CategoriasIndicador\Contracts\CategoriaIndicadorRepositoryInterface;

class GetAllCategoriasIndicadorQueryHandler
{
    public function __construct(private readonly CategoriaIndicadorRepositoryInterface $repository) {}

    public function handle(GetAllCategoriasIndicadorQuery $query): array
    {
        return $this->repository->all();
    }
}
