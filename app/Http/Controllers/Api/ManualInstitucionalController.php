<?php

namespace App\Http\Controllers\Api;

use App\Application\ManualesInstitucionales\Commands\CreateManualInstitucionalCommand;
use App\Application\ManualesInstitucionales\Commands\DeleteManualInstitucionalCommand;
use App\Application\ManualesInstitucionales\Commands\UpdateManualInstitucionalCommand;
use App\Application\ManualesInstitucionales\Handlers\CreateManualInstitucionalHandler;
use App\Application\ManualesInstitucionales\Handlers\DeleteManualInstitucionalHandler;
use App\Application\ManualesInstitucionales\Handlers\UpdateManualInstitucionalHandler;
use App\Application\ManualesInstitucionales\Queries\GetAllManualesQuery;
use App\Application\ManualesInstitucionales\Queries\GetManualByIdQuery;
use App\Application\ManualesInstitucionales\QueryHandlers\GetAllManualesQueryHandler;
use App\Application\ManualesInstitucionales\QueryHandlers\GetManualByIdQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManualesInstitucionales\StoreManualRequest;
use App\Http\Requests\ManualesInstitucionales\UpdateManualRequest;
use Illuminate\Http\JsonResponse;

class ManualInstitucionalController extends Controller
{
    public function __construct(
        private readonly GetAllManualesQueryHandler $getAllHandler,
        private readonly GetManualByIdQueryHandler $getByIdHandler,
        private readonly CreateManualInstitucionalHandler $createHandler,
        private readonly UpdateManualInstitucionalHandler $updateHandler,
        private readonly DeleteManualInstitucionalHandler $deleteHandler,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->getAllHandler->handle(new GetAllManualesQuery));
    }

    public function store(StoreManualRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateManualInstitucionalCommand(
            tipo:               $request->tipo,
            titulo:             $request->titulo,
            descripcion:        $request->descripcion,
            archivo_url:        $request->archivo_url,
            formato:            $request->formato,
            numero_paginas:     $request->numero_paginas,
            gestion:            $request->gestion,
            version:            $request->get('version', 1),
            vigente:            $request->boolean('vigente', true),
            fecha_publicacion:  $request->fecha_publicacion,
            publicado_por:      $request->user()?->id,
        ));

        return response()->json($dto, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->getByIdHandler->handle(new GetManualByIdQuery($id)));
    }

    public function update(UpdateManualRequest $request, int $id): JsonResponse
    {
        return response()->json(
            $this->updateHandler->handle(new UpdateManualInstitucionalCommand($id, $request->validated()))
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteManualInstitucionalCommand($id));

        return response()->json(null, 204);
    }
}
