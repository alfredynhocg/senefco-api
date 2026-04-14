<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'API Alcaldía Municipal',
    version: '1.0.0',
    description: 'API REST del Portal Institucional de la Alcaldía Municipal. Gestión de contenido, transparencia, trámites ciudadanos y estructura organizacional.'
)]
#[OA\Server(url: '/api', description: 'Autenticación')]
#[OA\Server(url: '/api/v1', description: 'API v1')]
#[OA\SecurityScheme(
    securityScheme: 'sanctum',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'JWT',
    description: 'Token Bearer de Laravel Sanctum. Obtenerlo con POST /api/auth/login'
)]
#[OA\Tag(name: 'Auth', description: 'Autenticación y gestión de sesión')]
#[OA\Tag(name: 'Noticias', description: 'Gestión de noticias institucionales')]
#[OA\Tag(name: 'Comunicados', description: 'Comunicados y notas de prensa')]
#[OA\Tag(name: 'Eventos', description: 'Agenda de eventos municipales')]
#[OA\Tag(name: 'Normas', description: 'Repositorio legal: leyes, decretos, resoluciones')]
#[OA\Tag(name: 'Trámites', description: 'Catálogo de trámites ciudadanos')]
#[OA\Tag(name: 'Transparencia', description: 'Documentos de transparencia institucional')]
#[OA\Tag(name: 'Auditorías', description: 'Auditorías institucionales')]
#[OA\Tag(name: 'Presupuesto', description: 'Presupuesto, POA y ejecución presupuestaria')]
#[OA\Tag(name: 'Indicadores', description: 'Indicadores de gestión')]
#[OA\Tag(name: 'Secretarías', description: 'Estructura orgánica: secretarías y subalcaldías')]
#[OA\Tag(name: 'Autoridades', description: 'Directorio de autoridades y funcionarios')]
#[OA\Tag(name: 'Historia', description: 'Historia y datos del municipio')]
#[OA\Tag(name: 'Banners', description: 'Banners del portal web')]
#[OA\Tag(name: 'Menús', description: 'Estructura de navegación del portal')]
#[OA\Tag(name: 'Configuración', description: 'Configuración global del portal')]
#[OA\Tag(name: 'Consultas', description: 'Consultas ciudadanas y participación')]
#[OA\Tag(name: 'Sugerencias', description: 'Canal de sugerencias ciudadanas')]
#[OA\Tag(name: 'Solicitudes', description: 'Solicitudes de acceso a información pública')]
#[OA\Tag(name: 'Contacto', description: 'Mensajes de contacto ciudadano')]
#[OA\Tag(name: 'Directorio', description: 'Directorio institucional de contactos')]
#[OA\Tag(name: 'Usuarios', description: 'Gestión de usuarios del sistema')]
#[OA\Tag(name: 'Roles', description: 'Roles y permisos del sistema')]
#[OA\Tag(name: 'Búsqueda', description: 'Búsqueda global en todo el portal')]
abstract class Controller
{
    //
}
