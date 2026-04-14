<?php

namespace App\Application\RequisitosTramite\QueryHandlers;

use App\Application\RequisitosTramite\DTOs\RequisitoDTO;
use App\Application\RequisitosTramite\Queries\GetRequisitoByIdQuery;
use App\Domain\RequisitosTramite\Contracts\RequisitoRepositoryInterface;

class GetRequisitoByIdQueryHandler
{
    public function __construct(private readonly RequisitoRepositoryInterface $repository) {}

    public function handle(GetRequisitoByIdQuery $query): RequisitoDTO
    {
        return $this->repository->findById($query->id);
    }
}
