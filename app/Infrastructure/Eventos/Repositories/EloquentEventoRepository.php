<?php

namespace App\Infrastructure\Eventos\Repositories;

use App\Application\Eventos\DTOs\EventoDTO;
use App\Domain\Eventos\Contracts\EventoRepositoryInterface;
use App\Domain\Eventos\Exceptions\EventoNotFoundException;
use App\Infrastructure\Eventos\Models\Evento;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentEventoRepository implements EventoRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false): array
    {
        $q = Evento::query()->with(['tipoEvento']);

        if ($soloActivos) {
            $q->where('publico', true);
        }

        if ($pagination->query) {
            $q->where('titulo', 'like', "%{$pagination->query}%")
                ->orWhere('descripcion', 'like', "%{$pagination->query}%");
        }

        $paginated = $q->orderBy($pagination->sortKey, $pagination->sortOrder)
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => EventoDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): EventoDTO
    {
        $model = Evento::with(['tipoEvento'])->find($id);
        if (! $model) {
            throw new EventoNotFoundException($id);
        }

        return EventoDTO::fromModel($model);
    }

    public function findBySlug(string $slug): EventoDTO
    {
        $model = Evento::with(['tipoEvento'])->where('slug', $slug)->first();
        if (! $model) {
            throw new EventoNotFoundException($slug);
        }

        return EventoDTO::fromModel($model);
    }

    public function create(array $data): EventoDTO
    {
        $model = Evento::create($data);

        return EventoDTO::fromModel($model->load(['tipoEvento']));
    }

    public function update(int $id, array $data): EventoDTO
    {
        $model = Evento::find($id);
        if (! $model) {
            throw new EventoNotFoundException($id);
        }
        $model->update($data);

        return EventoDTO::fromModel($model->load(['tipoEvento']));
    }

    public function delete(int|array $ids): bool
    {
        return Evento::destroy($ids) > 0;
    }
}
