<?php

namespace App\Http\Controllers\Api;

use App\Application\EscalaSalarial\Commands\CreateEscalaSalarialCommand;
use App\Application\EscalaSalarial\Commands\DeleteEscalaSalarialCommand;
use App\Application\EscalaSalarial\Commands\UpdateEscalaSalarialCommand;
use App\Application\EscalaSalarial\Handlers\CreateEscalaSalarialHandler;
use App\Application\EscalaSalarial\Handlers\DeleteEscalaSalarialHandler;
use App\Application\EscalaSalarial\Handlers\UpdateEscalaSalarialHandler;
use App\Application\EscalaSalarial\Queries\GetAllEscalasSalarialesQuery;
use App\Application\EscalaSalarial\QueryHandlers\GetAllEscalasSalarialesQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\EscalaSalarial\StoreEscalaSalarialRequest;
use App\Http\Requests\EscalaSalarial\UpdateEscalaSalarialRequest;
use Illuminate\Http\JsonResponse;

class EscalaSalarialController extends Controller
{
    public function __construct(
        private readonly GetAllEscalasSalarialesQueryHandler $getAllHandler,
        private readonly CreateEscalaSalarialHandler $createHandler,
        private readonly UpdateEscalaSalarialHandler $updateHandler,
        private readonly DeleteEscalaSalarialHandler $deleteHandler,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->getAllHandler->handle(new GetAllEscalasSalarialesQuery));
    }

    public function store(StoreEscalaSalarialRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateEscalaSalarialCommand(
            nivel: $request->nivel,
            descripcion_cargo: $request->descripcion_cargo,
            sueldo_basico: (float) $request->sueldo_basico,
            categoria: $request->categoria,
        ));

        return response()->json($dto, 201);
    }

    public function update(UpdateEscalaSalarialRequest $request, int $id): JsonResponse
    {
        return response()->json($this->updateHandler->handle(new UpdateEscalaSalarialCommand($id, $request->validated())));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteHandler->handle(new DeleteEscalaSalarialCommand($id));

        return response()->json(null, 204);
    }
}
