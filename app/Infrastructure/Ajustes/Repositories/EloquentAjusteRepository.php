<?php

namespace App\Infrastructure\Ajustes\Repositories;

use App\Application\Ajustes\DTOs\AjusteDTO;
use App\Domain\Ajustes\Contracts\AjusteRepositoryInterface;
use App\Domain\Ajustes\Exceptions\AjusteNotFoundException;
use App\Infrastructure\Ajustes\Models\Ajuste;

class EloquentAjusteRepository implements AjusteRepositoryInterface
{
    public function all(): array
    {
        return Ajuste::all()
            ->map(fn ($m) => AjusteDTO::fromModel($m))
            ->all();
    }

    public function findByKey(string $key): AjusteDTO
    {
        $model = Ajuste::where('clave', $key)->first();
        if (! $model) {
            throw new AjusteNotFoundException($key);
        }

        return AjusteDTO::fromModel($model);
    }

    public function create(array $data): AjusteDTO
    {
        $model = Ajuste::create($data);

        return AjusteDTO::fromModel($model);
    }

    public function update(string $key, array $data): AjusteDTO
    {
        /** @var Ajuste $model */
        $model = Ajuste::where('clave', $key)->first();
        if (! $model) {
            throw new AjusteNotFoundException($key);
        }
        $model->update($data);

        return AjusteDTO::fromModel($model);
    }
}
