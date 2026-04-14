<?php

namespace App\Infrastructure\WhatsApp\Enums;

enum BotState: string
{
    case MENU = 'menu';
    case SOPORTE = 'soporte';
    case TRAMITES_LISTA = 'tramites_lista';
    case TRAMITE_DETALLE = 'tramite_detalle';
    case NOTICIAS = 'noticias';
    case NOTICIA_DETALLE = 'noticia_detalle';
    case COMUNICADOS = 'comunicados';
    case COMUNICADO_DETALLE = 'comunicado_detalle';
    case EVENTOS = 'eventos';
    case EVENTO_DETALLE = 'evento_detalle';
    case SECRETARIAS = 'secretarias';
    case SECRETARIA_DETALLE = 'secretaria_detalle';
    case AUTORIDADES = 'autoridades';
    case AUTORIDAD_DETALLE = 'autoridad_detalle';
    case AUDIENCIAS_PUBLICAS = 'audiencias_publicas';
    case AUDIENCIA_DETALLE = 'audiencia_detalle';
    case SEGUIMIENTO_TRAMITE = 'seguimiento_tramite';
    case TRAMITE_REGISTRO_NOMBRE = 'tramite_registro_nombre';
    case TRAMITE_REGISTRO_CI = 'tramite_registro_ci';
}
