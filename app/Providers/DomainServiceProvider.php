<?php

namespace App\Providers;

use App\Domain\Ajustes\Contracts\AjusteRepositoryInterface;
use App\Domain\BannersPortal\Contracts\BannerPortalRepositoryInterface;
use App\Domain\CategoriasNoticia\Contracts\CategoriaNoticiaRepositoryInterface;
use App\Domain\ContactosMunicipales\Contracts\ContactoMunicipalRepositoryInterface;
use App\Domain\DocumentosTransparencia\Contracts\DocumentoRepositoryInterface;
use App\Domain\Etiquetas\Contracts\EtiquetaRepositoryInterface;
use App\Domain\Eventos\Contracts\EventoRepositoryInterface;
use App\Domain\EventosFotos\Contracts\EventoFotoRepositoryInterface;
use App\Domain\FormulariosTramite\Contracts\FormularioRepositoryInterface;
use App\Domain\MensajesContacto\Contracts\MensajeContactoRepositoryInterface;
use App\Domain\Noticias\Contracts\NoticiaRepositoryInterface;
use App\Domain\PreguntasFrecuentes\Contracts\PreguntaFrecuenteRepositoryInterface;
use App\Domain\RedesSociales\Contracts\RedSocialRepositoryInterface;
use App\Domain\RequisitosTramite\Contracts\RequisitoRepositoryInterface;
use App\Domain\Secretarias\Contracts\SecretariaRepositoryInterface;
use App\Domain\Subsenefcos\Contracts\SubsenefcoRepositoryInterface;
use App\Domain\SugerenciasReclamos\Contracts\SugerenciaReclamoRepositoryInterface;
use App\Domain\TiposDocumentoTransparencia\Contracts\TipoDocumentoTransparenciaRepositoryInterface;
use App\Domain\TiposEvento\Contracts\TipoEventoRepositoryInterface;
use App\Domain\TiposTramite\Contracts\TipoTramiteRepositoryInterface;
use App\Domain\TramitesCatalogo\Contracts\TramiteRepositoryInterface;
use App\Infrastructure\Ajustes\Repositories\EloquentAjusteRepository;
use App\Infrastructure\BannersPortal\Repositories\EloquentBannerPortalRepository;
use App\Infrastructure\CategoriasNoticia\Repositories\EloquentCategoriaNoticiaRepository;
use App\Infrastructure\ContactosMunicipales\Repositories\EloquentContactoMunicipalRepository;
use App\Infrastructure\DocumentosTransparencia\Repositories\EloquentDocumentoRepository;
use App\Infrastructure\Etiquetas\Repositories\EloquentEtiquetaRepository;
use App\Infrastructure\Eventos\Repositories\EloquentEventoRepository;
use App\Infrastructure\EventosFotos\Repositories\EloquentEventoFotoRepository;
use App\Infrastructure\FormulariosTramite\Repositories\EloquentFormularioRepository;
use App\Infrastructure\MensajesContacto\Repositories\EloquentMensajeContactoRepository;
use App\Infrastructure\Noticias\Repositories\EloquentNoticiaRepository;
use App\Infrastructure\PreguntasFrecuentes\Repositories\EloquentPreguntaFrecuenteRepository;
use App\Infrastructure\RedesSociales\Repositories\EloquentRedSocialRepository;
use App\Infrastructure\RequisitosTramite\Repositories\EloquentRequisitoRepository;
use App\Infrastructure\Secretarias\Repositories\EloquentSecretariaRepository;
use App\Infrastructure\Subsenefcos\Repositories\EloquentSubsenefcoRepository;
use App\Infrastructure\SugerenciasReclamos\Repositories\EloquentSugerenciaReclamoRepository;
use App\Infrastructure\TiposDocumentoTransparencia\Repositories\EloquentTipoDocumentoTransparenciaRepository;
use App\Infrastructure\TiposEvento\Repositories\EloquentTipoEventoRepository;
use App\Infrastructure\TiposTramite\Repositories\EloquentTipoTramiteRepository;
use App\Infrastructure\TramitesCatalogo\Repositories\EloquentTramiteRepository;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RedSocialRepositoryInterface::class, EloquentRedSocialRepository::class);
        $this->app->bind(CategoriaNoticiaRepositoryInterface::class, EloquentCategoriaNoticiaRepository::class);
        $this->app->bind(EtiquetaRepositoryInterface::class, EloquentEtiquetaRepository::class);
        $this->app->bind(NoticiaRepositoryInterface::class, EloquentNoticiaRepository::class);
        $this->app->bind(SecretariaRepositoryInterface::class, EloquentSecretariaRepository::class);
        $this->app->bind(SubsenefcoRepositoryInterface::class, EloquentSubsenefcoRepository::class);

        // Fase 2: Trámites
        $this->app->bind(TipoTramiteRepositoryInterface::class, EloquentTipoTramiteRepository::class);
        $this->app->bind(TramiteRepositoryInterface::class, EloquentTramiteRepository::class);
        $this->app->bind(RequisitoRepositoryInterface::class, EloquentRequisitoRepository::class);
        $this->app->bind(FormularioRepositoryInterface::class, EloquentFormularioRepository::class);

        // Fase 2: Transparencia
        $this->app->bind(TipoDocumentoTransparenciaRepositoryInterface::class, EloquentTipoDocumentoTransparenciaRepository::class);
        $this->app->bind(DocumentoRepositoryInterface::class, EloquentDocumentoRepository::class);

        // Fase 3: Eventos
        $this->app->bind(TipoEventoRepositoryInterface::class, EloquentTipoEventoRepository::class);
        $this->app->bind(EventoRepositoryInterface::class, EloquentEventoRepository::class);
        $this->app->bind(EventoFotoRepositoryInterface::class, EloquentEventoFotoRepository::class);

        // Fase 3: Participación
        $this->app->bind(SugerenciaReclamoRepositoryInterface::class, EloquentSugerenciaReclamoRepository::class);
        $this->app->bind(ContactoMunicipalRepositoryInterface::class, EloquentContactoMunicipalRepository::class);
        $this->app->bind(MensajeContactoRepositoryInterface::class, EloquentMensajeContactoRepository::class);
        $this->app->bind(PreguntaFrecuenteRepositoryInterface::class, EloquentPreguntaFrecuenteRepository::class);

        // Fase 3: Configuración
        $this->app->bind(AjusteRepositoryInterface::class, EloquentAjusteRepository::class);
        $this->app->bind(BannerPortalRepositoryInterface::class, EloquentBannerPortalRepository::class);

        // Fase 4: Estructura y Autoridades
        $this->app->bind(\App\Domain\UnidadesResponsables\Contracts\UnidadResponsableRepositoryInterface::class, \App\Infrastructure\UnidadesResponsables\Repositories\EloquentUnidadResponsableRepository::class);
        $this->app->bind(\App\Domain\Autoridades\Contracts\AutoridadRepositoryInterface::class, \App\Infrastructure\Autoridades\Repositories\EloquentAutoridadRepository::class);
        $this->app->bind(\App\Domain\Organigramas\Contracts\OrganigramaRepositoryInterface::class, \App\Infrastructure\Organigramas\Repositories\EloquentOrganigramaRepository::class);

        // Fase 4: Recursos Humanos
        $this->app->bind(\App\Domain\NominaPersonal\Contracts\NominaPersonalRepositoryInterface::class, \App\Infrastructure\NominaPersonal\Repositories\EloquentNominaPersonalRepository::class);
        $this->app->bind(\App\Domain\EscalaSalarial\Contracts\EscalaSalarialRepositoryInterface::class, \App\Infrastructure\EscalaSalarial\Repositories\EloquentEscalaSalarialRepository::class);

        // Fase 4: Finanzas (POA y Presupuestos)
        $this->app->bind(\App\Domain\POA\Contracts\POARepositoryInterface::class, \App\Infrastructure\POA\Repositories\EloquentPOARepository::class);
        $this->app->bind(\App\Domain\ProgramasPOA\Contracts\ProgramaPOARepositoryInterface::class, \App\Infrastructure\ProgramasPOA\Repositories\EloquentProgramaPOARepository::class);
        $this->app->bind(\App\Domain\Presupuestos\Contracts\PresupuestoRepositoryInterface::class, \App\Infrastructure\Presupuestos\Repositories\EloquentPresupuestoRepository::class);
        $this->app->bind(\App\Domain\PartidasPresupuestarias\Contracts\PartidaPresupuestariaRepositoryInterface::class, \App\Infrastructure\PartidasPresupuestarias\Repositories\EloquentPartidaPresupuestariaRepository::class);
        $this->app->bind(\App\Domain\EjecucionPresupuestaria\Contracts\EjecucionPresupuestariaRepositoryInterface::class, \App\Infrastructure\EjecucionPresupuestaria\Repositories\EloquentEjecucionPresupuestariaRepository::class);

        // Fase 5: Marco Legal (Gaceta Municipal)
        $this->app->bind(\App\Domain\TiposNorma\Contracts\TipoNormaRepositoryInterface::class, \App\Infrastructure\TiposNorma\Repositories\EloquentTipoNormaRepository::class);
        $this->app->bind(\App\Domain\Normas\Contracts\NormaRepositoryInterface::class, \App\Infrastructure\Normas\Repositories\EloquentNormaRepository::class);

        // Fase 5: Auditorías y Control
        $this->app->bind(\App\Domain\TiposAuditoria\Contracts\TipoAuditoriaRepositoryInterface::class, \App\Infrastructure\TiposAuditoria\Repositories\EloquentTipoAuditoriaRepository::class);
        $this->app->bind(\App\Domain\Auditorias\Contracts\AuditoriaRepositoryInterface::class, \App\Infrastructure\Auditorias\Repositories\EloquentAuditoriaRepository::class);
        $this->app->bind(\App\Domain\HallazgosAuditoria\Contracts\HallazgoAuditoriaRepositoryInterface::class, \App\Infrastructure\HallazgosAuditoria\Repositories\EloquentHallazgoAuditoriaRepository::class);

        // Fase 5: Manuales Institucionales
        $this->app->bind(\App\Domain\ManualesInstitucionales\Contracts\ManualInstitucionalRepositoryInterface::class, \App\Infrastructure\ManualesInstitucionales\Repositories\EloquentManualInstitucionalRepository::class);

        // Fase 6: Planificación Estratégica
        $this->app->bind(\App\Domain\PEI\Contracts\PEIRepositoryInterface::class, \App\Infrastructure\PEI\Repositories\EloquentPEIRepository::class);
        $this->app->bind(\App\Domain\EjesPEI\Contracts\EjePEIRepositoryInterface::class, \App\Infrastructure\EjesPEI\Repositories\EloquentEjePEIRepository::class);
        $this->app->bind(\App\Domain\PlanesGobierno\Contracts\PlanGobiernoRepositoryInterface::class, \App\Infrastructure\PlanesGobierno\Repositories\EloquentPlanGobiernoRepository::class);

        // Fase 6: Gestión por Indicadores
        $this->app->bind(\App\Domain\CategoriasIndicador\Contracts\CategoriaIndicadorRepositoryInterface::class, \App\Infrastructure\CategoriasIndicador\Repositories\EloquentCategoriaIndicadorRepository::class);
        $this->app->bind(\App\Domain\IndicadoresGestion\Contracts\IndicadorGestionRepositoryInterface::class, \App\Infrastructure\IndicadoresGestion\Repositories\EloquentIndicadorGestionRepository::class);
        $this->app->bind(\App\Domain\ValoresIndicador\Contracts\ValorIndicadorRepositoryInterface::class, \App\Infrastructure\ValoresIndicador\Repositories\EloquentValorIndicadorRepository::class);

        // Fase 7: Proyectos e Inversión Pública
        $this->app->bind(\App\Domain\EstadosProyecto\Contracts\EstadoProyectoRepositoryInterface::class, \App\Infrastructure\EstadosProyecto\Repositories\EloquentEstadoProyectoRepository::class);
        $this->app->bind(\App\Domain\Proyectos\Contracts\ProyectoRepositoryInterface::class, \App\Infrastructure\Proyectos\Repositories\EloquentProyectoRepository::class);
        $this->app->bind(\App\Domain\AvanceProyecto\Contracts\AvanceProyectoRepositoryInterface::class, \App\Infrastructure\AvanceProyecto\Repositories\EloquentAvanceProyectoRepository::class);

        // Audiencias Públicas
        $this->app->bind(\App\Domain\AudienciasPublicas\Contracts\AudienciaPublicaRepositoryInterface::class, \App\Infrastructure\AudienciasPublicas\Repositories\EloquentAudienciaPublicaRepository::class);

        // Usuarios y Roles
        $this->app->bind(\App\Domain\Usuarios\Contracts\UserRepositoryInterface::class, \App\Infrastructure\Usuarios\Repositories\EloquentUserRepository::class);
        $this->app->bind(\App\Domain\Usuarios\Contracts\RoleRepositoryInterface::class, \App\Infrastructure\Usuarios\Repositories\EloquentRoleRepository::class);

        // Ítems
        $this->app->bind(\App\Domain\Items\Contracts\ItemRepositoryInterface::class, \App\Infrastructure\Items\Repositories\EloquentItemRepository::class);

        // Indicadores de Gestión
        $this->app->bind(\App\Domain\IndicadoresGestion\Contracts\IndicadorGestionRepositoryInterface::class, \App\Infrastructure\IndicadoresGestion\Repositories\EloquentIndicadorGestionRepository::class);

        // Historia del Municipio
        $this->app->bind(\App\Domain\HistoriaMunicipio\Contracts\HistoriaMunicipioRepositoryInterface::class, \App\Infrastructure\HistoriaMunicipio\Repositories\EloquentHistoriaMunicipioRepository::class);

        // Comunicados
        $this->app->bind(\App\Domain\Comunicados\Contracts\ComunicadoRepositoryInterface::class, \App\Infrastructure\Comunicados\Repositories\EloquentComunicadoRepository::class);

        // Consultas Ciudadanas
        $this->app->bind(\App\Domain\ConsultasCiudadanas\Contracts\ConsultaCiudadanaRepositoryInterface::class, \App\Infrastructure\ConsultasCiudadanas\Repositories\EloquentConsultaCiudadanaRepository::class);

        // Directorio Institucional
        $this->app->bind(\App\Domain\DirectorioInstitucional\Contracts\DirectorioInstitucionalRepositoryInterface::class, \App\Infrastructure\DirectorioInstitucional\Repositories\EloquentDirectorioInstitucionalRepository::class);

        // Decretos Municipales
        $this->app->bind(\App\Domain\DecretosMunicipales\Contracts\DecretoMunicipalRepositoryInterface::class, \App\Infrastructure\DecretosMunicipales\Repositories\EloquentDecretoMunicipalRepository::class);

        // Informes de Auditoría
        $this->app->bind(\App\Domain\InformesAuditoria\Contracts\InformeAuditoriaRepositoryInterface::class, \App\Infrastructure\InformesAuditoria\Repositories\EloquentInformeAuditoriaRepository::class);
    }
}
