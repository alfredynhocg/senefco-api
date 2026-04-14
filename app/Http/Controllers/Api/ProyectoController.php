<?php

namespace App\Http\Controllers\Api;

use App\Application\AvanceProyecto\Commands\CreateAvanceProyectoCommand;
use App\Application\AvanceProyecto\Handlers\CreateAvanceProyectoHandler;
use App\Application\AvanceProyecto\Queries\GetAvancesByProyectoQuery;
use App\Application\AvanceProyecto\QueryHandlers\GetAvancesByProyectoQueryHandler;
use App\Application\EstadosProyecto\Queries\GetAllEstadosProyectoQuery;
use App\Application\EstadosProyecto\QueryHandlers\GetAllEstadosProyectoQueryHandler;
use App\Application\Proyectos\Commands\CreateProyectoCommand;
use App\Application\Proyectos\Handlers\CreateProyectoHandler;
use App\Application\Proyectos\Queries\GetProyectosQuery;
use App\Application\Proyectos\QueryHandlers\GetProyectosQueryHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\AvanceProyecto\StoreAvanceRequest;
use App\Http\Requests\Proyectos\StoreProyectoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function __construct(
        private readonly GetAllEstadosProyectoQueryHandler $getEstadosHandler,
        private readonly GetProyectosQueryHandler $getProyectosHandler,
        private readonly CreateProyectoHandler $createHandler,
        private readonly GetAvancesByProyectoQueryHandler $getAvancesHandler,
        private readonly CreateAvanceProyectoHandler $createAvanceHandler,
    ) {}

    public function indexEstados(): JsonResponse
    {
        return response()->json($this->getEstadosHandler->handle(new GetAllEstadosProyectoQuery));
    }

    public function index(Request $request): JsonResponse
    {
        $filters = [
            'estado_id' => $request->get('estado_id'),
            'secretaria_id' => $request->get('secretaria_id'),
            'publico' => $request->has('publico') ? $request->boolean('publico') : null,
        ];

        return response()->json($this->getProyectosHandler->handle(new GetProyectosQuery($filters)));
    }

    public function store(StoreProyectoRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateProyectoCommand(
            estado_id: $request->estado_id,
            secretaria_id: $request->secretaria_id,
            nombre: $request->nombre,
            codigo_sipfe: $request->codigo_sipfe,
            descripcion: $request->descripcion,
            presupuesto_total: (float) $request->presupuesto_total,
            ubicacion_texto: $request->ubicacion_texto,
            latitud: $request->latitud ? (float) $request->latitud : null,
            longitud: $request->longitud ? (float) $request->longitud : null,
            contratista: $request->contratista,
            fecha_inicio_estimada: $request->fecha_inicio_estimada,
            fecha_fin_estimada: $request->fecha_fin_estimada,
            imagen_portada_url: $request->imagen_portada_url,
            publico: $request->boolean('publico', true),
        ));

        return response()->json($dto, 201);
    }

    public function indexAvances(int $proyectoId): JsonResponse
    {
        return response()->json($this->getAvancesHandler->handle(new GetAvancesByProyectoQuery($proyectoId)));
    }

    public function storeAvance(StoreAvanceRequest $request): JsonResponse
    {
        $dto = $this->createAvanceHandler->handle(new CreateAvanceProyectoCommand(
            proyecto_id: $request->proyecto_id,
            porcentaje_fisico: (float) $request->porcentaje_fisico,
            monto_financiero_ejecutado: (float) $request->monto_financiero_ejecutado,
            fecha_reporte: $request->fecha_reporte,
            descripcion_avance: $request->descripcion_avance,
            fotografia_url: $request->fotografia_url,
            registrado_por: $request->user()?->id,
        ));

        return response()->json($dto, 201);
    }
}
