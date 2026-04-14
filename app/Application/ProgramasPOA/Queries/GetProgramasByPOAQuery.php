<?php

namespace App\Application\ProgramasPOA\Queries;

final readonly class GetProgramasByPOAQuery
{
    public function __construct(public int $poaId) {}
}
