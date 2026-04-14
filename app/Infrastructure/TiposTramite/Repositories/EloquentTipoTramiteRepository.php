<?php

namespace App\Infrastructure\TiposTramite\Repositories;

use App\Application\TiposTramite\DTOs\TipoTramiteDTO;
use App\Domain\TiposTramite\Contracts\TipoTramiteRepositoryInterface;
use App\Domain\TiposTramite\Exceptions\TipoTramiteNotFoundException;
use App\Infrastructure\TiposTramite\Models\TipoTramite;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentTipoTramiteRepository implements TipoTramiteRepositoryInterface
{
    public function paginate(PaginationDTO $pagination): array
    {
        $q = TipoTramite::query();

        if ($pagination->query) {
            $q->where('nombre', 'like', "%{$pagination->query}%");
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => TipoTramiteDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): TipoTramiteDTO
    {
        $model = TipoTramite::find($id);
        if (! $model) {
            throw new TipoTramiteNotFoundException($id);
        }

        return TipoTramiteDTO::fromModel($model);
    }

    public function findBySlug(string $slug): TipoTramiteDTO
    {
        $model = TipoTramite::where('slug', $slug)->first();
        if (! $model) {
            throw new TipoTramiteNotFoundException($slug);
        }

        return TipoTramiteDTO::fromModel($model);
    }

    public function create(array $data): TipoTramiteDTO
    {
        $model = TipoTramite::create($data);

        return TipoTramiteDTO::fromModel($model);
    }

    public function update(int $id, array $data): TipoTramiteDTO
    {
        $model = TipoTramite::find($id);
        if (! $model) {
            throw new TipoTramiteNotFoundException($id);
        }
        $model->update($data);

        return TipoTramiteDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return TipoTramite::destroy($ids) > 0;
    }
}
