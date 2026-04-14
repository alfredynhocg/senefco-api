<?php

namespace App\Application\RequisitosTramite\Queries;

final readonly class GetRequisitoByIdQuery
{
    public function __construct(public int $id) {}
}
