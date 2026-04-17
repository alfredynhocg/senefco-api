<?php

namespace App\Application\InformesAuditoria\Handlers;

use App\Application\InformesAuditoria\Commands\CreateInformeAuditoriaCommand;
use App\Application\InformesAuditoria\DTOs\InformeAuditoriaDTO;
use App\Domain\InformesAuditoria\Contracts\InformeAuditoriaRepositoryInterface;

class CreateInformeAuditoriaHandler
{
    public function __construct(
        private readonly InformeAuditoriaRepositoryInterface $repository
    ) {}

    public function handle(CreateInformeAuditoriaCommand $command): InformeAuditoriaDTO
    {
        $model = $this->repository->create([
            'nombre' => $command->nombre,
            'descripcion' => $command->descripcion,
            'pdf_url' => $command->pdf_url,
            'pdf_nombre' => $command->pdf_nombre,
            'estado' => $command->estado,
            'fecha' => $command->fecha,
            'anio' => $command->anio,
            'publicado_en_web' => $command->publicado_en_web,
            'publicado_por' => $command->publicado_por,
        ]);

        return InformeAuditoriaDTO::fromModel($model);
    }
}
