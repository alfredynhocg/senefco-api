<?php

namespace App\Http\Controllers\Api;

use App\Application\PlanesGobierno\Commands\CreatePlanGobiernoCommand;
use App\Application\PlanesGobierno\Handlers\CreatePlanGobiernoHandler;
use App\Application\PlanesGobierno\Queries\GetAllPlanesGobiernoQuery;
use App\Application\PlanesGobierno\QueryHandlers\GetAllPlanesGobiernoQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanesGobierno\StorePlanGobiernoRequest;
use Illuminate\Http\JsonResponse;

class PlanGobiernoController extends Controller
{
    public function __construct(
        private readonly GetAllPlanesGobiernoQueryHandler $getAllHandler,
        private readonly CreatePlanGobiernoHandler $createHandler,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->getAllHandler->handle(new GetAllPlanesGobiernoQuery));
    }

    public function store(StorePlanGobiernoRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreatePlanGobiernoCommand(
            titulo: $request->titulo,
            gestion_inicio: $request->gestion_inicio,
            gestion_fin: $request->gestion_fin,
            descripcion: $request->descripcion,
            documento_pdf_url: $request->documento_pdf_url,
            publicado_por: $request->user()?->id,
            vigente: $request->boolean('vigente', true),
        ));

        return response()->json($dto, 201);
    }
}
