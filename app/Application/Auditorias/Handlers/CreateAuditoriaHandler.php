<?php

namespace App\Application\Auditorias\Handlers;

use App\Application\Auditorias\Commands\CreateAuditoriaCommand;
use App\Application\Auditorias\DTOs\AuditoriaDTO;
use App\Domain\Auditorias\Contracts\AuditoriaRepositoryInterface;

class CreateAuditoriaHandler
{
    public function __construct(private readonly AuditoriaRepositoryInterface $repository) {}

    public function handle(CreateAuditoriaCommand $command): AuditoriaDTO
    {
        return $this->repository->create([
            'tipo_auditoria_id' => $command->tipo_auditoria_id,
            'codigo_auditoria' => $command->codigo_auditoria,
            'titulo' => $command->titulo,
            'secretaria_auditada_id' => $command->secretaria_auditada_id,
            'objeto_examen' => $command->objeto_examen,
            'entidad_auditora' => $command->entidad_auditora,
            'gestion_auditada' => $command->gestion_auditada,
            'fecha_inicio' => $command->fecha_inicio,
            'fecha_fin' => $command->fecha_fin,
            'estado' => $command->estado,
            'informe_pdf_url' => $command->informe_pdf_url,
            'publico' => $command->publico,
            'publicado_por' => $command->publicado_por,
        ]);
    }
}
