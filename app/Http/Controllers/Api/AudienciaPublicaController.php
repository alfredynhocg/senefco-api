<?php

namespace App\Http\Controllers\Api;

use App\Application\AudienciasPublicas\Commands\CreateAudienciaPublicaCommand;
use App\Application\AudienciasPublicas\Commands\DeleteAudienciaPublicaCommand;
use App\Application\AudienciasPublicas\Commands\UpdateAudienciaPublicaCommand;
use App\Application\AudienciasPublicas\Handlers\CreateAudienciaPublicaHandler;
use App\Application\AudienciasPublicas\Handlers\DeleteAudienciaPublicaHandler;
use App\Application\AudienciasPublicas\Handlers\UpdateAudienciaPublicaHandler;
use App\Application\AudienciasPublicas\Queries\GetAudienciaPublicaByIdQuery;
use App\Application\AudienciasPublicas\Queries\GetAudienciasPublicasQuery;
use App\Application\AudienciasPublicas\QueryHandlers\GetAudienciaPublicaByIdQueryHandler;
use App\Application\AudienciasPublicas\QueryHandlers\GetAudienciasPublicasQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\AudienciasPublicas\StoreAudienciaPublicaRequest;
use App\Http\Requests\AudienciasPublicas\UpdateAudienciaPublicaRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AudienciaPublicaController extends Controller
{
    public function __construct(
        private readonly GetAudienciasPublicasQueryHandler $getListHandler,
        private readonly GetAudienciaPublicaByIdQueryHandler $getByIdHandler,
        private readonly CreateAudienciaPublicaHandler $createHandler,
        private readonly UpdateAudienciaPublicaHandler $updateHandler,
        private readonly DeleteAudienciaPublicaHandler $deleteHandler,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $pagination = PaginationDTO::fromArray([
            'pageIndex' => $request->get('pageIndex', 1),
            'pageSize' => $request->get('pageSize', 15),
            'query' => $request->get('query', ''),
            'sortKey' => $request->input('sort.key', 'created_at'),
            'sortOrder' => $request->input('sort.order', 'desc'),
        ]);

        return response()->json(
            $this->getListHandler->handle(
                new GetAudienciasPublicasQuery($pagination, $request->boolean('soloActivos', false))
            )
        );
    }

    public function store(StoreAudienciaPublicaRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateAudienciaPublicaCommand(
            titulo: $request->titulo,
            descripcion: $request->descripcion,
            tipo: $request->input('tipo', 'inicial'),
            estado: $request->input('estado', 'convocada'),
            acta_url: $request->acta_url,
            afiche_url: $request->afiche_url,
            imagenes: $request->input('imagenes', []),
            video_url: $request->video_url,
            enlace_virtual: $request->enlace_virtual,
            asistentes: $request->asistentes ? (int) $request->asistentes : null,
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getByIdHandler->handle(new GetAudienciaPublicaByIdQuery($id)));
    }

    public function update(UpdateAudienciaPublicaRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateAudienciaPublicaCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteAudienciaPublicaCommand($id));

        return response()->json(null, 204);
    }
}
