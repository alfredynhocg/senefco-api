<?php

namespace App\Application\RequisitosTramite\Queries;

final readonly class GetRequisitosByTramiteQuery
{
    public function __construct(public int $tramiteId) {}
}
