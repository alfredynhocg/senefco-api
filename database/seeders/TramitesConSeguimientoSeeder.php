<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TramitesConSeguimientoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = DB::table('tipos_tramite')->pluck('id', 'nombre');
        $unidades = DB::table('unidades_responsables')->pluck('id', 'nombre');

        $tipoSocial = $tipos['Servicios Sociales'] ?? ($tipos->first() ?? 1);
        $tipoAmbiental = $tipos['Medio Ambiente'] ?? $tipoSocial;
        $tipoObras = $tipos['Obras Públicas'] ?? $tipoSocial;

        $unidadDocumental = $unidades['Unidad de Gestión Documental'] ?? ($unidades->first() ?? 1);
        $unidadResiduos = $unidades['Unidad de Residuos Sólidos'] ?? $unidadDocumental;
        $unidadObras = $unidades['Unidad de Proyectos e Ingeniería'] ?? $unidadDocumental;
        $unidadSupervision = $unidades['Unidad de Supervisión de Obras'] ?? $unidadDocumental;
        $unidadSocial = $unidades['Unidad de Programas Sociales'] ?? $unidadDocumental;
        $unidadGenero = $unidades['Unidad de Género y Familia'] ?? $unidadDocumental;

        $tramites = [
            [
                'tipo_tramite_id' => $tipoSocial,
                'unidad_responsable_id' => $unidadDocumental,
                'nombre' => 'Certificado de Domicilio',
                'descripcion' => 'Documento oficial que certifica la dirección de domicilio del ciudadano dentro del municipio de Achocalla.',
                'procedimiento' => '1. Presentar solicitud. 2. Adjuntar CI y factura de servicio. 3. Inspección domiciliaria. 4. Elaboración y firma. 5. Retiro en oficina.',
                'costo' => 30.00,
                'dias_habiles_resolucion' => 3,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Recepción y Registro',       'Tu solicitud fue recibida y registrada en el sistema.',                                              'Espera la verificación de tus datos.', false],
                    [2, 'Verificación de Datos',      'Verificamos tu información en el padrón municipal.',                                               'Tus datos están siendo revisados.', false],
                    [3, 'Inspección Domiciliaria',    'Un funcionario realiza la visita de constatación al domicilio indicado.',                          'Un funcionario visitará tu domicilio próximamente.', false],
                    [4, 'Elaboración del Certificado', 'Preparamos el certificado con los datos verificados.',                                              'El certificado está siendo elaborado.', false],
                    [5, 'Firma y Sellado',            'El director firma y sella el certificado.',                                                        'El certificado está en proceso de firma.', false],
                    [6, 'Listo para Retiro',          'El certificado está listo. Apersónese a Gestión Documental (PB Palacio Municipal) con su CI.',     'Apersónese con su CI a las oficinas.', true],
                ],
            ],
            [
                'tipo_tramite_id' => $tipoSocial,
                'unidad_responsable_id' => $unidadDocumental,
                'nombre' => 'Constancia de Residencia',
                'descripcion' => 'Constancia que certifica el tiempo de residencia del ciudadano en el municipio, requerida para pasaportes, becas y otros trámites.',
                'procedimiento' => '1. Presentar solicitud. 2. Adjuntar CI y documentos de respaldo. 3. Consulta de historial. 4. Elaboración. 5. Retiro.',
                'costo' => 20.00,
                'dias_habiles_resolucion' => 2,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Recepción y Registro',       'Solicitud registrada en el sistema municipal.',                                                    'Tu trámite ha sido ingresado.', false],
                    [2, 'Verificación en Padrón',     'Se consulta el padrón municipal para verificar tu residencia.',                                    'Verificando tu historial de residencia.', false],
                    [3, 'Consulta de Historial',      'Se revisa el historial completo de residencia en el municipio.',                                   'Revisando documentos históricos.', false],
                    [4, 'Elaboración de Constancia',  'Preparamos el documento con la información verificada.',                                           'El documento está siendo elaborado.', false],
                    [5, 'Firma y Sellado',            'La constancia es firmada y sellada por la autoridad municipal.',                                   'Esperando firma de autoridad.', false],
                    [6, 'Listo para Retiro',          'La constancia está lista. Apersónese a Gestión Documental (PB Palacio Municipal) con su CI.',     'Apersónese con su CI a las oficinas.', true],
                ],
            ],
            [
                'tipo_tramite_id' => $tipoSocial,
                'unidad_responsable_id' => $unidadDocumental,
                'nombre' => 'Registro de Nuevo Ciudadano',
                'descripcion' => 'Registro inicial de un ciudadano en el padrón municipal de Achocalla para acceder a servicios y beneficios municipales.',
                'procedimiento' => '1. Presentar documentos de identidad. 2. Revisión documental. 3. Validación de datos. 4. Registro en padrón. 5. Retiro de constancia.',
                'costo' => 0.00,
                'dias_habiles_resolucion' => 2,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Recepción de Documentos',    'Documentos recibidos y solicitud registrada.',                                                     'Tus documentos han sido recibidos.', false],
                    [2, 'Revisión Documental',        'Se verifica que los documentos presentados estén completos y vigentes.',                           'Revisando la documentación presentada.', false],
                    [3, 'Validación de Datos',        'Se valida la información en los sistemas municipales e interoperables.',                           'Validando datos en el sistema.', false],
                    [4, 'Registro en Padrón',         'El ciudadano es incorporado al padrón municipal de Achocalla.',                                    'Tu registro está siendo procesado.', false],
                    [5, 'Emisión de Constancia',      'Se genera la constancia de registro en el padrón.',                                               'Generando tu constancia de registro.', false],
                    [6, 'Listo para Retiro',          'La constancia de registro está lista. Apersónese a Gestión Documental (PB) con su CI.',           'Apersónese con su CI a las oficinas.', true],
                ],
            ],
            [
                'tipo_tramite_id' => $tipoSocial,
                'unidad_responsable_id' => $unidadDocumental,
                'nombre' => 'Actualización de Datos Ciudadanos',
                'descripcion' => 'Modificación y actualización de datos personales en el padrón municipal (cambio de domicilio, nombre, estado civil, etc.).',
                'procedimiento' => '1. Presentar solicitud con justificación. 2. Adjuntar documentos de respaldo. 3. Verificación. 4. Actualización en sistema. 5. Retiro.',
                'costo' => 0.00,
                'dias_habiles_resolucion' => 1,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Recepción de Solicitud',     'Solicitud de actualización registrada correctamente.',                                             'Tu solicitud ha sido recibida.', false],
                    [2, 'Verificación de Identidad',  'Se verifica la identidad del solicitante con documentos originales.',                             'Verificando tu identidad.', false],
                    [3, 'Revisión de Cambios',        'Se revisan los datos a modificar y la documentación de respaldo.',                                'Revisando los cambios solicitados.', false],
                    [4, 'Actualización en Sistema',   'Los datos son actualizados en el padrón y sistemas municipales.',                                 'Actualizando tu información en el sistema.', false],
                    [5, 'Generación de Confirmación', 'Se genera la constancia de actualización de datos.',                                             'Generando tu confirmación de cambio.', false],
                    [6, 'Listo para Retiro',          'La constancia está lista. Apersónese a Gestión Documental (PB) con su CI.',                      'Apersónese con su CI a las oficinas.', true],
                ],
            ],
            [
                'tipo_tramite_id' => $tipoObras,
                'unidad_responsable_id' => $unidadObras,
                'nombre' => 'Solicitud de Alumbrado Público',
                'descripcion' => 'Solicitud de instalación, reparación o reposición de luminarias en calles y espacios públicos del municipio.',
                'procedimiento' => '1. Registrar solicitud indicando la dirección exacta. 2. Evaluación técnica. 3. Inspección en campo. 4. Programación. 5. Ejecución.',
                'costo' => 0.00,
                'dias_habiles_resolucion' => 7,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Recepción de Solicitud',     'Solicitud registrada con número de seguimiento asignado.',                                        'Tu solicitud fue registrada.', false],
                    [2, 'Evaluación Técnica',         'El equipo técnico evalúa la viabilidad de la solicitud.',                                        'Evaluando los requerimientos técnicos.', false],
                    [3, 'Inspección en Campo',        'Un técnico realiza la inspección del punto solicitado.',                                         'Inspeccionando el sector indicado.', false],
                    [4, 'Programación del Trabajo',   'Se programa la intervención en el cronograma de trabajos.',                                      'Tu solicitud fue programada en el cronograma.', false],
                    [5, 'Ejecución del Servicio',     'El equipo de obras ejecuta el trabajo de alumbrado.',                                           'Realizando el trabajo en tu zona.', false],
                    [6, 'Servicio Completado',        'El servicio fue ejecutado. Apersónese a Proyectos e Ingeniería (2do piso) para constancia.',    'Apersónese si necesita comprobante de atención.', true],
                ],
            ],
            [
                'tipo_tramite_id' => $tipoAmbiental,
                'unidad_responsable_id' => $unidadResiduos,
                'nombre' => 'Solicitud de Limpieza de Calles',
                'descripcion' => 'Solicitud de limpieza, desbrozamiento o saneamiento de calles, pasajes y espacios públicos dentro del municipio.',
                'procedimiento' => '1. Registrar solicitud con ubicación y descripción. 2. Asignación de brigada. 3. Programación. 4. Intervención. 5. Cierre.',
                'costo' => 0.00,
                'dias_habiles_resolucion' => 5,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Registro de Solicitud',      'Solicitud recibida y asignado número de seguimiento.',                                           'Tu solicitud ha sido registrada.', false],
                    [2, 'Asignación a Brigada',       'Se asigna una brigada de limpieza para atender tu solicitud.',                                  'Asignando la brigada correspondiente.', false],
                    [3, 'Programación de Visita',     'Se incluye tu solicitud en el cronograma de limpieza.',                                         'Programada la visita en el cronograma.', false],
                    [4, 'Intervención en Campo',      'La brigada realiza las tareas de limpieza en el lugar solicitado.',                             'Brigada realizando trabajos en el sector.', false],
                    [5, 'Informe de Actividad',       'Se elabora el informe técnico de la intervención realizada.',                                   'Elaborando informe de trabajo ejecutado.', false],
                    [6, 'Caso Cerrado',               'La limpieza fue ejecutada. Apersónese a Residuos Sólidos (Av. Ecológica 123) si necesita constancia.', 'Apersónese si requiere constancia de atención.', true],
                ],
            ],
            [
                'tipo_tramite_id' => $tipoAmbiental,
                'unidad_responsable_id' => $unidadResiduos,
                'nombre' => 'Denuncia por Basura Acumulada',
                'descripcion' => 'Denuncia ciudadana por acumulación irregular de residuos sólidos en vías públicas, lotes baldíos o espacios comunitarios.',
                'procedimiento' => '1. Registrar denuncia con ubicación y descripción. 2. Asignación de inspector. 3. Verificación en campo. 4. Notificación. 5. Resolución.',
                'costo' => 0.00,
                'dias_habiles_resolucion' => 3,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Registro de Denuncia',       'Tu denuncia fue registrada con número de seguimiento.',                                          'Denuncia registrada correctamente.', false],
                    [2, 'Asignación a Inspector',     'Se asigna un inspector ambiental para verificar la denuncia.',                                  'Inspector asignado a tu caso.', false],
                    [3, 'Verificación en Campo',      'El inspector verifica la situación denunciada en el lugar.',                                    'Inspector realizando verificación en campo.', false],
                    [4, 'Notificación al Infractor',  'Si corresponde, se notifica al responsable y se exige corrección.',                            'Notificación al responsable en proceso.', false],
                    [5, 'Supervisión de Corrección',  'Se supervisa que se corrija la situación denunciada.',                                          'Supervisando la corrección de la situación.', false],
                    [6, 'Resolución del Caso',        'La denuncia fue resuelta. Apersónese a Residuos Sólidos (Av. Ecológica 123) para la resolución escrita.', 'Apersónese para recoger la resolución escrita.', true],
                ],
            ],
            [
                'tipo_tramite_id' => $tipoObras,
                'unidad_responsable_id' => $unidadSupervision,
                'nombre' => 'Denuncia de Construcción Ilegal',
                'descripcion' => 'Denuncia ciudadana sobre construcciones que incumplen normas urbanísticas, invaden vías públicas o carecen de permiso municipal.',
                'procedimiento' => '1. Presentar denuncia con dirección exacta. 2. Asignación técnica. 3. Inspección. 4. Informe. 5. Proceso administrativo. 6. Resolución.',
                'costo' => 0.00,
                'dias_habiles_resolucion' => 10,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Registro de Denuncia',       'Denuncia registrada y asignado número de seguimiento.',                                          'Tu denuncia fue ingresada al sistema.', false],
                    [2, 'Asignación Técnica',         'Se asigna un técnico de supervisión de obras para el caso.',                                    'Técnico asignado a tu denuncia.', false],
                    [3, 'Inspección in Situ',         'El técnico realiza inspección en el lugar de la construcción denunciada.',                      'Técnico realizando inspección en campo.', false],
                    [4, 'Informe Técnico',            'Se elabora el informe técnico con los hallazgos de la inspección.',                            'Elaborando informe técnico del caso.', false],
                    [5, 'Proceso Administrativo',     'Se inicia el proceso administrativo correspondiente (notificación, multa o demolición).',      'Proceso administrativo en curso.', false],
                    [6, 'Resolución Administrativa',  'La denuncia fue resuelta. Apersónese a Supervisión de Obras (2do piso) para recoger la resolución.', 'Apersónese para recoger la resolución administrativa.', true],
                ],
            ],
            [
                'tipo_tramite_id' => $tipoSocial,
                'unidad_responsable_id' => $unidadGenero,
                'nombre' => 'Atención en SLIM - Unidad de la Mujer',
                'descripcion' => 'Servicio Integral del SLIM para atención a mujeres en situación de violencia, orientación psicológica, patrocinio legal y seguimiento de casos.',
                'procedimiento' => '1. Registrar solicitud o denuncia. 2. Entrevista social. 3. Evaluación psicológica. 4. Orientación legal. 5. Seguimiento. 6. Cierre.',
                'costo' => 0.00,
                'dias_habiles_resolucion' => 1,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Recepción y Registro',       'Tu caso fue registrado de forma confidencial con número de seguimiento.',                        'Tu caso fue registrado con confidencialidad.', false],
                    [2, 'Entrevista Social',           'Una trabajadora social realiza la entrevista inicial para evaluar el caso.',                    'Coordinando entrevista con trabajadora social.', false],
                    [3, 'Evaluación Psicológica',      'Se evalúa el estado psicológico y emocional para brindar apoyo adecuado.',                     'Agendando evaluación psicológica.', false],
                    [4, 'Orientación y Patrocinio Legal', 'La unidad jurídica orienta y puede asumir el patrocinio legal si corresponde.',             'Recibiendo orientación legal.', false],
                    [5, 'Seguimiento del Caso',        'Se realiza el seguimiento activo del caso con cronograma de atenciones.',                      'Caso en seguimiento activo.', false],
                    [6, 'Cierre y Derivación',         'El caso fue atendido. Apersónese a la Unidad de Género y Familia (Av. Simón Bolívar 234) para el cierre.', 'Apersónese a la Unidad de Género y Familia.', true],
                ],
            ],
            [
                'tipo_tramite_id' => $tipoSocial,
                'unidad_responsable_id' => $unidadSocial,
                'nombre' => 'Atención para Adulto Mayor',
                'descripcion' => 'Servicio de atención integral al adulto mayor para acceder a beneficios sociales, orientación, asistencia y programas municipales.',
                'procedimiento' => '1. Registrar solicitud. 2. Evaluación de necesidades. 3. Visita domiciliaria. 4. Plan de atención. 5. Implementación. 6. Seguimiento.',
                'costo' => 0.00,
                'dias_habiles_resolucion' => 5,
                'modalidad' => 'presencial',
                'etapas' => [
                    [1, 'Recepción de Solicitud',     'Solicitud del adulto mayor registrada en el sistema.',                                          'Tu solicitud fue registrada.', false],
                    [2, 'Evaluación de Necesidades',  'Una trabajadora social evalúa las necesidades específicas del solicitante.',                    'Evaluando tus necesidades con trabajadora social.', false],
                    [3, 'Visita Domiciliaria',         'Se realiza visita al domicilio para verificar las condiciones del adulto mayor.',               'Programando visita domiciliaria.', false],
                    [4, 'Plan de Atención',            'Se elabora el plan personalizado de atención y beneficios.',                                   'Elaborando tu plan de atención personalizado.', false],
                    [5, 'Implementación del Servicio', 'Se inician los servicios y beneficios asignados al adulto mayor.',                             'Implementando los servicios asignados.', false],
                    [6, 'Seguimiento y Alta',          'El servicio fue activado. Apersónese a Programas Sociales (3er piso) para firmar conformidad.', 'Apersónese a Programas Sociales para la firma.', true],
                ],
            ],
        ];

        foreach ($tramites as $tramiteData) {
            $etapas = $tramiteData['etapas'];
            unset($tramiteData['etapas']);

            $tramiteData['slug'] = Str::slug($tramiteData['nombre']);
            $tramiteData['activo'] = true;
            $tramiteData['moneda'] = 'BOB';

            $existente = DB::table('tramites_catalogo')->where('slug', $tramiteData['slug'])->first();
            if ($existente) {
                $tramiteId = $existente->id;
            } else {
                $tramiteId = DB::table('tramites_catalogo')->insertGetId($tramiteData);
            }

            $etapasExistentes = DB::table('tramite_etapas')->where('tramite_id', $tramiteId)->count();
            if ($etapasExistentes === 0) {
                foreach ($etapas as [$orden, $nombre, $descripcion, $instruccion, $esFinal]) {
                    DB::table('tramite_etapas')->insert([
                        'tramite_id' => $tramiteId,
                        'nombre' => $nombre,
                        'descripcion' => $descripcion,
                        'instruccion_ciudadano' => $instruccion,
                        'orden' => $orden,
                        'es_final' => $esFinal,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
