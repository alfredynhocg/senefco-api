<?php

namespace App\Application\ConsultasCiudadanas\Queries;

final readonly class GetConsultasCiudadanasQuery
{
    public function __construct(
        public int $pageIndex,
        public int $pageSize,
        public string $query,
        public string $tipo,
        public string $estado,
    ) {}
}
