<?php

namespace App\Application\RequisitosTramite\Commands;

final readonly class UpdateRequisitoCommand
{
    public function __construct(public int $id, public array $data) {}
}
