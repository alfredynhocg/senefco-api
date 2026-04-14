<?php

namespace App\Application\RequisitosTramite\QueryHandlers;

use App\Application\RequisitosTramite\Queries\GetRequisitosByTramiteQuery;
use App\Domain\RequisitosTramite\Contracts\RequisitoRepositoryInterface;

class GetRequisitosByTramiteQueryHandler
{
    public function __construct(private readonly RequisitoRepositoryInterface $repository) {}

    public function handle(GetRequisitosByTramiteQuery $query): array
    {
        return $this->repository->findByTramite($query->tramiteId);
    }
}
