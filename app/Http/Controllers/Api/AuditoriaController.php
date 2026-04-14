<?php

namespace App\Http\Controllers\Api;

use App\Application\Auditorias\Commands\CreateAuditoriaCommand;
use App\Application\Auditorias\Handlers\CreateAuditoriaHandler;
use App\Application\Auditorias\Queries\GetPaginatedAuditoriasQuery;
use App\Application\Auditorias\QueryHandlers\GetPaginatedAuditoriasQueryHandler;
use App\Application\HallazgosAuditoria\Commands\CreateHallazgoAuditoriaCommand;
use App\Application\HallazgosAuditoria\Handlers\CreateHallazgoAuditoriaHandler;
use App\Application\HallazgosAuditoria\Queries\GetHallazgosByAuditoriaQuery;
use App\Application\HallazgosAuditoria\QueryHandlers\GetHallazgosByAuditoriaQueryHandler;
use App\Application\TiposAuditoria\Queries\GetAllTiposAuditoriaQuery;
use App\Application\TiposAuditoria\QueryHandlers\GetAllTiposAuditoriaQueryHandler;
use App\Domain\Auditorias\Contracts\AuditoriaRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auditorias\StoreAuditoriaRequest;
use App\Http\Requests\HallazgosAuditoria\StoreHallazgoRequest;
use App\Shared\Kernel\DTOs\PaginationDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    public function __construct(
        private readonly GetAllTiposAuditoriaQueryHandler $getTiposHandler,
        private readonly GetPaginatedAuditoriasQueryHandler $getPaginatedHandler,
        private readonly CreateAuditoriaHandler $createHandler,
        private readonly GetHallazgosByAuditoriaQueryHandler $getHallazgosHandler,
        private readonly CreateHallazgoAuditoriaHandler $createHallazgoHandler,
        private readonly AuditoriaRepositoryInterface $auditoriaRepository,
    ) {}

    public function indexTipos(): JsonResponse
    {
        return response()->json($this->getTiposHandler->handle(new GetAllTiposAuditoriaQuery));
    }

    public function index(Request $request): JsonResponse
    {
        $pagination = new PaginationDTO(
            pageIndex: (int) $request->get('page', 1),
            pageSize: (int) $request->get('per_page', 15),
            query: (string) $request->get('q', ''),
            sortKey: $request->get('sort', 'created_at'),
            sortOrder: $request->get('order', 'desc'),
        );

        $filters = [
            'tipo_id' => $request->get('tipo_id'),
            'secretaria_id' => $request->get('secretaria_id'),
            'publico' => $request->has('publico') ? $request->boolean('publico') : null,
            'soloActivos' => $request->boolean('soloActivos', false),
        ];

        return response()->json($this->getPaginatedHandler->handle(new GetPaginatedAuditoriasQuery($pagination, $filters)));
    }

    public function showBySlug(string $slug): JsonResponse
    {
        return response()->json($this->auditoriaRepository->findBySlug($slug));
    }

    public function store(StoreAuditoriaRequest $request): JsonResponse
    {
        $dto = $this->createHandler->handle(new CreateAuditoriaCommand(
            tipo_auditoria_id: $request->tipo_auditoria_id,
            codigo_auditoria: $request->codigo_auditoria,
            titulo: $request->titulo,
            secretaria_auditada_id: $request->secretaria_auditada_id,
            objeto_examen: $request->objeto_examen,
            entidad_auditora: $request->entidad_auditora,
            gestion_auditada: $request->gestion_auditada,
            fecha_inicio: $request->fecha_inicio,
            fecha_fin: $request->fecha_fin,
            estado: $request->get('estado', 'planificada'),
            informe_pdf_url: $request->informe_pdf_url,
            publico: $request->boolean('publico', false),
            publicado_por: $request->user()?->id,
        ));

        return response()->json($dto, 201);
    }

    public function indexHallazgos(int $auditoriaId): JsonResponse
    {
        return response()->json($this->getHallazgosHandler->handle(new GetHallazgosByAuditoriaQuery($auditoriaId)));
    }

    public function storeHallazgo(StoreHallazgoRequest $request): JsonResponse
    {
        $dto = $this->createHallazgoHandler->handle(new CreateHallazgoAuditoriaCommand(
            auditoria_id: $request->auditoria_id,
            descripcion: $request->descripcion,
            tipo: $request->get('tipo', 'hallazgo'),
            recomendacion: $request->recomendacion,
            estado_seguimiento: $request->get('estado_seguimiento', 'pendiente'),
            secretaria_responsable_id: $request->secretaria_responsable_id,
            fecha_limite: $request->fecha_limite,
        ));

        return response()->json($dto, 201);
    }
}
