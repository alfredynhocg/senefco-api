<?php

namespace App\Infrastructure\FormulariosTramite\Repositories;

use App\Application\FormulariosTramite\DTOs\FormularioDTO;
use App\Domain\FormulariosTramite\Contracts\FormularioRepositoryInterface;
use App\Domain\FormulariosTramite\Exceptions\FormularioNotFoundException;
use App\Infrastructure\FormulariosTramite\Models\Formulario;

class EloquentFormularioRepository implements FormularioRepositoryInterface
{
    public function findByTramite(int $tramiteId): array
    {
        return Formulario::where('tramite_id', $tramiteId)
            ->get()
            ->map(fn ($m) => FormularioDTO::fromModel($m))
            ->all();
    }

    public function findById(int $id): FormularioDTO
    {
        $model = Formulario::find($id);
        if (! $model) {
            throw new FormularioNotFoundException($id);
        }

        return FormularioDTO::fromModel($model);
    }

    public function create(array $data): FormularioDTO
    {
        $model = Formulario::create($data);

        return FormularioDTO::fromModel($model);
    }

    public function update(int $id, array $data): FormularioDTO
    {
        $model = Formulario::find($id);
        if (! $model) {
            throw new FormularioNotFoundException($id);
        }
        $model->update($data);

        return FormularioDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return Formulario::destroy($ids) > 0;
    }
}
