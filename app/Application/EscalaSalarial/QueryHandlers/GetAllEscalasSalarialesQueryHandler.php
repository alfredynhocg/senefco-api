<?php

namespace App\Application\EscalaSalarial\QueryHandlers;

use App\Application\EscalaSalarial\Queries\GetAllEscalasSalarialesQuery;
use App\Domain\EscalaSalarial\Contracts\EscalaSalarialRepositoryInterface;

class GetAllEscalasSalarialesQueryHandler
{
    public function __construct(private readonly EscalaSalarialRepositoryInterface $repository) {}

    public function handle(GetAllEscalasSalarialesQuery $query): array
    {
        return $this->repository->all();
    }
}
