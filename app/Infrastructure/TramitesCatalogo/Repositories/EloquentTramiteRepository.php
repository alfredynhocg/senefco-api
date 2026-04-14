<?php

namespace App\Infrastructure\TramitesCatalogo\Repositories;

use App\Application\TramitesCatalogo\DTOs\TramiteDTO;
use App\Domain\TramitesCatalogo\Contracts\TramiteRepositoryInterface;
use App\Domain\TramitesCatalogo\Exceptions\TramiteNotFoundException;
use App\Infrastructure\TramitesCatalogo\Models\Tramite;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentTramiteRepository implements TramiteRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false, ?int $tipoTramiteId = null): array
    {
        $q = Tramite::query()->with('tipoTramite');

        if ($soloActivos) {
            $q->where('activo', true);
        }

        if ($tipoTramiteId) {
            $q->where('tipo_tramite_id', $tipoTramiteId);
        }

        if ($pagination->query) {
            $q->where('nombre', 'like', "%{$pagination->query}%")
                ->orWhere('descripcion', 'like', "%{$pagination->query}%");
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => TramiteDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): TramiteDTO
    {
        $model = Tramite::with('tipoTramite')->find($id);
        if (! $model) {
            throw new TramiteNotFoundException($id);
        }

        return TramiteDTO::fromModel($model);
    }

    public function findBySlug(string $slug): TramiteDTO
    {
        $model = Tramite::with('tipoTramite')->where('slug', $slug)->first();
        if (! $model) {
            throw new TramiteNotFoundException($slug);
        }

        return TramiteDTO::fromModel($model);
    }

    public function create(array $data): TramiteDTO
    {
        $model = Tramite::create($data);

        return TramiteDTO::fromModel($model->load('tipoTramite'));
    }

    public function update(int $id, array $data): TramiteDTO
    {
        $model = Tramite::find($id);
        if (! $model) {
            throw new TramiteNotFoundException($id);
        }
        $model->update($data);

        return TramiteDTO::fromModel($model->load('tipoTramite'));
    }

    public function delete(int|array $ids): bool
    {
        return Tramite::destroy($ids) > 0;
    }
}
