<?php

namespace App\Application\FormulariosTramite\QueryHandlers;

use App\Application\FormulariosTramite\DTOs\FormularioDTO;
use App\Application\FormulariosTramite\Queries\GetFormularioByIdQuery;
use App\Domain\FormulariosTramite\Contracts\FormularioRepositoryInterface;

class GetFormularioByIdQueryHandler
{
    public function __construct(private readonly FormularioRepositoryInterface $repository) {}

    public function handle(GetFormularioByIdQuery $query): FormularioDTO
    {
        return $this->repository->findById($query->id);
    }
}
