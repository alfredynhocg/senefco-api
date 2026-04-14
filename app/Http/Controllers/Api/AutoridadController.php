<?php

namespace App\Http\Controllers\Api;

use App\Application\Autoridades\Commands\CreateAutoridadCommand;
use App\Application\Autoridades\Commands\DeleteAutoridadCommand;
use App\Application\Autoridades\Commands\UpdateAutoridadCommand;
use App\Application\Autoridades\Handlers\CreateAutoridadHandler;
use App\Application\Autoridades\Handlers\DeleteAutoridadHandler;
use App\Application\Autoridades\Handlers\UpdateAutoridadHandler;
use App\Application\Autoridades\Queries\GetAutoridadByIdQuery;
use App\Application\Autoridades\Queries\GetAutoridadesQuery;
use App\Application\Autoridades\QueryHandlers\GetAutoridadByIdQueryHandler;
use App\Application\Autoridades\QueryHandlers\GetAutoridadesQueryHandler;
use App\Domain\Autoridades\Contracts\AutoridadRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Autoridades\StoreAutoridadRequest;
use App\Http\Requests\Autoridades\UpdateAutoridadRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AutoridadController extends Controller
{
    public function __construct(
        private readonly GetAutoridadesQueryHandler $getAutoridadesHandler,
        private readonly GetAutoridadByIdQueryHandler $getAutoridadByIdHandler,
        private readonly CreateAutoridadHandler $createHandler,
        private readonly UpdateAutoridadHandler $updateHandler,
        private readonly DeleteAutoridadHandler $deleteHandler,
        private readonly AutoridadRepositoryInterface $autoridadRepository,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 20),
            'query' => $request->get('query', ''),
            'sortKey' => $request->input('sort.key', 'orden'),
            'sortOrder' => $request->input('sort.order', 'asc'),
        ]);

        return response()->json(
            $this->getAutoridadesHandler->handle(
                new GetAutoridadesQuery($pagination, $request->boolean('soloActivos', false))
            )
        );
    }

    public function store(StoreAutoridadRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateAutoridadCommand(
            nombre: $request->nombre,
            apellido: $request->apellido,
            cargo: $request->cargo,
            tipo: $request->input('tipo', 'director'),
            secretaria_id: $request->secretaria_id ? (int) $request->secretaria_id : null,
            perfil_profesional: $request->perfil_profesional,
            email_institucional: $request->email_institucional,
            foto_url: $request->foto_url,
            orden: $request->integer('orden', 0),
            activo: $request->boolean('activo', true),
            fecha_inicio_cargo: $request->fecha_inicio_cargo,
            fecha_fin_cargo: $request->fecha_fin_cargo,
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getAutoridadByIdHandler->handle(new GetAutoridadByIdQuery($id)));
    }

    public function update(UpdateAutoridadRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateAutoridadCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteAutoridadCommand($id));

        return response()->json(null, 204);
    }

    public function porTipo(string $tipo): JsonResponse
    {
        return response()->json($this->autoridadRepository->findByTipo($tipo));
    }
}
