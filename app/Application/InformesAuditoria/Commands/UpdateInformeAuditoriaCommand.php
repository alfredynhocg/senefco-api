<?php

namespace App\Application\InformesAuditoria\Commands;

final readonly class UpdateInformeAuditoriaCommand
{
    public function __construct(
        public int $id,
        public array $data,
    ) {}
}
