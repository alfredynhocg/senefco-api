<?php

namespace App\Application\IndicadoresGestion\Queries;

final readonly class GetIndicadoresQuery
{
    public function __construct(public array $filters = []) {}
}
