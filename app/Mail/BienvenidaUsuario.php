<?php

namespace App\Mail;

use App\Infrastructure\Usuarios\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BienvenidaUsuario extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly User $user,
        public readonly string $passwordTemporal,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenido a '.config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bienvenida',
        );
    }
}
