<?php

namespace App\Infrastructure\ValoresIndicador\Repositories;

use App\Application\ValoresIndicador\DTOs\ValorIndicadorDTO;
use App\Domain\ValoresIndicador\Contracts\ValorIndicadorRepositoryInterface;
use App\Infrastructure\ValoresIndicador\Models\ValorIndicador;

class EloquentValorIndicadorRepository implements ValorIndicadorRepositoryInterface
{
    public function findByIndicador(int $indicadorId): array
    {
        return ValorIndicador::where('indicador_id', $indicadorId)
            ->orderBy('gestion', 'desc')
            ->orderBy('mes', 'desc')
            ->get()
            ->map(fn ($m) => ValorIndicadorDTO::fromModel($m))
            ->all();
    }

    public function create(array $data): ValorIndicadorDTO
    {
        $model = ValorIndicador::create($data);

        return ValorIndicadorDTO::fromModel($model);
    }

    public function delete(int|array $ids): bool
    {
        return ValorIndicador::destroy($ids) > 0;
    }
}
