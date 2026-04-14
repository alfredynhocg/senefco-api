<?php

namespace App\Http\Controllers\Api;

use App\Application\CategoriasIndicador\Queries\GetAllCategoriasIndicadorQuery;
use App\Application\CategoriasIndicador\QueryHandlers\GetAllCategoriasIndicadorQueryHandler;
use App\Application\IndicadoresGestion\Commands\CreateIndicadorCommand;
use App\Application\IndicadoresGestion\Handlers\CreateIndicadorHandler;
use App\Application\IndicadoresGestion\Queries\GetIndicadoresQuery;
use App\Application\IndicadoresGestion\QueryHandlers\GetIndicadoresQueryHandler;
use App\Application\ValoresIndicador\Commands\CreateValorIndicadorCommand;
use App\Application\ValoresIndicador\Handlers\CreateValorIndicadorHandler;
use App\Application\ValoresIndicador\Queries\GetValoresByIndicadorQuery;
use App\Application\ValoresIndicador\QueryHandlers\GetValoresByIndicadorQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\IndicadoresGestion\StoreIndicadorRequest;
use App\Http\Requests\ValoresIndicador\StoreValorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndicadorController extends Controller
{
    public function __construct(
        private readonly GetAllCategoriasIndicadorQueryHandler $getCategoriasHandler,
        private readonly GetIndicadoresQueryHandler $getIndicadoresHandler,
        private readonly CreateIndicadorHandler $createHandler,
        private readonly GetValoresByIndicadorQueryHandler $getValoresHandler,
        private readonly CreateValorIndicadorHandler $createValorHandler,
    ) {}

    public function indexCategorias(): JsonResponse
    {
        return response()->json($this->getCategoriasHandler->handle(new GetAllCategoriasIndicadorQuery));
    }

    public function index(Request $request): JsonResponse
    {
        $filters = [
            'categoria_id' => $request->get('categoria_id'),
            'activo' => $request->has('activo') ? $request->boolean('activo') : null,
            'publico' => $request->has('publico') ? $request->boolean('publico') : null,
        ];

        return response()->json($this->getIndicadoresHandler->handle(new GetIndicadoresQuery($filters)));
    }

    public function store(StoreIndicadorRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateIndicadorCommand(
            categoria_id: $request->categoria_id,
            nombre: $request->nombre,
            descripcion: $request->descripcion,
            unidad_medida: $request->unidad_medida,
            frecuencia_actualizacion: $request->frecuencia_actualizacion,
            publico: $request->boolean('publico', true),
            activo: $request->boolean('activo', true),
            orden_dashboard: $request->get('orden_dashboard', 0),
        ));

        return response()->json($dto, 201);
    }

    public function indexValores(int $indicadorId): JsonResponse
    {
        return response()->json($this->getValoresHandler->handle(new GetValoresByIndicadorQuery($indicadorId)));
    }

    public function storeValor(StoreValorRequest $request): JsonResponse
    {
        $dto = $this->createValorHandler->handle(new CreateValorIndicadorCommand(
            indicador_id: $request->indicador_id,
            valor: (float) $request->valor,
            gestion: (int) $request->gestion,
            mes: $request->mes,
            fecha_registro: $request->fecha_registro,
            fuente: $request->fuente,
            registrado_por: $request->user()?->id,
        ));

        return response()->json($dto, 201);
    }
}
