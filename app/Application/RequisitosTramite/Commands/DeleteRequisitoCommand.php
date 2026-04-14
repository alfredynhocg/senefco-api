<?php

namespace App\Application\RequisitosTramite\Commands;

final readonly class DeleteRequisitoCommand
{
    public function __construct(public int $id) {}
}
