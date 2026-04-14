<?php

namespace App\Infrastructure\UnidadesResponsables\Repositories;

use App\Application\UnidadesResponsables\DTOs\UnidadResponsableDTO;
use App\Domain\UnidadesResponsables\Contracts\UnidadResponsableRepositoryInterface;
use App\Domain\UnidadesResponsables\Exceptions\UnidadResponsableNotFoundException;
use App\Infrastructure\UnidadesResponsables\Models\UnidadResponsable;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentUnidadResponsableRepository implements UnidadResponsableRepositoryInterface
{
    public function paginate(PaginationDTO $pagination): array
    {
        $q = UnidadResponsable::query();

        if ($pagination->query) {
            $q->where('nombre', 'like', "%{$pagination->query}%")
                ->orWhere('sigla', 'like', "%{$pagination->query}%");
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => UnidadResponsableDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): UnidadResponsableDTO
    {
        $model = UnidadResponsable::find($id);
        if (! $model) {
            throw new UnidadResponsableNotFoundException($id);
        }

        return UnidadResponsableDTO::fromModel($model);
    }

    public function findBySlug(string $slug): UnidadResponsableDTO
    {
        $model = UnidadResponsable::where('slug', $slug)->first();
        if (! $model) {
            throw new UnidadResponsableNotFoundException($slug);
        }

        return UnidadResponsableDTO::fromModel($model);
    }

    public function create(array $data): UnidadResponsableDTO
    {
        $model = UnidadResponsable::create($data);

        return UnidadResponsableDTO::fromModel($model);
    }

    public function update(int $id, array $data): UnidadResponsableDTO
    {
        /** @var UnidadResponsable $model */
        $model = UnidadResponsable::find($id);
        if (! $model) {
            throw new UnidadResponsableNotFoundException($id);
        }
        $model->update($data);

        return UnidadResponsableDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return UnidadResponsable::destroy($ids) > 0;
    }

    public function all(): array
    {
        return UnidadResponsable::where('activo', true)
            ->orderBy('nombre')
            ->get()
            ->map(fn ($m) => UnidadResponsableDTO::fromModel($m))
            ->all();
    }
}
