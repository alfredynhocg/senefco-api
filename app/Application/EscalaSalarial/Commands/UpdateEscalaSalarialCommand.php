<?php

namespace App\Application\EscalaSalarial\Commands;

final readonly class UpdateEscalaSalarialCommand
{
    public function __construct(public int $id, public array $data) {}
}
