<?php

namespace App\Application\EventosFotos\Commands;

final readonly class UpdateEventoFotoCommand
{
    public function __construct(public int $id, public array $data) {}
}
