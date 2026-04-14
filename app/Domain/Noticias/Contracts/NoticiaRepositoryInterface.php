<?php

namespace App\Domain\Noticias\Contracts;

use App\Shared\Kernel\DTOs\PaginationDTO;

interface NoticiaRepositoryInterface
{
    public function paginate(PaginationDTO $pagination, bool $soloActivos = false): array;

    public function findById(int $id): mixed;

    public function findBySlug(string $slug): mixed;

    public function create(array $data): mixed;

    public function update(int $id, array $data): mixed;

    public function delete(int|array $ids): bool;

    public function syncEtiquetas(int $noticiaId, array $etiquetaIds): void;
}
