<?php

namespace App\Application\Eventos\Commands;

final readonly class UpdateEventoCommand
{
    public function __construct(public int $id, public array $data) {}
}
