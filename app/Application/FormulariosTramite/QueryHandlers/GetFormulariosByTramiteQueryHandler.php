<?php

namespace App\Application\FormulariosTramite\QueryHandlers;

use App\Application\FormulariosTramite\Queries\GetFormulariosByTramiteQuery;
use App\Domain\FormulariosTramite\Contracts\FormularioRepositoryInterface;

class GetFormulariosByTramiteQueryHandler
{
    public function __construct(private readonly FormularioRepositoryInterface $repository) {}

    public function handle(GetFormulariosByTramiteQuery $query): array
    {
        return $this->repository->findByTramite($query->tramiteId);
    }
}
