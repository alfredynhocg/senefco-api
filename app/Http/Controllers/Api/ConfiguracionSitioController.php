<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ConfiguracionSitioController extends Controller
{
    public function publica(): JsonResponse
    {
        $rows = DB::table('configuracion_sitio')
            ->whereIn('clave', [
                'nombre_municipio',
                'eslogan',
                'email_contacto',
                'telefono_central',
                'direccion',
                'horario_atencion',
                'logo_url',
                'himno',
            ])
            ->pluck('valor', 'clave');

        return response()->json(['data' => $rows]);
    }
}
