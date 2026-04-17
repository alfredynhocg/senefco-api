<?php

namespace App\Infrastructure\WhatsApp\Enums;

enum BotButton: string
{
    case MENU = 'btn_menu';
    case TRAMITES = 'btn_tramites';
    case NOTICIAS = 'btn_noticias';
    case COMUNICADOS = 'btn_comunicados';
    case EVENTOS = 'btn_eventos';
    case SECRETARIAS = 'btn_secretarias';
    case AUTORIDADES = 'btn_autoridades';
    case HORARIO = 'btn_horario';
    case UBICACION = 'btn_ubicacion';
    case SOPORTE = 'btn_soporte';
    case AUDIENCIAS_PUBLICAS = 'btn_audiencias';
    case SEGUIMIENTO = 'btn_seguimiento';

    const PREFIX_TRAMITE = 'tramite_';

    const PREFIX_NOTICIA = 'noticia_';

    const PREFIX_COMUNICADO = 'comunicado_';

    const PREFIX_EVENTO = 'evento_';

    const PREFIX_SECRETARIA = 'sec_';

    const PREFIX_AUTORIDAD = 'autoridad_';

    const PREFIX_AUDIENCIA = 'audiencia_';

    const PREFIX_INICIAR_TRAMITE = 'iniciar_tramite_';
}
