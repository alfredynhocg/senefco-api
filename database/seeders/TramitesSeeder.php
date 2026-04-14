<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TramitesSeeder extends Seeder
{
    public function run(): void
    {
        $tramites = [
            [
                'tipo_tramite_id' => 2,
                'unidad_responsable_id' => 7,
                'nombre' => 'Certificado Catastral',
                'descripcion' => 'Documento oficial que certifica los datos catastrales de un inmueble urbano registrado en el municipio.',
                'procedimiento' => '1. Presentar solicitud en ventanilla. 2. Adjuntar documentos requeridos. 3. Pago de arancel. 4. Revisión técnica. 5. Emisión del certificado.',
                'costo' => 120.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 5,
                'normativa_base' => 'Ley 247 - Regularización de Derecho Propietario',
                'modalidad' => 'presencial',
                'activo' => true,
            ],
            [
                'tipo_tramite_id' => 2,
                'unidad_responsable_id' => 7,
                'nombre' => 'Actualización de Datos Catastrales',
                'descripcion' => 'Actualización de información catastral por modificaciones en el inmueble (construcciones, subdivisiones, etc.).',
                'procedimiento' => '1. Solicitud con planos actualizados. 2. Inspección técnica in situ. 3. Actualización en sistema. 4. Emisión de nuevo certificado.',
                'costo' => 200.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 10,
                'normativa_base' => 'Reglamento Catastral Municipal',
                'modalidad' => 'presencial',
                'activo' => true,
            ],

            [
                'tipo_tramite_id' => 3,
                'unidad_responsable_id' => 7,
                'nombre' => 'Licencia de Funcionamiento',
                'descripcion' => 'Autorización municipal para el funcionamiento legal de establecimientos comerciales, industriales o de servicios.',
                'procedimiento' => '1. Presentar formulario de solicitud. 2. Adjuntar NIT, matrícula de comercio y plano de ubicación. 3. Inspección del local. 4. Pago de tasa. 5. Emisión de licencia.',
                'costo' => 350.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 7,
                'normativa_base' => 'Ley 2492 y Ordenanza Municipal',
                'modalidad' => 'presencial',
                'activo' => true,
            ],
            [
                'tipo_tramite_id' => 3,
                'unidad_responsable_id' => 7,
                'nombre' => 'Renovación de Licencia de Funcionamiento',
                'descripcion' => 'Renovación anual de la licencia de funcionamiento de establecimientos comerciales.',
                'procedimiento' => '1. Presentar licencia anterior. 2. Verificar vigencia del NIT. 3. Inspección si hay cambios. 4. Pago de renovación. 5. Emisión.',
                'costo' => 250.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 3,
                'normativa_base' => 'Ordenanza Municipal de Actividades Económicas',
                'modalidad' => 'presencial',
                'activo' => true,
            ],

            [
                'tipo_tramite_id' => 4,
                'unidad_responsable_id' => 13,
                'nombre' => 'Subsidio de Lactancia',
                'descripcion' => 'Apoyo económico para madres en período de lactancia con hijos menores de 2 años.',
                'procedimiento' => '1. Presentar carnet de identidad. 2. Certificado de nacimiento del menor. 3. Constancia médica. 4. Evaluación socioeconómica. 5. Aprobación y pago.',
                'costo' => 0.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 5,
                'normativa_base' => 'Código Niño Niña Adolescente',
                'modalidad' => 'presencial',
                'activo' => true,
            ],
            [
                'tipo_tramite_id' => 4,
                'unidad_responsable_id' => 14,
                'nombre' => 'Atención a Víctimas de Violencia Intrafamiliar',
                'descripcion' => 'Servicio de atención integral a víctimas de violencia doméstica e intrafamiliar.',
                'procedimiento' => '1. Denuncia en ventanilla SLIM. 2. Evaluación psicológica. 3. Orientación legal. 4. Derivación si corresponde. 5. Seguimiento del caso.',
                'costo' => 0.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 1,
                'normativa_base' => 'Ley 348 - Ley Integral para Garantizar a las Mujeres una Vida Libre de Violencia',
                'modalidad' => 'presencial',
                'activo' => true,
            ],

            [
                'tipo_tramite_id' => 5,
                'unidad_responsable_id' => 15,
                'nombre' => 'Licencia Ambiental Municipal',
                'descripcion' => 'Autorización ambiental para actividades que puedan generar impacto en el medio ambiente dentro del municipio.',
                'procedimiento' => '1. Presentar formulario FA-1. 2. Adjuntar Estudio de Evaluación de Impacto Ambiental. 3. Revisión técnica. 4. Inspección. 5. Resolución administrativa.',
                'costo' => 500.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 20,
                'normativa_base' => 'Ley 1333 del Medio Ambiente',
                'modalidad' => 'presencial',
                'activo' => true,
            ],
            [
                'tipo_tramite_id' => 5,
                'unidad_responsable_id' => 16,
                'nombre' => 'Solicitud de Servicio de Recolección de Residuos Especiales',
                'descripcion' => 'Solicitud para recolección de residuos sólidos especiales (escombros, voluminosos, residuos peligrosos domésticos).',
                'procedimiento' => '1. Solicitud en ventanilla. 2. Descripción del tipo de residuo. 3. Programación de recolección. 4. Pago según volumen.',
                'costo' => 80.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 3,
                'normativa_base' => 'Reglamento de Gestión de Residuos Sólidos Municipal',
                'modalidad' => 'presencial',
                'activo' => true,
            ],

            [
                'tipo_tramite_id' => 6,
                'unidad_responsable_id' => 8,
                'nombre' => 'Permiso de Construcción',
                'descripcion' => 'Autorización municipal para iniciar obras de construcción, ampliación o refacción de inmuebles.',
                'procedimiento' => '1. Presentar planos arquitectónicos aprobados. 2. Memoria descriptiva. 3. Certificado catastral. 4. Revisión técnica de planos. 5. Pago de tasa. 6. Emisión del permiso.',
                'costo' => 450.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 15,
                'normativa_base' => 'Reglamento de Uso de Suelos y Patrones de Asentamiento',
                'modalidad' => 'presencial',
                'activo' => true,
            ],
            [
                'tipo_tramite_id' => 6,
                'unidad_responsable_id' => 10,
                'nombre' => 'Visado de Planos',
                'descripcion' => 'Revisión y visado oficial de planos de construcción por la Unidad de Supervisión de Obras.',
                'procedimiento' => '1. Presentar planos en formato digital y físico. 2. Revisión de cumplimiento normativo. 3. Correcciones si hubiere. 4. Sello y firma de visado.',
                'costo' => 150.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 7,
                'normativa_base' => 'Norma de Edificaciones NB 1225001',
                'modalidad' => 'presencial',
                'activo' => true,
            ],

            [
                'tipo_tramite_id' => 8,
                'unidad_responsable_id' => 11,
                'nombre' => 'Carnet de Manipulación de Alimentos',
                'descripcion' => 'Certificación sanitaria obligatoria para personas que trabajan en establecimientos de expendio de alimentos.',
                'procedimiento' => '1. Presentar CI. 2. Examen médico en centro de salud municipal. 3. Capacitación en higiene alimentaria. 4. Pago de arancel. 5. Emisión del carnet.',
                'costo' => 60.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 3,
                'normativa_base' => 'Reglamento Sanitario Municipal',
                'modalidad' => 'presencial',
                'activo' => true,
            ],
            [
                'tipo_tramite_id' => 8,
                'unidad_responsable_id' => 11,
                'nombre' => 'Certificado de Aptitud Sanitaria',
                'descripcion' => 'Certificación del estado sanitario de establecimientos de servicios de alimentación, salud y hospedaje.',
                'procedimiento' => '1. Solicitud formal. 2. Inspección del establecimiento. 3. Informe técnico. 4. Resolución y emisión del certificado.',
                'costo' => 180.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 5,
                'normativa_base' => 'Código de Salud Bolivia',
                'modalidad' => 'presencial',
                'activo' => true,
            ],

            [
                'tipo_tramite_id' => 9,
                'unidad_responsable_id' => 12,
                'nombre' => 'Beca Municipal de Estudios',
                'descripcion' => 'Apoyo económico para estudiantes de escasos recursos en niveles primario, secundario y superior.',
                'procedimiento' => '1. Presentar solicitud. 2. Certificado de calificaciones. 3. Certificado de ingresos familiares. 4. Entrevista de evaluación. 5. Resolución de asignación.',
                'costo' => 0.00,
                'moneda' => 'BOB',
                'dias_habiles_resolucion' => 15,
                'normativa_base' => 'Programa Municipal de Becas',
                'modalidad' => 'presencial',
                'activo' => true,
            ],
        ];

        $tramiteIds = [];
        foreach ($tramites as $data) {
            $data['slug'] = Str::slug($data['nombre']);
            $id = DB::table('tramites_catalogo')->insertGetId($data);
            $tramiteIds[] = ['id' => $id, 'nombre' => $data['nombre']];
        }

        $requisitos = [
            // Certificado Catastral
            $tramiteIds[0]['id'] => [
                ['nombre' => 'Fotocopia de Carnet de Identidad', 'obligatorio' => true,  'tipo' => 'documento', 'orden' => 1],
                ['nombre' => 'Escritura de propiedad o título',  'obligatorio' => true,  'tipo' => 'documento', 'orden' => 2],
                ['nombre' => 'Formulario de solicitud',          'obligatorio' => true,  'tipo' => 'formulario', 'orden' => 3],
                ['nombre' => 'Comprobante de pago de impuesto',  'obligatorio' => false, 'tipo' => 'documento', 'orden' => 4],
            ],
            // Licencia de Funcionamiento
            $tramiteIds[2]['id'] => [
                ['nombre' => 'Carnet de identidad del titular',       'obligatorio' => true,  'tipo' => 'documento', 'orden' => 1],
                ['nombre' => 'NIT actualizado',                        'obligatorio' => true,  'tipo' => 'documento', 'orden' => 2],
                ['nombre' => 'Matrícula de comercio',                  'obligatorio' => true,  'tipo' => 'documento', 'orden' => 3],
                ['nombre' => 'Plano de ubicación del establecimiento', 'obligatorio' => true,  'tipo' => 'plano',     'orden' => 4],
                ['nombre' => 'Contrato de alquiler o título de propiedad', 'obligatorio' => true, 'tipo' => 'documento', 'orden' => 5],
                ['nombre' => 'Formulario de solicitud',                'obligatorio' => true,  'tipo' => 'formulario', 'orden' => 6],
            ],
            // Permiso de Construcción
            $tramiteIds[8]['id'] => [
                ['nombre' => 'Certificado catastral vigente',     'obligatorio' => true,  'tipo' => 'documento', 'orden' => 1],
                ['nombre' => 'Planos arquitectónicos (3 juegos)', 'obligatorio' => true,  'tipo' => 'plano',     'orden' => 2],
                ['nombre' => 'Memoria descriptiva',               'obligatorio' => true,  'tipo' => 'documento', 'orden' => 3],
                ['nombre' => 'Cálculo estructural',               'obligatorio' => false, 'tipo' => 'documento', 'orden' => 4],
                ['nombre' => 'Carnet del profesional responsable', 'obligatorio' => true,  'tipo' => 'documento', 'orden' => 5],
            ],
            // Carnet de Manipulación de Alimentos
            $tramiteIds[10]['id'] => [
                ['nombre' => 'Carnet de identidad vigente',        'obligatorio' => true, 'tipo' => 'documento', 'orden' => 1],
                ['nombre' => 'Fotografía 4x4 fondo blanco',        'obligatorio' => true, 'tipo' => 'otro',      'orden' => 2],
                ['nombre' => 'Resultado de examen médico',         'obligatorio' => true, 'tipo' => 'documento', 'orden' => 3],
                ['nombre' => 'Constancia de capacitación previa',  'obligatorio' => false, 'tipo' => 'documento', 'orden' => 4],
            ],
        ];

        foreach ($requisitos as $tramiteId => $lista) {
            foreach ($lista as $req) {
                DB::table('requisitos_tramite')->insert(array_merge(['tramite_id' => $tramiteId], $req));
            }
        }
    }
}
