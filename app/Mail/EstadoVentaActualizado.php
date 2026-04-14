<?php

namespace App\Mail;

use App\Application\Ventas\DTOs\VentaDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EstadoVentaActualizado extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly VentaDTO $venta,
        public readonly string $clienteNombre,
        public readonly string $estadoAnterior,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Actualización de tu pedido #{$this->venta->numeroVenta}",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.estado_venta');
    }
}
