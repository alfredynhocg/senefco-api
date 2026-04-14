<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransparenciaSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = DB::table('tipos_documento_transparencia')
            ->pluck('id', 'nombre');

        $secretarias = DB::table('secretarias')
            ->pluck('id', 'nombre');

        $documentos = [
            [
                'tipo' => 'Presupuesto Aprobado',
                'secretaria' => 'Secretaría Municipal de Administración y Finanzas',
                'titulo' => 'Presupuesto Municipal Aprobado Gestión 2026',
                'descripcion' => 'Presupuesto General del Municipio aprobado por el Concejo Municipal para la gestión 2026.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/presupuesto-2026.pdf',
                'gestion' => 2026,
                'fecha_publicacion' => '2026-01-10',
            ],
            [
                'tipo' => 'Presupuesto Aprobado',
                'secretaria' => 'Secretaría Municipal de Administración y Finanzas',
                'titulo' => 'Presupuesto Municipal Aprobado Gestión 2025',
                'descripcion' => 'Presupuesto General del Municipio aprobado para la gestión 2025.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/presupuesto-2025.pdf',
                'gestion' => 2025,
                'fecha_publicacion' => '2025-01-08',
            ],
            [
                'tipo' => 'Ejecución Presupuestaria',
                'secretaria' => 'Secretaría Municipal de Administración y Finanzas',
                'titulo' => 'Informe de Ejecución Presupuestaria Primer Trimestre 2026',
                'descripcion' => 'Reporte de ejecución del gasto público municipal al primer trimestre de 2026.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/ejecucion-t1-2026.pdf',
                'gestion' => 2026,
                'fecha_publicacion' => '2026-04-15',
            ],
            [
                'tipo' => 'Ejecución Presupuestaria',
                'secretaria' => 'Secretaría Municipal de Administración y Finanzas',
                'titulo' => 'Informe de Ejecución Presupuestaria Anual 2025',
                'descripcion' => 'Reporte de ejecución presupuestaria consolidado de la gestión 2025.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/ejecucion-anual-2025.pdf',
                'gestion' => 2025,
                'fecha_publicacion' => '2026-02-28',
            ],
            [
                'tipo' => 'Plan Operativo Anual (POA)',
                'secretaria' => 'Secretaría Municipal de Planificación y Desarrollo',
                'titulo' => 'Plan Operativo Anual (POA) 2026 - Alcaldía Municipal',
                'descripcion' => 'Documento de planificación operativa anual del municipio para la gestión 2026.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/poa-2026.pdf',
                'gestion' => 2026,
                'fecha_publicacion' => '2026-01-20',
            ],
            [
                'tipo' => 'Informe de Gestión',
                'secretaria' => 'Alcaldía Municipal de Achocalla',
                'titulo' => 'Informe de Gestión Anual 2025',
                'descripcion' => 'Memoria de gestión institucional de la Alcaldía Municipal correspondiente a la gestión 2025.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/informe-gestion-2025.pdf',
                'gestion' => 2025,
                'fecha_publicacion' => '2026-03-01',
            ],
            [
                'tipo' => 'Contratos y Licitaciones',
                'secretaria' => 'Secretaría Municipal de Obras Públicas',
                'titulo' => 'Contratos de Obras Públicas - Primer Trimestre 2026',
                'descripcion' => 'Registro de contratos de obras públicas suscritos en el primer trimestre de 2026.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/contratos-t1-2026.pdf',
                'gestion' => 2026,
                'fecha_publicacion' => '2026-04-01',
            ],
            [
                'tipo' => 'Informe de Auditoría',
                'secretaria' => 'Alcaldía Municipal de Achocalla',
                'titulo' => 'Informe de Auditoría Interna Gestión 2025',
                'descripcion' => 'Informe final de auditoría interna a las operaciones administrativas y financieras 2025.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/auditoria-interna-2025.pdf',
                'gestion' => 2025,
                'fecha_publicacion' => '2026-03-15',
            ],
            [
                'tipo' => 'Actas de Concejo Municipal',
                'secretaria' => 'Alcaldía Municipal de Achocalla',
                'titulo' => 'Actas de Sesiones del Concejo Municipal - Marzo 2026',
                'descripcion' => 'Actas de las sesiones ordinarias y extraordinarias del Concejo Municipal de marzo 2026.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/actas-concejo-marzo-2026.pdf',
                'gestion' => 2026,
                'fecha_publicacion' => '2026-04-02',
            ],
            [
                'tipo' => 'Estadísticas e Indicadores',
                'secretaria' => 'Secretaría Municipal de Planificación y Desarrollo',
                'titulo' => 'Estadísticas e Indicadores de Gestión 2025',
                'descripcion' => 'Compendio estadístico de indicadores de gestión municipal correspondiente a la gestión 2025.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/estadisticas-2025.pdf',
                'gestion' => 2025,
                'fecha_publicacion' => '2026-02-15',
            ],
            [
                'tipo' => 'Memoria Anual',
                'secretaria' => 'Alcaldía Municipal de Achocalla',
                'titulo' => 'Memoria Anual Alcaldía Municipal 2025',
                'descripcion' => 'Memoria institucional con los principales logros y resultados de la gestión municipal 2025.',
                'archivo_url' => 'https://senefco.gob.bo/transparencia/memoria-2025.pdf',
                'gestion' => 2025,
                'fecha_publicacion' => '2026-03-20',
            ],
        ];

        foreach ($documentos as $doc) {
            $tipoId = $tipos->get($doc['tipo']);
            $secretariaId = $secretarias->get($doc['secretaria']);

            if (! $tipoId || ! $secretariaId) {
                continue;
            }

            DB::table('documentos_transparencia')->insert([
                'tipo_documento_id' => $tipoId,
                'secretaria_id' => $secretariaId,
                'publicado_por' => 1,
                'titulo' => $doc['titulo'],
                'descripcion' => $doc['descripcion'],
                'archivo_url' => $doc['archivo_url'],
                'gestion' => $doc['gestion'],
                'fecha_publicacion' => $doc['fecha_publicacion'],
                'activo' => true,
                'slug' => Str::slug($doc['titulo']),
            ]);
        }
    }
}
