<?php

namespace App\Application\DecretosMunicipales\Handlers;

use App\Application\DecretosMunicipales\Commands\CreateDecretoMunicipalCommand;
use App\Application\DecretosMunicipales\DTOs\DecretoMunicipalDTO;
use App\Domain\DecretosMunicipales\Contracts\DecretoMunicipalRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CreateDecretoMunicipalHandler
{
    public function __construct(
        private readonly DecretoMunicipalRepositoryInterface $repository
    ) {}

    public function handle(CreateDecretoMunicipalCommand $command): DecretoMunicipalDTO
    {
        return DB::transaction(function () use ($command) {
            $model = $this->repository->create([
                'numero' => $command->numero,
                'tipo' => $command->tipo,
                'titulo' => $command->titulo,
                'descripcion' => $command->descripcion,
                'pdf_url' => $command->pdf_url,
                'pdf_nombre' => $command->pdf_nombre,
                'estado' => $command->estado,
                'fecha_promulgacion' => $command->fecha_promulgacion,
                'anio' => $command->anio,
                'publicado_en_web' => $command->publicado_en_web,
                'publicado_por' => $command->publicado_por,
            ]);

            return $this->repository->findById($model->id);
        });
    }
}
