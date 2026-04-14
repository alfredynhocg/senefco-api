<?php

namespace App\Application\Eventos\QueryHandlers;

use App\Application\Eventos\DTOs\EventoDTO;
use App\Application\Eventos\Queries\GetEventoByIdQuery;
use App\Domain\Eventos\Contracts\EventoRepositoryInterface;

class GetEventoByIdQueryHandler
{
    public function __construct(private readonly EventoRepositoryInterface $repository) {}

    public function handle(GetEventoByIdQuery $query): EventoDTO
    {
        return $this->repository->findById($query->id);
    }
}
