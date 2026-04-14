<?php

use App\Http\Controllers\Api\AjusteController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\BannerPortalController;
use App\Http\Controllers\Api\CategoriaNoticiaController;
use App\Http\Controllers\Api\ContactoMunicipalController;
use App\Http\Controllers\Api\DocumentoController;
use App\Http\Controllers\Api\EtiquetaController;
use App\Http\Controllers\Api\EventoController;
use App\Http\Controllers\Api\EventoFotoController;
use App\Http\Controllers\Api\FormularioController;
use App\Http\Controllers\Api\MensajeContactoController;
use App\Http\Controllers\Api\NoticiaController;
use App\Http\Controllers\Api\RedSocialController;
use App\Http\Controllers\Api\RequisitoController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SecretariaController;
use App\Http\Controllers\Api\SubsenefcoController;
use App\Http\Controllers\Api\SugerenciaReclamoController;
use App\Http\Controllers\Api\TipoDocumentoTransparenciaController;
use App\Http\Controllers\Api\TipoEventoController;
use App\Http\Controllers\Api\TipoTramiteController;
use App\Http\Controllers\Api\TramiteController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\WhatsAppAdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'stats']);

    Route::post('/upload/image', [UploadController::class, 'image']);
    Route::post('/upload/file', [UploadController::class, 'file']);

    Route::get('/redes-sociales', [RedSocialController::class, 'index']);
    Route::post('/redes-sociales', [RedSocialController::class, 'store']);
    Route::get('/redes-sociales/{id}', [RedSocialController::class, 'show']);
    Route::put('/redes-sociales/{id}', [RedSocialController::class, 'update']);
    Route::delete('/redes-sociales/{id}', [RedSocialController::class, 'destroy']);

    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/{id}', [RoleController::class, 'show']);
    Route::post('/roles', [RoleController::class, 'store'])
        ->middleware('permiso:usuarios.crear');
    Route::put('/roles/{id}', [RoleController::class, 'update'])
        ->middleware('permiso:usuarios.editar');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])
        ->middleware('permiso:usuarios.eliminar');

    Route::get('/categorias-noticia', [CategoriaNoticiaController::class, 'index']);
    Route::post('/categorias-noticia', [CategoriaNoticiaController::class, 'store'])
        ->middleware('permiso:noticias.crear');
    Route::get('/categorias-noticia/{id}', [CategoriaNoticiaController::class, 'show']);
    Route::put('/categorias-noticia/{id}', [CategoriaNoticiaController::class, 'update'])
        ->middleware('permiso:noticias.editar');
    Route::delete('/categorias-noticia/{id}', [CategoriaNoticiaController::class, 'destroy'])
        ->middleware('permiso:noticias.eliminar');

    Route::get('/etiquetas', [EtiquetaController::class, 'index']);
    Route::post('/etiquetas', [EtiquetaController::class, 'store'])
        ->middleware('permiso:noticias.crear');
    Route::get('/etiquetas/{id}', [EtiquetaController::class, 'show']);
    Route::put('/etiquetas/{id}', [EtiquetaController::class, 'update'])
        ->middleware('permiso:noticias.editar');
    Route::delete('/etiquetas/{id}', [EtiquetaController::class, 'destroy'])
        ->middleware('permiso:noticias.eliminar');

    Route::get('/noticias', [NoticiaController::class, 'index']);
    Route::post('/noticias', [NoticiaController::class, 'store'])
        ->middleware('permiso:noticias.crear');
    Route::get('/noticias/{id}', [NoticiaController::class, 'show']);
    Route::get('/noticias/slug/{slug}', [NoticiaController::class, 'showBySlug']);
    Route::put('/noticias/{id}', [NoticiaController::class, 'update'])
        ->middleware('permiso:noticias.editar');
    Route::delete('/noticias/{id}', [NoticiaController::class, 'destroy'])
        ->middleware('permiso:noticias.eliminar');

    Route::get('/secretarias', [SecretariaController::class, 'index']);
    Route::post('/secretarias', [SecretariaController::class, 'store'])
        ->middleware('permiso:secretarias.crear');
    Route::get('/secretarias/{id}', [SecretariaController::class, 'show']);
    Route::put('/secretarias/{id}', [SecretariaController::class, 'update'])
        ->middleware('permiso:secretarias.editar');
    Route::delete('/secretarias/{id}', [SecretariaController::class, 'destroy'])
        ->middleware('permiso:secretarias.eliminar');

    Route::get('/subsenefcos', [SubsenefcoController::class, 'index']);
    Route::post('/subsenefcos', [SubsenefcoController::class, 'store'])
        ->middleware('permiso:secretarias.crear');
    Route::get('/subsenefcos/{id}', [SubsenefcoController::class, 'show']);
    Route::put('/subsenefcos/{id}', [SubsenefcoController::class, 'update'])
        ->middleware('permiso:secretarias.editar');
    Route::delete('/subsenefcos/{id}', [SubsenefcoController::class, 'destroy'])
        ->middleware('permiso:secretarias.eliminar');

    Route::get('/tipos-tramite', [TipoTramiteController::class, 'index']);
    Route::post('/tipos-tramite', [TipoTramiteController::class, 'store'])
        ->middleware('permiso:tramites.crear');
    Route::get('/tipos-tramite/{id}', [TipoTramiteController::class, 'show']);
    Route::put('/tipos-tramite/{id}', [TipoTramiteController::class, 'update'])
        ->middleware('permiso:tramites.editar');
    Route::delete('/tipos-tramite/{id}', [TipoTramiteController::class, 'destroy'])
        ->middleware('permiso:tramites.eliminar');

    Route::get('/tramites', [TramiteController::class, 'index']);
    Route::post('/tramites', [TramiteController::class, 'store'])
        ->middleware('permiso:tramites.crear');
    Route::get('/tramites/{id}', [TramiteController::class, 'show']);
    Route::put('/tramites/{id}', [TramiteController::class, 'update'])
        ->middleware('permiso:tramites.editar');
    Route::delete('/tramites/{id}', [TramiteController::class, 'destroy'])
        ->middleware('permiso:tramites.eliminar');

    Route::get('/tramites/{tramiteId}/requisitos', [RequisitoController::class, 'index']);
    Route::post('/requisitos-tramite', [RequisitoController::class, 'store'])
        ->middleware('permiso:tramites.crear');
    Route::get('/requisitos-tramite/{id}', [RequisitoController::class, 'show']);
    Route::put('/requisitos-tramite/{id}', [RequisitoController::class, 'update'])
        ->middleware('permiso:tramites.editar');
    Route::delete('/requisitos-tramite/{id}', [RequisitoController::class, 'destroy'])
        ->middleware('permiso:tramites.eliminar');

    Route::get('/tramites/{tramiteId}/formularios', [FormularioController::class, 'index']);
    Route::get('/formularios-tramite', [\App\Http\Controllers\Api\FormularioTramitePortalController::class, 'index']);
    Route::get('/formularios-tramite/{id}', [\App\Http\Controllers\Api\FormularioTramitePortalController::class, 'show']);
    Route::post('/formularios-tramite', [\App\Http\Controllers\Api\FormularioTramitePortalController::class, 'store'])
        ->middleware('permiso:tramites.crear');
    Route::put('/formularios-tramite/{id}', [\App\Http\Controllers\Api\FormularioTramitePortalController::class, 'update'])
        ->middleware('permiso:tramites.editar');
    Route::delete('/formularios-tramite/{id}', [\App\Http\Controllers\Api\FormularioTramitePortalController::class, 'destroy'])
        ->middleware('permiso:tramites.eliminar');

    Route::get('/tipos-documento-transparencia', [TipoDocumentoTransparenciaController::class, 'index']);
    Route::post('/tipos-documento-transparencia', [TipoDocumentoTransparenciaController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/tipos-documento-transparencia/{id}', [TipoDocumentoTransparenciaController::class, 'show']);
    Route::put('/tipos-documento-transparencia/{id}', [TipoDocumentoTransparenciaController::class, 'update'])
        ->middleware('permiso:transparencia.editar');
    Route::delete('/tipos-documento-transparencia/{id}', [TipoDocumentoTransparenciaController::class, 'destroy'])
        ->middleware('permiso:transparencia.eliminar');

    Route::get('/documentos-transparencia', [DocumentoController::class, 'index']);
    Route::post('/documentos-transparencia', [DocumentoController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/documentos-transparencia/{id}', [DocumentoController::class, 'show']);
    Route::put('/documentos-transparencia/{id}', [DocumentoController::class, 'update'])
        ->middleware('permiso:transparencia.editar');
    Route::delete('/documentos-transparencia/{id}', [DocumentoController::class, 'destroy'])
        ->middleware('permiso:transparencia.eliminar');

    Route::get('/tipos-evento', [TipoEventoController::class, 'index']);
    Route::post('/tipos-evento', [TipoEventoController::class, 'store'])
        ->middleware('permiso:eventos.crear');
    Route::get('/tipos-evento/{id}', [TipoEventoController::class, 'show']);
    Route::put('/tipos-evento/{id}', [TipoEventoController::class, 'update'])
        ->middleware('permiso:eventos.editar');
    Route::delete('/tipos-evento/{id}', [TipoEventoController::class, 'destroy'])
        ->middleware('permiso:eventos.eliminar');

    Route::get('/eventos', [EventoController::class, 'index']);
    Route::post('/eventos', [EventoController::class, 'store'])
        ->middleware('permiso:eventos.crear');
    Route::get('/eventos/{id}', [EventoController::class, 'show']);
    Route::put('/eventos/{id}', [EventoController::class, 'update'])
        ->middleware('permiso:eventos.editar');
    Route::delete('/eventos/{id}', [EventoController::class, 'destroy'])
        ->middleware('permiso:eventos.eliminar');

    Route::get('/eventos/{eventoId}/fotos', [EventoFotoController::class, 'index']);
    Route::post('/eventos-fotos', [EventoFotoController::class, 'store'])
        ->middleware('permiso:eventos.crear');
    Route::get('/eventos-fotos/{id}', [EventoFotoController::class, 'show']);
    Route::put('/eventos-fotos/{id}', [EventoFotoController::class, 'update'])
        ->middleware('permiso:eventos.editar');
    Route::delete('/eventos-fotos/{id}', [EventoFotoController::class, 'destroy'])
        ->middleware('permiso:eventos.eliminar');

    Route::get('/sugerencias-reclamos', [SugerenciaReclamoController::class, 'index'])
        ->middleware('permiso:sugerencias.ver');
    Route::post('/sugerencias-reclamos', [SugerenciaReclamoController::class, 'store']); // Público?
    Route::get('/sugerencias-reclamos/{id}', [SugerenciaReclamoController::class, 'show'])
        ->middleware('permiso:sugerencias.ver');
    Route::post('/sugerencias-reclamos/{id}/responder', [SugerenciaReclamoController::class, 'respond'])
        ->middleware('permiso:sugerencias.editar');
    Route::delete('/sugerencias-reclamos/{id}', [SugerenciaReclamoController::class, 'destroy'])
        ->middleware('permiso:sugerencias.eliminar');

    Route::get('/preguntas-frecuentes', [\App\Http\Controllers\Api\PreguntaFrecuenteController::class, 'index'])
        ->middleware('permiso:contenido.ver');
    Route::post('/preguntas-frecuentes', [\App\Http\Controllers\Api\PreguntaFrecuenteController::class, 'store'])
        ->middleware('permiso:contenido.crear');
    Route::get('/preguntas-frecuentes/{id}', [\App\Http\Controllers\Api\PreguntaFrecuenteController::class, 'show'])
        ->middleware('permiso:contenido.ver');
    Route::put('/preguntas-frecuentes/{id}', [\App\Http\Controllers\Api\PreguntaFrecuenteController::class, 'update'])
        ->middleware('permiso:contenido.editar');
    Route::delete('/preguntas-frecuentes/{id}', [\App\Http\Controllers\Api\PreguntaFrecuenteController::class, 'destroy'])
        ->middleware('permiso:contenido.eliminar');

    Route::get('/mensajes-contacto', [MensajeContactoController::class, 'index'])
        ->middleware('permiso:contacto.ver');
    Route::post('/mensajes-contacto', [MensajeContactoController::class, 'store']); // Público
    Route::get('/mensajes-contacto/{id}', [MensajeContactoController::class, 'show'])
        ->middleware('permiso:contacto.ver');
    Route::post('/mensajes-contacto/{id}/responder', [MensajeContactoController::class, 'respond'])
        ->middleware('permiso:contacto.editar');
    Route::delete('/mensajes-contacto/{id}', [MensajeContactoController::class, 'destroy'])
        ->middleware('permiso:contacto.eliminar');

    Route::get('/contactos-municipales', [ContactoMunicipalController::class, 'index']);
    Route::post('/contactos-municipales', [ContactoMunicipalController::class, 'store'])
        ->middleware('permiso:configuracion.editar');
    Route::get('/contactos-municipales/{id}', [ContactoMunicipalController::class, 'show']);
    Route::put('/contactos-municipales/{id}', [ContactoMunicipalController::class, 'update'])
        ->middleware('permiso:configuracion.editar');
    Route::delete('/contactos-municipales/{id}', [ContactoMunicipalController::class, 'destroy'])
        ->middleware('permiso:configuracion.eliminar');

    Route::get('/ajustes', [AjusteController::class, 'index']);
    Route::get('/ajustes/{key}', [AjusteController::class, 'show']);
    Route::put('/ajustes/{key}', [AjusteController::class, 'update'])
        ->middleware('permiso:configuracion.editar');

    Route::get('/banners-portal', [BannerPortalController::class, 'index']);
    Route::post('/banners-portal', [BannerPortalController::class, 'store'])
        ->middleware('permiso:configuracion.editar');
    Route::get('/banners-portal/{id}', [BannerPortalController::class, 'show']);
    Route::put('/banners-portal/{id}', [BannerPortalController::class, 'update'])
        ->middleware('permiso:configuracion.editar');
    Route::delete('/banners-portal/{id}', [BannerPortalController::class, 'destroy'])
        ->middleware('permiso:configuracion.eliminar');

    Route::get('/whatsapp/conversaciones', [WhatsAppAdminController::class, 'conversaciones']);
    Route::get('/whatsapp/conversaciones/{id}/mensajes', [WhatsAppAdminController::class, 'mensajes']);
    Route::post('/whatsapp/conversaciones/{id}/etiquetas', [WhatsAppAdminController::class, 'asignarEtiquetas']);
    Route::get('/whatsapp/phones', [WhatsAppAdminController::class, 'todosPhones']);
    Route::post('/whatsapp/conversaciones/{id}/atendido', [WhatsAppAdminController::class, 'marcarAtendido']);
    Route::post('/whatsapp/enviar', [WhatsAppAdminController::class, 'enviar']);
    Route::post('/whatsapp/enviar-masivo', [WhatsAppAdminController::class, 'enviarMasivo']);
    Route::post('/whatsapp/enviar-media', [WhatsAppAdminController::class, 'enviarMedia']);
    Route::post('/whatsapp/plantilla', [WhatsAppAdminController::class, 'enviarPlantilla']);

    Route::get('/whatsapp/etiquetas', [WhatsAppAdminController::class, 'etiquetas']);
    Route::post('/whatsapp/etiquetas', [WhatsAppAdminController::class, 'crearEtiqueta']);
    Route::put('/whatsapp/etiquetas/{id}', [WhatsAppAdminController::class, 'actualizarEtiqueta']);
    Route::delete('/whatsapp/etiquetas/{id}', [WhatsAppAdminController::class, 'eliminarEtiqueta']);

    Route::get('/tramite-solicitudes', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'index']);
    Route::get('/tramite-solicitudes/{id}', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'show']);
    Route::post('/tramite-solicitudes/{id}/avanzar', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'avanzar']);
    Route::post('/tramite-solicitudes/{id}/cancelar', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'cancelar']);

    Route::get('/tramites/{tramiteId}/etapas', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'etapasPorTramite']);
    Route::post('/tramite-etapas', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'storeEtapa'])
        ->middleware('permiso:tramites.editar');
    Route::put('/tramite-etapas/{id}', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'updateEtapa'])
        ->middleware('permiso:tramites.editar');
    Route::delete('/tramite-etapas/{id}', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'destroyEtapa'])
        ->middleware('permiso:tramites.eliminar');

    Route::apiResource('unidades-responsables', \App\Http\Controllers\Api\UnidadResponsableController::class);
    Route::apiResource('autoridades', \App\Http\Controllers\Api\AutoridadController::class);

    Route::get('/organigrama/latest', [\App\Http\Controllers\Api\OrganigramaController::class, 'latest']);
    Route::apiResource('organigramas', \App\Http\Controllers\Api\OrganigramaController::class);

    Route::apiResource('nomina-personal', \App\Http\Controllers\Api\NominaPersonalController::class)
        ->middleware('permiso:transparencia.ver');
    Route::get('/escala-salarial', [\App\Http\Controllers\Api\EscalaSalarialPortalController::class, 'index']);
    Route::get('/escala-salarial/{id}', [\App\Http\Controllers\Api\EscalaSalarialPortalController::class, 'show']);
    Route::post('/escala-salarial', [\App\Http\Controllers\Api\EscalaSalarialPortalController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::put('/escala-salarial/{id}', [\App\Http\Controllers\Api\EscalaSalarialPortalController::class, 'update'])
        ->middleware('permiso:transparencia.crear');
    Route::delete('/escala-salarial/{id}', [\App\Http\Controllers\Api\EscalaSalarialPortalController::class, 'destroy'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/poa', [\App\Http\Controllers\Api\POAController::class, 'index']);
    Route::post('/poa', [\App\Http\Controllers\Api\POAController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/poa/{poaId}/programas', [\App\Http\Controllers\Api\POAController::class, 'indexProgramas']);
    Route::post('/programas-poa', [\App\Http\Controllers\Api\POAController::class, 'storePrograma'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/presupuestos', [\App\Http\Controllers\Api\PresupuestoController::class, 'index']);
    Route::post('/presupuestos', [\App\Http\Controllers\Api\PresupuestoController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/presupuestos/{presupuestoId}/partidas', [\App\Http\Controllers\Api\PresupuestoController::class, 'indexPartidas']);
    Route::post('/partidas-presupuestarias', [\App\Http\Controllers\Api\PresupuestoController::class, 'storePartida'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/presupuestos/{presupuestoId}/ejecuciones', [\App\Http\Controllers\Api\PresupuestoController::class, 'indexEjecuciones']);

    Route::get('/ejecucion-presupuestaria', [\App\Http\Controllers\Api\EjecucionPresupuestariaPortalController::class, 'index']);
    Route::post('/ejecucion-presupuestaria', [\App\Http\Controllers\Api\EjecucionPresupuestariaPortalController::class, 'store']);
    Route::get('/ejecucion-presupuestaria/{id}', [\App\Http\Controllers\Api\EjecucionPresupuestariaPortalController::class, 'show']);
    Route::put('/ejecucion-presupuestaria/{id}', [\App\Http\Controllers\Api\EjecucionPresupuestariaPortalController::class, 'update']);
    Route::delete('/ejecucion-presupuestaria/{id}', [\App\Http\Controllers\Api\EjecucionPresupuestariaPortalController::class, 'destroy']);

    Route::get('/tipos-norma', [\App\Http\Controllers\Api\TipoNormaController::class, 'index']);
    Route::post('/tipos-norma', [\App\Http\Controllers\Api\TipoNormaController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::put('/tipos-norma/{id}', [\App\Http\Controllers\Api\TipoNormaController::class, 'update'])
        ->middleware('permiso:transparencia.editar');
    Route::delete('/tipos-norma/{id}', [\App\Http\Controllers\Api\TipoNormaController::class, 'destroy'])
        ->middleware('permiso:transparencia.eliminar');

    Route::get('/normas', [\App\Http\Controllers\Api\NormaController::class, 'index']);
    Route::post('/normas', [\App\Http\Controllers\Api\NormaController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::put('/normas/{id}', [\App\Http\Controllers\Api\NormaController::class, 'update'])
        ->middleware('permiso:transparencia.editar');
    Route::delete('/normas/{id}', [\App\Http\Controllers\Api\NormaController::class, 'destroy'])
        ->middleware('permiso:transparencia.eliminar');

    Route::get('/tipos-auditoria', [\App\Http\Controllers\Api\AuditoriaController::class, 'indexTipos']);
    Route::get('/auditorias', [\App\Http\Controllers\Api\AuditoriaController::class, 'index']);
    Route::post('/auditorias', [\App\Http\Controllers\Api\AuditoriaController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/auditorias/{auditoriaId}/hallazgos', [\App\Http\Controllers\Api\AuditoriaController::class, 'indexHallazgos']);
    Route::post('/hallazgos-auditoria', [\App\Http\Controllers\Api\AuditoriaController::class, 'storeHallazgo'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/manuales-institucionales', [\App\Http\Controllers\Api\ManualInstitucionalController::class, 'index']);
    Route::post('/manuales-institucionales', [\App\Http\Controllers\Api\ManualInstitucionalController::class, 'store'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/pei', [\App\Http\Controllers\Api\PEIController::class, 'index']);
    Route::post('/pei', [\App\Http\Controllers\Api\PEIController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/pei/{peiId}/ejes', [\App\Http\Controllers\Api\PEIController::class, 'indexEjes']);
    Route::get('/ejes-pei', [\App\Http\Controllers\Api\EjesPeiPortalController::class, 'index']);
    Route::get('/ejes-pei/{id}', [\App\Http\Controllers\Api\EjesPeiPortalController::class, 'show']);
    Route::post('/ejes-pei', [\App\Http\Controllers\Api\EjesPeiPortalController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::put('/ejes-pei/{id}', [\App\Http\Controllers\Api\EjesPeiPortalController::class, 'update'])
        ->middleware('permiso:transparencia.crear');
    Route::delete('/ejes-pei/{id}', [\App\Http\Controllers\Api\EjesPeiPortalController::class, 'destroy'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/planes-gobierno', [\App\Http\Controllers\Api\PlanGobiernoController::class, 'index']);
    Route::post('/planes-gobierno', [\App\Http\Controllers\Api\PlanGobiernoController::class, 'store'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/categorias-indicador', [\App\Http\Controllers\Api\IndicadorController::class, 'indexCategorias']);
    Route::get('/indicadores', [\App\Http\Controllers\Api\IndicadorController::class, 'index']);
    Route::post('/indicadores', [\App\Http\Controllers\Api\IndicadorController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/indicadores/{indicadorId}/valores', [\App\Http\Controllers\Api\IndicadorController::class, 'indexValores']);
    Route::post('/valores-indicador', [\App\Http\Controllers\Api\IndicadorController::class, 'storeValor'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/estados-proyecto', [\App\Http\Controllers\Api\EstadoProyectoPortalController::class, 'index']);
    Route::get('/estados-proyecto/{id}', [\App\Http\Controllers\Api\EstadoProyectoPortalController::class, 'show']);
    Route::post('/estados-proyecto', [\App\Http\Controllers\Api\EstadoProyectoPortalController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::put('/estados-proyecto/{id}', [\App\Http\Controllers\Api\EstadoProyectoPortalController::class, 'update'])
        ->middleware('permiso:transparencia.crear');
    Route::delete('/estados-proyecto/{id}', [\App\Http\Controllers\Api\EstadoProyectoPortalController::class, 'destroy'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/proyectos', [\App\Http\Controllers\Api\ProyectoController::class, 'index']);
    Route::post('/proyectos', [\App\Http\Controllers\Api\ProyectoController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/proyectos/{proyectoId}/avances', [\App\Http\Controllers\Api\ProyectoController::class, 'indexAvances']);
    Route::post('/avances-proyecto', [\App\Http\Controllers\Api\ProyectoController::class, 'storeAvance'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/items', [\App\Http\Controllers\Api\ItemController::class, 'index']);
    Route::post('/items', [\App\Http\Controllers\Api\ItemController::class, 'store']);
    Route::get('/items/{id}', [\App\Http\Controllers\Api\ItemController::class, 'show']);
    Route::put('/items/{id}', [\App\Http\Controllers\Api\ItemController::class, 'update']);
    Route::delete('/items/{id}', [\App\Http\Controllers\Api\ItemController::class, 'destroy']);

    Route::get('/indicadores-gestion', [\App\Http\Controllers\Api\IndicadorGestionController::class, 'index']);
    Route::post('/indicadores-gestion', [\App\Http\Controllers\Api\IndicadorGestionController::class, 'store']);
    Route::get('/indicadores-gestion/{id}', [\App\Http\Controllers\Api\IndicadorGestionController::class, 'show']);
    Route::put('/indicadores-gestion/{id}', [\App\Http\Controllers\Api\IndicadorGestionController::class, 'update']);
    Route::delete('/indicadores-gestion/{id}', [\App\Http\Controllers\Api\IndicadorGestionController::class, 'destroy']);

    Route::get('/historia-municipio', [\App\Http\Controllers\Api\HistoriaMunicipioController::class, 'index']);
    Route::post('/historia-municipio', [\App\Http\Controllers\Api\HistoriaMunicipioController::class, 'store']);
    Route::get('/historia-municipio/{id}', [\App\Http\Controllers\Api\HistoriaMunicipioController::class, 'show']);
    Route::put('/historia-municipio/{id}', [\App\Http\Controllers\Api\HistoriaMunicipioController::class, 'update']);
    Route::delete('/historia-municipio/{id}', [\App\Http\Controllers\Api\HistoriaMunicipioController::class, 'destroy']);

    Route::get('/comunicados', [\App\Http\Controllers\Api\ComunicadoController::class, 'index']);
    Route::post('/comunicados', [\App\Http\Controllers\Api\ComunicadoController::class, 'store']);
    Route::get('/comunicados/{id}', [\App\Http\Controllers\Api\ComunicadoController::class, 'show']);
    Route::put('/comunicados/{id}', [\App\Http\Controllers\Api\ComunicadoController::class, 'update']);
    Route::delete('/comunicados/{id}', [\App\Http\Controllers\Api\ComunicadoController::class, 'destroy']);

    Route::get('/directorio-institucional', [\App\Http\Controllers\Api\DirectorioInstitucionalController::class, 'index']);
    Route::post('/directorio-institucional', [\App\Http\Controllers\Api\DirectorioInstitucionalController::class, 'store']);
    Route::get('/directorio-institucional/{id}', [\App\Http\Controllers\Api\DirectorioInstitucionalController::class, 'show']);
    Route::put('/directorio-institucional/{id}', [\App\Http\Controllers\Api\DirectorioInstitucionalController::class, 'update']);
    Route::delete('/directorio-institucional/{id}', [\App\Http\Controllers\Api\DirectorioInstitucionalController::class, 'destroy']);

    Route::get('/consultas-ciudadanas', [\App\Http\Controllers\Api\ConsultaCiudadanaController::class, 'index']);
    Route::post('/consultas-ciudadanas', [\App\Http\Controllers\Api\ConsultaCiudadanaController::class, 'store']);
    Route::get('/consultas-ciudadanas/{id}', [\App\Http\Controllers\Api\ConsultaCiudadanaController::class, 'show']);
    Route::put('/consultas-ciudadanas/{id}/responder', [\App\Http\Controllers\Api\ConsultaCiudadanaController::class, 'responder']);
    Route::delete('/consultas-ciudadanas/{id}', [\App\Http\Controllers\Api\ConsultaCiudadanaController::class, 'destroy']);

    Route::get('/audiencias-publicas', [\App\Http\Controllers\Api\AudienciaPublicaController::class, 'index']);
    Route::post('/audiencias-publicas', [\App\Http\Controllers\Api\AudienciaPublicaController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::get('/audiencias-publicas/{id}', [\App\Http\Controllers\Api\AudienciaPublicaController::class, 'show']);
    Route::put('/audiencias-publicas/{id}', [\App\Http\Controllers\Api\AudienciaPublicaController::class, 'update'])
        ->middleware('permiso:transparencia.crear');
    Route::delete('/audiencias-publicas/{id}', [\App\Http\Controllers\Api\AudienciaPublicaController::class, 'destroy'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/config-sitio', [\App\Http\Controllers\Api\ConfigSitioController::class, 'show']);
    Route::put('/config-sitio', [\App\Http\Controllers\Api\ConfigSitioController::class, 'update'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/galerias', [\App\Http\Controllers\Api\GaleriaController::class, 'index']);
    Route::post('/galerias', [\App\Http\Controllers\Api\GaleriaController::class, 'store']);
    Route::get('/galerias/{id}', [\App\Http\Controllers\Api\GaleriaController::class, 'show']);
    Route::put('/galerias/{id}', [\App\Http\Controllers\Api\GaleriaController::class, 'update']);
    Route::delete('/galerias/{id}', [\App\Http\Controllers\Api\GaleriaController::class, 'destroy']);

    Route::get('/galeria-items', [\App\Http\Controllers\Api\GaleriaItemController::class, 'index']);
    Route::post('/galeria-items', [\App\Http\Controllers\Api\GaleriaItemController::class, 'store']);
    Route::get('/galeria-items/{id}', [\App\Http\Controllers\Api\GaleriaItemController::class, 'show']);
    Route::put('/galeria-items/{id}', [\App\Http\Controllers\Api\GaleriaItemController::class, 'update']);
    Route::delete('/galeria-items/{id}', [\App\Http\Controllers\Api\GaleriaItemController::class, 'destroy']);

    Route::get('/menus', [\App\Http\Controllers\Api\MenuController::class, 'index']);
    Route::post('/menus', [\App\Http\Controllers\Api\MenuController::class, 'store']);
    Route::get('/menus/{id}', [\App\Http\Controllers\Api\MenuController::class, 'show']);
    Route::put('/menus/{id}', [\App\Http\Controllers\Api\MenuController::class, 'update']);
    Route::delete('/menus/{id}', [\App\Http\Controllers\Api\MenuController::class, 'destroy']);

    Route::get('/menu-items', [\App\Http\Controllers\Api\MenuItemController::class, 'index']);
    Route::post('/menu-items', [\App\Http\Controllers\Api\MenuItemController::class, 'store']);
    Route::get('/menu-items/{id}', [\App\Http\Controllers\Api\MenuItemController::class, 'show']);
    Route::put('/menu-items/{id}', [\App\Http\Controllers\Api\MenuItemController::class, 'update']);
    Route::delete('/menu-items/{id}', [\App\Http\Controllers\Api\MenuItemController::class, 'destroy']);

    Route::get('/himnos', [\App\Http\Controllers\Api\HimnoController::class, 'index']);
    Route::get('/himnos/{id}', [\App\Http\Controllers\Api\HimnoController::class, 'show']);
    Route::post('/himnos', [\App\Http\Controllers\Api\HimnoController::class, 'store'])
        ->middleware('permiso:transparencia.crear');
    Route::put('/himnos/{id}', [\App\Http\Controllers\Api\HimnoController::class, 'update'])
        ->middleware('permiso:transparencia.crear');
    Route::delete('/himnos/{id}', [\App\Http\Controllers\Api\HimnoController::class, 'destroy'])
        ->middleware('permiso:transparencia.crear');

    Route::get('/decretos-municipales', [\App\Http\Controllers\Api\DecretoMunicipalController::class, 'index']);
    Route::post('/decretos-municipales', [\App\Http\Controllers\Api\DecretoMunicipalController::class, 'store'])
        ->middleware('permiso:decretos.crear');
    Route::get('/decretos-municipales/{id}', [\App\Http\Controllers\Api\DecretoMunicipalController::class, 'show']);
    Route::put('/decretos-municipales/{id}', [\App\Http\Controllers\Api\DecretoMunicipalController::class, 'update'])
        ->middleware('permiso:decretos.editar');
    Route::delete('/decretos-municipales/{id}', [\App\Http\Controllers\Api\DecretoMunicipalController::class, 'destroy'])
        ->middleware('permiso:decretos.eliminar');

    Route::get('/informes-auditoria', [\App\Http\Controllers\Api\InformeAuditoriaController::class, 'index']);
    Route::post('/informes-auditoria', [\App\Http\Controllers\Api\InformeAuditoriaController::class, 'store'])
        ->middleware('permiso:informes-auditoria.crear');
    Route::get('/informes-auditoria/{id}', [\App\Http\Controllers\Api\InformeAuditoriaController::class, 'show']);
    Route::put('/informes-auditoria/{id}', [\App\Http\Controllers\Api\InformeAuditoriaController::class, 'update'])
        ->middleware('permiso:informes-auditoria.editar');
    Route::delete('/informes-auditoria/{id}', [\App\Http\Controllers\Api\InformeAuditoriaController::class, 'destroy'])
        ->middleware('permiso:informes-auditoria.eliminar');
});

Route::prefix('portal')->middleware(['portal.key', 'solo.activos', 'rate.portal:60,60', 'encrypt.portal'])->group(function () {

    Route::get('/banners', [BannerPortalController::class, 'index']);
    Route::get('/banners/{id}', [BannerPortalController::class, 'show']);

    Route::get('/noticias', [\App\Http\Controllers\Api\NoticiaController::class, 'index']);
    Route::get('/noticias/{id}', [\App\Http\Controllers\Api\NoticiaController::class, 'show']);
    Route::get('/noticias/slug/{slug}', [\App\Http\Controllers\Api\NoticiaController::class, 'showBySlug']);

    Route::get('/eventos', [\App\Http\Controllers\Api\EventoController::class, 'index']);
    Route::get('/eventos/{id}', [\App\Http\Controllers\Api\EventoController::class, 'show']);
    Route::get('/eventos/{eventoId}/fotos', [\App\Http\Controllers\Api\EventoFotoController::class, 'index']);

    Route::get('/comunicados', [\App\Http\Controllers\Api\ComunicadoController::class, 'index']);
    Route::get('/comunicados/slug/{slug}', [\App\Http\Controllers\Api\ComunicadoController::class, 'showBySlug']);
    Route::get('/comunicados/{id}', [\App\Http\Controllers\Api\ComunicadoController::class, 'show']);

    Route::get('/secretarias', [\App\Http\Controllers\Api\SecretariaController::class, 'index']);
    Route::get('/secretarias/{id}', [\App\Http\Controllers\Api\SecretariaController::class, 'show']);

    Route::get('/subsenefcos', [\App\Http\Controllers\Api\SubsenefcoController::class, 'index']);
    Route::get('/subsenefcos/{id}', [\App\Http\Controllers\Api\SubsenefcoController::class, 'show']);

    Route::get('/autoridades', [\App\Http\Controllers\Api\AutoridadController::class, 'index']);
    Route::get('/autoridades/{id}', [\App\Http\Controllers\Api\AutoridadController::class, 'show']);
    Route::get('/autoridades/tipo/{tipo}', [\App\Http\Controllers\Api\AutoridadController::class, 'porTipo']);

    Route::get('/tramites', [\App\Http\Controllers\Api\TramiteController::class, 'index']);
    Route::get('/tramites/{id}', [\App\Http\Controllers\Api\TramiteController::class, 'show']);
    Route::get('/tramites/{id}/etapas', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'etapasPorTramite']);

    Route::post('/tramite-solicitudes', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'storeSolicitudPortal']);
    Route::get('/tramite-seguimiento/{numero}', [\App\Http\Controllers\Api\TramiteSolicitudController::class, 'consultarSeguimiento']);

    Route::get('/normas', [\App\Http\Controllers\Api\NormaController::class, 'index']);

    Route::get('/documentos-transparencia', [\App\Http\Controllers\Api\DocumentoController::class, 'index']);
    Route::get('/documentos-transparencia/{id}', [\App\Http\Controllers\Api\DocumentoController::class, 'show']);

    Route::get('/audiencias-publicas', [\App\Http\Controllers\Api\AudienciaPublicaController::class, 'index']);
    Route::get('/audiencias-publicas/{id}', [\App\Http\Controllers\Api\AudienciaPublicaController::class, 'show']);

    Route::get('/auditorias', [\App\Http\Controllers\Api\AuditoriaController::class, 'index']);
    Route::get('/auditorias/slug/{slug}', [\App\Http\Controllers\Api\AuditoriaController::class, 'showBySlug']);

    Route::get('/nomina-personal', [\App\Http\Controllers\Api\NominaPersonalController::class, 'index']);

    Route::get('/ejes-pei', [\App\Http\Controllers\Api\EjesPeiPortalController::class, 'index']);
    Route::get('/ejes-pei/{id}', [\App\Http\Controllers\Api\EjesPeiPortalController::class, 'show']);

    Route::get('/categorias-noticia', [\App\Http\Controllers\Api\CategoriaNoticiaController::class, 'index']);
    Route::get('/tipos-evento', [\App\Http\Controllers\Api\TipoEventoController::class, 'index']);
    Route::get('/tipos-tramite', [\App\Http\Controllers\Api\TipoTramiteController::class, 'index']);

    Route::get('/menus/{nombre}/items', [\App\Http\Controllers\Api\MenuController::class, 'itemsByNombre']);

    Route::get('/redes-sociales', [RedSocialController::class, 'index']);

    Route::get('/configuracion', [\App\Http\Controllers\Api\ConfiguracionSitioController::class, 'publica']);

    Route::post('/mensajes-contacto', [MensajeContactoController::class, 'store']);

    Route::get('/preguntas-frecuentes', [\App\Http\Controllers\Api\PreguntaFrecuenteController::class, 'index']);

    Route::get('/galerias', [\App\Http\Controllers\Api\GaleriaController::class, 'index']);
    Route::get('/galerias/{id}', [\App\Http\Controllers\Api\GaleriaController::class, 'show']);
    Route::get('/galeria-items', [\App\Http\Controllers\Api\GaleriaItemController::class, 'index']);

    Route::get('/proyectos', [\App\Http\Controllers\Api\ProyectoController::class, 'index']);

    Route::get('/estados-proyecto', [\App\Http\Controllers\Api\EstadoProyectoPortalController::class, 'index']);
    Route::get('/estados-proyecto/{id}', [\App\Http\Controllers\Api\EstadoProyectoPortalController::class, 'show']);

    Route::get('/formularios-tramite', [\App\Http\Controllers\Api\FormularioTramitePortalController::class, 'index']);
    Route::get('/formularios-tramite/{id}', [\App\Http\Controllers\Api\FormularioTramitePortalController::class, 'show']);

    Route::get('/decretos-municipales', [\App\Http\Controllers\Api\DecretoMunicipalController::class, 'index']);
    Route::get('/decretos-municipales/{id}', [\App\Http\Controllers\Api\DecretoMunicipalController::class, 'show']);

    Route::get('/informes-auditoria', [\App\Http\Controllers\Api\InformeAuditoriaController::class, 'index']);
    Route::get('/informes-auditoria/{id}', [\App\Http\Controllers\Api\InformeAuditoriaController::class, 'show']);
});
