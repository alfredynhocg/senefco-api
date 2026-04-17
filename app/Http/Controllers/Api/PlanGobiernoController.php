<?php

namespace App\Http\Controllers\Api;

use App\Application\PlanesGobierno\Commands\CreatePlanGobiernoCommand;
use App\Application\PlanesGobierno\Commands\DeletePlanGobiernoCommand;
use App\Application\PlanesGobierno\Commands\UpdatePlanGobiernoCommand;
use App\Application\PlanesGobierno\Handlers\CreatePlanGobiernoHandler;
use App\Application\PlanesGobierno\Handlers\DeletePlanGobiernoHandler;
use App\Application\PlanesGobierno\Handlers\UpdatePlanGobiernoHandler;
use App\Application\PlanesGobierno\Queries\GetAllPlanesGobiernoQuery;
use App\Application\PlanesGobierno\Queries\GetPlanGobiernoByIdQuery;
use App\Application\PlanesGobierno\QueryHandlers\GetAllPlanesGobiernoQueryHandler;
use App\Application\PlanesGobierno\QueryHandlers\GetPlanGobiernoByIdQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanesGobierno\StorePlanGobiernoRequest;
use App\Http\Requests\PlanesGobierno\UpdatePlanGobiernoRequest;
use Illuminate\Http\JsonResponse;

class PlanGobiernoController extends Controller
{
    public function __construct(
        private readonly GetAllPlanesGobiernoQueryHandler $getAllHandler,
        private readonly GetPlanGobiernoByIdQueryHandler $getByIdHandler,
        private readonly CreatePlanGobiernoHandler $createHandler,
        private readonly UpdatePlanGobiernoHandler $updateHandler,
        private readonly DeletePlanGobiernoHandler $deleteHandler,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->getAllHandler->handle(new GetAllPlanesGobiernoQuery));
    }

    public function store(StorePlanGobiernoRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreatePlanGobiernoCommand(
            titulo:             $request->titulo,
            gestion_inicio:     $request->gestion_inicio,
            gestion_fin:        $request->gestion_fin,
            descripcion:        $request->descripcion,
            documento_pdf_url:  $request->documento_pdf_url,
            publicado_por:      $request->user()?->id,
            vigente:            $request->boolean('vigente', true),
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getByIdHandler->handle(new GetPlanGobiernoByIdQuery($id)));
    }

    public function update(UpdatePlanGobiernoRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->updateHandler->handle(new UpdatePlanGobiernoCommand($id, $request->validated()))
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeletePlanGobiernoCommand($id));

        return response()->json(null, 204);
    }
}
