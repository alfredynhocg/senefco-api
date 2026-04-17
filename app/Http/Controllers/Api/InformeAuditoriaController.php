<?php

namespace App\Http\Controllers\Api;

use App\Application\InformesAuditoria\Commands\CreateInformeAuditoriaCommand;
use App\Application\InformesAuditoria\Commands\DeleteInformeAuditoriaCommand;
use App\Application\InformesAuditoria\Commands\UpdateInformeAuditoriaCommand;
use App\Application\InformesAuditoria\Handlers\CreateInformeAuditoriaHandler;
use App\Application\InformesAuditoria\Handlers\DeleteInformeAuditoriaHandler;
use App\Application\InformesAuditoria\Handlers\UpdateInformeAuditoriaHandler;
use App\Application\InformesAuditoria\Queries\GetInformeAuditoriaByIdQuery;
use App\Application\InformesAuditoria\Queries\GetInformesAuditoriaQuery;
use App\Application\InformesAuditoria\QueryHandlers\GetInformeAuditoriaByIdQueryHandler;
use App\Application\InformesAuditoria\QueryHandlers\GetInformesAuditoriaQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\InformesAuditoria\StoreInformeAuditoriaRequest;
use App\Http\Requests\InformesAuditoria\UpdateInformeAuditoriaRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InformeAuditoriaController extends Controller
{
    public function __construct(
        private readonly GetInformesAuditoriaQueryHandler $getInformesHandler,
        private readonly GetInformeAuditoriaByIdQueryHandler $getByIdHandler,
        private readonly CreateInformeAuditoriaHandler $createHandler,
        private readonly UpdateInformeAuditoriaHandler $updateHandler,
        private readonly DeleteInformeAuditoriaHandler $deleteHandler,
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
            $this->getInformesHandler->handle(
                new GetInformesAuditoriaQuery(
                    $pagination,
                    $request->boolean('soloPublicados', false),
                )
            )
        );
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(
            $this->getByIdHandler->handle(new GetInformeAuditoriaByIdQuery($id))
        );
    }

    public function store(StoreInformeAuditoriaRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateInformeAuditoriaCommand(
            nombre: $request->nombre,
            descripcion: $request->descripcion,
            pdf_url: $request->pdf_url,
            pdf_nombre: $request->pdf_nombre,
            estado: $request->estado ?? 'borrador',
            fecha: $request->fecha,
            anio: (int) $request->anio,
            publicado_en_web: $request->boolean('publicado_en_web', false),
            publicado_por: auth()->id(),
        ));

        return response()->json($dto, 201);
    }

    public function update(UpdateInformeAuditoriaRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->updateHandler->handle(new UpdateInformeAuditoriaCommand(
                id: $id,
                data: $request->validated(),
            ))
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteInformeAuditoriaCommand($id));

        return response()->json(null, 204);
    }
}
