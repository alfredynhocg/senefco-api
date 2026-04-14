<?php

namespace App\Application\EjesPEI\Queries;

final readonly class GetEjesByPEIQuery
{
    public function __construct(public int $peiId) {}
}
