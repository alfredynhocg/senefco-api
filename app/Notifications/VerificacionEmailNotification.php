<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerificacionEmailNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    protected function buildMailMessage($url): MailMessage
    {
        $frontendUrl = str_replace(
            config('app.url'),
            config('app.frontend_url'),
            $url
        );

        return (new MailMessage)
            ->subject('Verifica tu email — '.config('app.name'))
            ->greeting('¡Casi listo!')
            ->line('Haz click en el botón para verificar tu dirección de email.')
            ->action('Verificar email', $frontendUrl)
            ->line('Este enlace expirará en 60 minutos.')
            ->line('Si no creaste esta cuenta, ignora este correo.')
            ->salutation('Equipo '.config('app.name'));
    }
}
