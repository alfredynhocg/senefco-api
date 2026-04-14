<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Inyecta soloActivos=true en todas las rutas del portal público,
 * asegurando que solo se retornen registros activos/publicados.
 */
class SoloActivosPortal
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->merge(['soloActivos' => true]);

        return $next($request);
    }
}
