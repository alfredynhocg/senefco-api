<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesPermisosSeeder::class,
            TiposEventoSeeder::class,
            TiposNormaSeeder::class,
            TiposTramiteSeeder::class,
            TiposAuditoriaSeeder::class,
            TiposDocumentoTransparenciaSeeder::class,
            CategoriaNoticiaSeeder::class,
            CategoriaIndicadorSeeder::class,
        ]);

        $this->call([
            AdminSeeder::class,
        ]);

        $this->call([
            SecretariasSeeder::class,
            SubsenefcosSeeder::class,
            UnidadesResponsablesSeeder::class,
            AutoridadesSeeder::class,
            OrganigramaSeeder::class,
            TramitesSeeder::class,
            TramitesConSeguimientoSeeder::class,
            FormulariosTramiteSeeder::class,
            EventosSeeder::class,
            TransparenciaSeeder::class,
        ]);

        $this->call([
            PlanesGobiernoSeeder::class,
            EstadosProyectoSeeder::class,
            PresupuestosSeeder::class,
            POASeeder::class,
            NominaPersonalSeeder::class,
            NormasSeeder::class,
            AuditoriasSeeder::class,
            IndicadoresGestionSeeder::class,
            IndicadoresGestionPortalSeeder::class,
            ValoresIndicadorSeeder::class,
            ConsultasCiudadanasSeeder::class,
            ProyectosSeeder::class,
            SugerenciasSeeder::class,
        ]);

        $this->call([
            ComunicadosSeeder::class,
            EtiquetasSeeder::class,
            NoticiasSeeder::class,
            DecretosMunicipalesSeeder::class,
            InformesAuditoriaSeeder::class,
        ]);

        $this->call([
            ConfiguracionSitioSeeder::class,
            RedesSocialesSeeder::class,
            MenusSeeder::class,
            BannersSeeder::class,
            GaleriasSeeder::class,
            PreguntasFrecuentesSeeder::class,
            HimnosSeeder::class,
            HistoriaMunicipioSeeder::class,
        ]);
    }
}
