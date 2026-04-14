<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadesResponsablesSeeder extends Seeder
{
    public function run(): void
    {
        $unidades = [
            ['secretaria_id' => 1, 'nombre' => 'Unidad de Gestión Documental',          'direccion' => 'PB Palacio Municipal',     'telefono' => '+591 2 2000011', 'email' => 'documental@senefco.gob.bo',        'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 1, 'nombre' => 'Unidad de Comunicación e Imagen',        'direccion' => 'PB Palacio Municipal',     'telefono' => '+591 2 2000012', 'email' => 'comunicacion@senefco.gob.bo',      'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 1, 'nombre' => 'Unidad de Tecnologías de la Información', 'direccion' => 'Sótano Palacio Municipal', 'telefono' => '+591 2 2000013', 'email' => 'tic@senefco.gob.bo',               'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 2, 'nombre' => 'Unidad de Presupuesto',                  'direccion' => '1er piso ala norte',       'telefono' => '+591 2 2000021', 'email' => 'presupuesto@senefco.gob.bo',       'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 2, 'nombre' => 'Unidad de Tesorería',                    'direccion' => '1er piso ala norte',       'telefono' => '+591 2 2000022', 'email' => 'tesoreria@senefco.gob.bo',         'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 2, 'nombre' => 'Unidad de Contabilidad',                 'direccion' => '1er piso ala norte',       'telefono' => '+591 2 2000023', 'email' => 'contabilidad@senefco.gob.bo',      'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 2, 'nombre' => 'Unidad de Recaudaciones y Catastro',     'direccion' => 'PB Palacio Municipal',     'telefono' => '+591 2 2000024', 'email' => 'recaudaciones@senefco.gob.bo',     'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 3, 'nombre' => 'Unidad de Proyectos e Ingeniería',       'direccion' => '2do piso Palacio Municipal', 'telefono' => '+591 2 2000031', 'email' => 'proyectos@senefco.gob.bo',         'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 3, 'nombre' => 'Unidad de Mantenimiento Vial',           'direccion' => 'Av. del Ejército 100',     'telefono' => '+591 2 2000032', 'email' => 'vial@senefco.gob.bo',              'horario' => 'Lun-Vie 07:00–15:00', 'activa' => true],
            ['secretaria_id' => 3, 'nombre' => 'Unidad de Supervisión de Obras',         'direccion' => '2do piso Palacio Municipal', 'telefono' => '+591 2 2000033', 'email' => 'supervision.obras@senefco.gob.bo', 'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 4, 'nombre' => 'Unidad de Salud Municipal',              'direccion' => '3er piso Palacio Municipal', 'telefono' => '+591 2 2000041', 'email' => 'salud@senefco.gob.bo',             'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 4, 'nombre' => 'Unidad de Educación Municipal',          'direccion' => '3er piso Palacio Municipal', 'telefono' => '+591 2 2000042', 'email' => 'educacion@senefco.gob.bo',         'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 4, 'nombre' => 'Unidad de Programas Sociales',           'direccion' => '3er piso Palacio Municipal', 'telefono' => '+591 2 2000043', 'email' => 'programas.sociales@senefco.gob.bo', 'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 4, 'nombre' => 'Unidad de Género y Familia',             'direccion' => 'Av. Simón Bolívar 234',    'telefono' => '+591 2 2000044', 'email' => 'genero@senefco.gob.bo',            'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 5, 'nombre' => 'Unidad de Gestión Ambiental',            'direccion' => 'Av. Ecológica 123',        'telefono' => '+591 2 2000051', 'email' => 'gestion.ambiental@senefco.gob.bo', 'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 5, 'nombre' => 'Unidad de Residuos Sólidos',             'direccion' => 'Av. Ecológica 123',        'telefono' => '+591 2 2000052', 'email' => 'residuos@senefco.gob.bo',          'horario' => 'Lun-Vie 07:00–15:00', 'activa' => true],
            ['secretaria_id' => 5, 'nombre' => 'Unidad de Áreas Verdes y Parques',       'direccion' => 'Av. Ecológica 123',        'telefono' => '+591 2 2000053', 'email' => 'areas.verdes@senefco.gob.bo',      'horario' => 'Lun-Vie 07:00–15:00', 'activa' => true],
            ['secretaria_id' => 5, 'nombre' => 'Unidad de Gestión de Riesgos',           'direccion' => 'Av. Ecológica 123',        'telefono' => '+591 2 2000054', 'email' => 'riesgos@senefco.gob.bo',           'horario' => 'Lun-Dom 08:00–18:00', 'activa' => true],
            ['secretaria_id' => 6, 'nombre' => 'Unidad de Planificación Estratégica',    'direccion' => '4to piso Palacio Municipal', 'telefono' => '+591 2 2000061', 'email' => 'planificacion.estrategica@senefco.gob.bo', 'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 6, 'nombre' => 'Unidad de Inversión Pública',            'direccion' => '4to piso Palacio Municipal', 'telefono' => '+591 2 2000062', 'email' => 'inversion@senefco.gob.bo',         'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 6, 'nombre' => 'Unidad de Desarrollo Económico Local',   'direccion' => '4to piso Palacio Municipal', 'telefono' => '+591 2 2000063', 'email' => 'desarrollo.economico@senefco.gob.bo', 'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 7, 'nombre' => 'Unidad de Asesoramiento Legal',          'direccion' => '1er piso ala sur',         'telefono' => '+591 2 2000071', 'email' => 'legal@senefco.gob.bo',             'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 7, 'nombre' => 'Unidad de Contratos y Licitaciones',     'direccion' => '1er piso ala sur',         'telefono' => '+591 2 2000072', 'email' => 'contratos@senefco.gob.bo',         'horario' => 'Lun-Vie 08:30–16:30', 'activa' => true],
            ['secretaria_id' => 8, 'nombre' => 'Unidad de Cultura y Patrimonio',         'direccion' => 'Centro Cultural Municipal', 'telefono' => '+591 2 2000081', 'email' => 'cultura.patrimonio@senefco.gob.bo', 'horario' => 'Lun-Vie 08:30–17:00', 'activa' => true],
            ['secretaria_id' => 8, 'nombre' => 'Unidad de Turismo',                      'direccion' => 'Centro Cultural Municipal', 'telefono' => '+591 2 2000082', 'email' => 'turismo@senefco.gob.bo',           'horario' => 'Lun-Vie 08:30–17:00', 'activa' => true],
            ['secretaria_id' => 8, 'nombre' => 'Unidad de Deportes y Recreación',        'direccion' => 'Estadio Municipal s/n',    'telefono' => '+591 2 2000083', 'email' => 'deportes@senefco.gob.bo',          'horario' => 'Lun-Sáb 07:00–18:00', 'activa' => true],
        ];

        DB::table('unidades_responsables')->insert($unidades);
    }
}
