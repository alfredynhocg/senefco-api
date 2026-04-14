<?php

namespace App\Application\FormulariosTramite\Commands;

final readonly class UpdateFormularioCommand
{
    public function __construct(public int $id, public array $data) {}
}
