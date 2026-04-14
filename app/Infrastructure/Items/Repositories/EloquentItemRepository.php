<?php

namespace App\Infrastructure\Items\Repositories;

use App\Application\Items\DTOs\ItemDTO;
use App\Domain\Items\Contracts\ItemRepositoryInterface;
use App\Domain\Items\Exceptions\ItemNotFoundException;
use App\Infrastructure\Items\Models\Item;
use App\Shared\Kernel\DTOs\PaginationDTO;

class EloquentItemRepository implements ItemRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, ?string $tipo = null): array
    {
        $q = Item::query();

        if ($pagination->query) {
            $q->where(function ($sq) use ($pagination) {
                $sq->where('nombre', 'like', "%{$pagination->query}%")
                    ->orWhere('descripcion', 'like', "%{$pagination->query}%");
            });
        }

        if ($tipo) {
            $q->where('tipo', $tipo);
        }

        $paginated = $q->orderBy('orden')->orderBy('nombre')
            ->paginate($pagination->pageSize, ['*'], 'page', $pagination->pageIndex);

        return [
            'data' => collect($paginated->items())->map(fn ($m) => ItemDTO::fromModel($m))->all(),
            'total' => $paginated->total(),
        ];
    }

    public function findById(int $id): ItemDTO
    {
        $model = Item::find($id);
        if (! $model) {
            throw new ItemNotFoundException($id);
        }

        return ItemDTO::fromModel($model);
    }

    public function create(array $data): ItemDTO
    {
        return ItemDTO::fromModel(Item::create($data));
    }

    public function update(int $id, array $data): ItemDTO
    {
        $model = Item::find($id);
        if (! $model) {
            throw new ItemNotFoundException($id);
        }
        $model->update($data);

        return ItemDTO::fromModel($model->fresh());
    }

    public function delete(int|array $ids): bool
    {
        return Item::destroy($ids) > 0;
    }
}
