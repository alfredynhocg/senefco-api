<?php

namespace App\Application\InformesAuditoria\Commands;

final readonly class DeleteInformeAuditoriaCommand
{
    public function __construct(public int $id) {}
}
