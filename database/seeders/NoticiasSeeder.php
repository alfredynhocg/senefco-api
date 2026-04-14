<?php

namespace Database\Seeders;

use Database\Seeders\Concerns\DisablesForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NoticiasSeeder extends Seeder
{
    use DisablesForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();
        DB::table('noticias')->truncate();
        $this->enableForeignKeys();

        $adminId = DB::table('usuarios')->where('email', 'admin@senefco.bo')->value('id') ?? 1;
        $cat = DB::table('categorias_noticia')->pluck('id', 'slug');

        $noticias = [
            [
                'categoria_id' => $cat['obras-infraestructura'],
                'titulo' => 'Inauguración del Nuevo Mercado Municipal de Achocalla',
                'entradilla' => 'El GAMA inauguró el moderno mercado municipal que beneficiará a más de 500 comerciantes y miles de familias del municipio.',
                'cuerpo' => '<p>Con una inversión de Bs. 8.200.000, el nuevo mercado cuenta con 520 puestos de venta, agua potable, alcantarillado y estacionamiento para 80 vehículos.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img1.png',
                'estado' => 'publicado',
                'destacada' => true,
                'vistas' => 342,
                'fecha_publicacion' => now()->subDays(1),
            ],
            [
                'categoria_id' => $cat['salud'],
                'titulo' => 'GAMA Implementa Programa de Salud Preventiva en Comunidades Rurales',
                'entradilla' => 'El municipio lanzó brigadas médicas, vacunación y talleres de nutrición en las 12 comunidades rurales de Achocalla.',
                'cuerpo' => '<p>Se han atendido más de 1.200 personas en el primer mes, con especial atención a niños menores de 5 años y adultos mayores.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img2.png',
                'estado' => 'publicado',
                'destacada' => true,
                'vistas' => 218,
                'fecha_publicacion' => now()->subDays(3),
            ],
            [
                'categoria_id' => $cat['educacion'],
                'titulo' => 'Entrega de 120 Equipos Informáticos a Unidades Educativas',
                'entradilla' => 'El GAMA entregó computadoras y proyectores a 8 unidades educativas, mejorando las condiciones de aprendizaje de más de 3.500 estudiantes.',
                'cuerpo' => '<p>Los equipos fueron adquiridos con recursos del IDH municipal. Adicionalmente se instaló internet de banda ancha en todas las unidades beneficiadas.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img3.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 156,
                'fecha_publicacion' => now()->subDays(6),
            ],
            [
                'categoria_id' => $cat['medio-ambiente'],
                'titulo' => 'Campaña de Arborización: 5.000 Árboles Plantados en Achocalla',
                'entradilla' => 'En el marco del Día Mundial del Medio Ambiente, el GAMA y la comunidad plantaron 5.000 árboles nativos en áreas verdes y márgenes de ríos.',
                'cuerpo' => '<p>Las especies plantadas incluyen queñua, aliso, pino andino y molle. El objetivo es reforestar 50 hectáreas degradadas en 3 años.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img13.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 189,
                'fecha_publicacion' => now()->subDays(10),
            ],
            [
                'categoria_id' => $cat['cultura-deporte'],
                'titulo' => 'Festival Cultural "Achocalla Vive" Reunió a Más de 10.000 Asistentes',
                'entradilla' => 'El primer festival cultural presentó música folclórica, danzas tradicionales, gastronomía local y artesanías de todas las comunidades.',
                'cuerpo' => '<p>Durante dos días se realizaron más de 40 presentaciones artísticas y ferias gastronómicas. El evento generó ingresos para más de 200 artesanos locales.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img14.png',
                'estado' => 'publicado',
                'destacada' => true,
                'vistas' => 423,
                'fecha_publicacion' => now()->subDays(15),
            ],
            [
                'categoria_id' => $cat['institucional'],
                'titulo' => 'GAMA Presenta Rendición de Cuentas Final 2025',
                'entradilla' => 'El municipio presentó el informe de gestión 2025 con un nivel de ejecución presupuestaria del 87% y 45 obras concluidas.',
                'cuerpo' => '<p>Se ejecutaron Bs. 42.3 millones en obras de infraestructura, servicios básicos, salud, educación y desarrollo productivo.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img15.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 267,
                'fecha_publicacion' => now()->subDays(20),
            ],
            [
                'categoria_id' => $cat['obras-infraestructura'],
                'titulo' => 'Inicio de Construcción del Puente Vehicular Río Achocalla',
                'entradilla' => 'Con una inversión de Bs. 3.800.000, el nuevo puente vehicular conectará las comunidades del norte del municipio con la capital provincial.',
                'cuerpo' => '<p>El puente tendrá 45 metros de longitud y capacidad para vehículos de hasta 20 toneladas. El plazo de ejecución es de 180 días calendario.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img16.png',
                'estado' => 'publicado',
                'destacada' => true,
                'vistas' => 301,
                'fecha_publicacion' => now()->subDays(22),
            ],
            [
                'categoria_id' => $cat['social'],
                'titulo' => 'Programa de Vivienda Social Beneficia a 80 Familias de Escasos Recursos',
                'entradilla' => 'El GAMA en coordinación con el Ministerio de Obras Públicas entregó módulos habitacionales a familias vulnerables del municipio.',
                'cuerpo' => '<p>Cada módulo cuenta con dos dormitorios, sala-comedor, cocina y baño. Los beneficiarios aportaron mano de obra no calificada como contraparte.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img17.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 198,
                'fecha_publicacion' => now()->subDays(25),
            ],
            [
                'categoria_id' => $cat['seguridad-ciudadana'],
                'titulo' => 'Instalación de 50 Cámaras de Videovigilancia en el Municipio',
                'entradilla' => 'El sistema de videovigilancia municipal se amplía con 50 nuevas cámaras en puntos estratégicos, ferias y accesos principales de Achocalla.',
                'cuerpo' => '<p>Las cámaras están conectadas al centro de monitoreo municipal que opera las 24 horas en coordinación con la Policía Boliviana.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img18.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 245,
                'fecha_publicacion' => now()->subDays(28),
            ],
            [
                'categoria_id' => $cat['educacion'],
                'titulo' => 'Becas Municipales 2026: 150 Estudiantes Destacados Serán Beneficiados',
                'entradilla' => 'El programa de becas municipales cubrirá el costo de inscripción y materiales para estudiantes con mejor rendimiento académico del municipio.',
                'cuerpo' => '<p>Las becas están dirigidas a estudiantes de secundaria con promedio mayor a 80 puntos. Las postulaciones se reciben en la Dirección de Educación del GAMA.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img1.png',
                'estado' => 'publicado',
                'destacada' => true,
                'vistas' => 312,
                'fecha_publicacion' => now()->subDays(32),
            ],
            [
                'categoria_id' => $cat['medio-ambiente'],
                'titulo' => 'GAMA Implementa Sistema de Reciclaje en Todas las Comunidades',
                'entradilla' => 'El nuevo programa de gestión de residuos sólidos incluye contenedores diferenciados y rutas de recolección tres veces por semana.',
                'cuerpo' => '<p>El programa busca reducir en un 40% la cantidad de residuos que llegan al vertedero municipal mediante la separación en origen.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img2.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 167,
                'fecha_publicacion' => now()->subDays(35),
            ],
            [
                'categoria_id' => $cat['obras-infraestructura'],
                'titulo' => 'Conclusión del Sistema de Agua Potable para 6 Comunidades',
                'entradilla' => 'Más de 2.400 familias de las comunidades de Huaricana, Cutipampa y otras 4 comunidades acceden ahora a agua potable las 24 horas.',
                'cuerpo' => '<p>El proyecto incluye captación, planta de tratamiento, red de distribución y 2.400 conexiones domiciliarias. La inversión total fue de Bs. 12.6 millones.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img3.png',
                'estado' => 'publicado',
                'destacada' => true,
                'vistas' => 389,
                'fecha_publicacion' => now()->subDays(40),
            ],
            [
                'categoria_id' => $cat['cultura-deporte'],
                'titulo' => 'Achocalla Clasifica al Campeonato Nacional de Fútbol Amateur',
                'entradilla' => 'La selección municipal de fútbol clasificó al campeonato nacional tras ganar el torneo departamental de La Paz con 8 victorias consecutivas.',
                'cuerpo' => '<p>El equipo representará al municipio en el campeonato nacional a realizarse en Cochabamba en el mes de junio de 2026.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img13.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 276,
                'fecha_publicacion' => now()->subDays(45),
            ],
            [
                'categoria_id' => $cat['salud'],
                'titulo' => 'Nuevo Centro de Salud Inaugurado en la Comunidad de Villa Achocalla',
                'entradilla' => 'El nuevo establecimiento de salud de primer nivel atenderá a más de 4.000 habitantes de Villa Achocalla y comunidades aledañas.',
                'cuerpo' => '<p>El centro cuenta con consultorio médico, odontológico, sala de partos, laboratorio y farmacia. El servicio es gratuito para todos los ciudadanos.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img14.png',
                'estado' => 'publicado',
                'destacada' => true,
                'vistas' => 421,
                'fecha_publicacion' => now()->subDays(50),
            ],
            [
                'categoria_id' => $cat['institucional'],
                'titulo' => 'Modernización del Sistema de Cobro de Impuestos Municipales',
                'entradilla' => 'El GAMA implementa un nuevo sistema digital para el pago de impuestos que permite realizar los trámites desde cualquier dispositivo con internet.',
                'cuerpo' => '<p>El sistema permite pagar el impuesto a la propiedad inmueble, patentes y tasas municipales mediante transferencia bancaria o QR.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img15.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 198,
                'fecha_publicacion' => now()->subDays(55),
            ],
            [
                'categoria_id' => $cat['social'],
                'titulo' => 'Taller de Emprendimiento para 200 Mujeres del Municipio',
                'entradilla' => 'El programa de empoderamiento económico femenino capacitó a 200 mujeres en gestión empresarial, marketing digital y acceso a créditos.',
                'cuerpo' => '<p>Las participantes recibieron certificación del INFOCAL y acceso a una línea de crédito especial del BDP con tasa preferencial del 6% anual.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img16.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 234,
                'fecha_publicacion' => now()->subDays(60),
            ],
            [
                'categoria_id' => $cat['obras-infraestructura'],
                'titulo' => 'Conclusión de 12 Canchas Deportivas en Comunidades del Municipio',
                'entradilla' => 'El programa de infraestructura deportiva concluyó la construcción de 12 canchas multifuncionales con iluminación LED en igual número de comunidades.',
                'cuerpo' => '<p>Cada cancha tiene capacidad para practicar fútbol sala, básquetbol y vóleibol. Las obras incluyen graderías, vestuarios y baños.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img17.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 187,
                'fecha_publicacion' => now()->subDays(65),
            ],
            [
                'categoria_id' => $cat['educacion'],
                'titulo' => 'Inicio del Programa de Alfabetización Digital para Adultos Mayores',
                'entradilla' => 'El GAMA lanza cursos gratuitos de uso de smartphones, internet y trámites digitales dirigidos a ciudadanos mayores de 60 años.',
                'cuerpo' => '<p>Los cursos se dictan en los centros de la tercera edad del municipio con horarios flexibles. Los instructores son jóvenes universitarios voluntarios.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img18.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 143,
                'fecha_publicacion' => now()->subDays(70),
            ],
            [
                'categoria_id' => $cat['medio-ambiente'],
                'titulo' => 'Achocalla Recibe Premio Nacional a la Gestión Ambiental Municipal',
                'entradilla' => 'El Ministerio de Medio Ambiente otorgó al municipio el premio a la mejor gestión ambiental por sus programas de reforestación y reciclaje.',
                'cuerpo' => '<p>El reconocimiento destaca los 15.000 árboles plantados en los últimos 3 años y la reducción del 35% en residuos sólidos enviados a vertedero.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img1.png',
                'estado' => 'publicado',
                'destacada' => true,
                'vistas' => 356,
                'fecha_publicacion' => now()->subDays(75),
            ],
            [
                'categoria_id' => $cat['institucional'],
                'titulo' => 'GAMA Firma Convenio de Cooperación con la UMSA',
                'entradilla' => 'El convenio permitirá pasantías de estudiantes universitarios, asistencia técnica en proyectos municipales e investigación aplicada al desarrollo local.',
                'cuerpo' => '<p>El convenio tiene vigencia de 5 años y contempla la participación de las facultades de Ingeniería, Agronomía, Derecho y Ciencias Económicas.</p>',
                'imagen_principal_url' => 'assets/img/all-images/blog-img2.png',
                'estado' => 'publicado',
                'destacada' => false,
                'vistas' => 221,
                'fecha_publicacion' => now()->subDays(80),
            ],
        ];

        foreach ($noticias as $data) {
            DB::table('noticias')->insert([
                ...$data,
                'autor_id' => $adminId,
                'slug' => Str::slug($data['titulo']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
