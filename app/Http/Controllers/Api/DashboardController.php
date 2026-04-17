<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Infrastructure\Comunicados\Models\Comunicado;
use App\Infrastructure\ConsultasCiudadanas\Models\ConsultaCiudadana;
use App\Infrastructure\Eventos\Models\Evento;
use App\Infrastructure\Noticias\Models\Noticia;
use App\Infrastructure\TramiteSolicitudes\Models\TramiteSolicitud;
use App\Infrastructure\Usuarios\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function stats(): JsonResponse
    {
        $now = now();
        $mesInicio = $now->copy()->startOfMonth();

        $resumen = [
            'tramites_pendientes' => TramiteSolicitud::where('estado', 'pendiente')->count(),
            'tramites_mes' => TramiteSolicitud::where('created_at', '>=', $mesInicio)->count(),
            'comunicados_publicados' => Comunicado::where('estado', 'publicado')
                ->where('created_at', '>=', $mesInicio)->count(),
            'noticias_publicadas' => Noticia::where('estado', 'publicado')
                ->where('created_at', '>=', $mesInicio)->count(),
            'consultas_nuevas' => ConsultaCiudadana::where('estado', 'nueva')->count(),
            'eventos_proximos' => Evento::where('fecha_inicio', '>=', $now)->count(),
            'total_usuarios' => User::count(),
            'total_proyectos_activos' => 0,
        ];

        $tramitesPorEstado = TramiteSolicitud::select('estado', DB::raw('count(*) as total'))
            ->groupBy('estado')
            ->pluck('total', 'estado')
            ->toArray();

        $actividadMensual = [];
        for ($i = 5; $i >= 0; $i--) {
            $inicio = $now->copy()->subMonths($i)->startOfMonth();
            $fin = $now->copy()->subMonths($i)->endOfMonth();
            $mes = $inicio->locale('es')->isoFormat('MMM YY');

            $actividadMensual[] = [
                'mes' => $mes,
                'tramites' => TramiteSolicitud::whereBetween('created_at', [$inicio, $fin])->count(),
                'comunicados' => Comunicado::whereBetween('created_at', [$inicio, $fin])->count(),
                'noticias' => Noticia::whereBetween('created_at', [$inicio, $fin])->count(),
            ];
        }

        $ultimasSolicitudes = TramiteSolicitud::with('tramite')
            ->latest()
            ->take(10)
            ->get()
            ->map(fn ($s) => [
                'id' => $s->id,
                'numero' => $s->numero_seguimiento ?? 'TRM-'.$s->id,
                'ciudadano' => $s->nombre_ciudadano,
                'tipo_tramite' => $s->tramite?->nombre ?? 'Sin tipo',
                'estado' => $s->estado,
                'fecha' => $s->created_at?->format('d/m/Y'),
            ]);

        $ultimasConsultas = ConsultaCiudadana::latest()
            ->take(8)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'nombre' => $c->ciudadano_nombre,
                'asunto' => $c->asunto,
                'estado' => $c->estado,
                'fecha' => $c->created_at?->format('d/m/Y'),
            ]);

        $topTramites = TramiteSolicitud::select('tramite_id', DB::raw('count(*) as total_solicitudes'))
            ->with('tramite')
            ->groupBy('tramite_id')
            ->orderByDesc('total_solicitudes')
            ->take(5)
            ->get()
            ->map(fn ($row) => [
                'id' => $row->tramite_id,
                'nombre' => $row->tramite?->nombre ?? 'Sin nombre',
                'slug' => $row->tramite?->slug ?? '',
                'total_solicitudes' => (int) $row->total_solicitudes,
            ]);

        return response()->json([
            'resumen' => $resumen,
            'tramites_por_estado' => $tramitesPorEstado,
            'actividad_mensual' => $actividadMensual,
            'ultimas_solicitudes' => $ultimasSolicitudes,
            'ultimas_consultas' => $ultimasConsultas,
            'top_tramites' => $topTramites,
        ]);
    }
}
