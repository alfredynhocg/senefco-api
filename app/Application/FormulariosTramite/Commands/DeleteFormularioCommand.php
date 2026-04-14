<?php

namespace App\Application\FormulariosTramite\Commands;

final readonly class DeleteFormularioCommand
{
    public function __construct(public int $id) {}
}
