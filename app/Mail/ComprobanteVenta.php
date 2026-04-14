<?php

namespace App\Mail;

use App\Application\Ventas\DTOs\VentaDTO;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComprobanteVenta extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly VentaDTO $venta,
        public readonly string $clienteNombre,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Comprobante de venta #{$this->venta->numeroVenta} — ".config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.comprobante_venta');
    }

    public function attachments(): array
    {
        $pdf = Pdf::loadView('pdf.comprobante_venta', ['venta' => $this->venta]);

        return [
            Attachment::fromData(
                fn () => $pdf->output(),
                "comprobante-{$this->venta->numeroVenta}.pdf"
            )->withMime('application/pdf'),
        ];
    }
}
