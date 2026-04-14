<?php

namespace App\Jobs;

use App\Infrastructure\Shared\Services\WhatsAppBotService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessWhatsAppMessageJob implements ShouldQueue
{
    use Queueable;

    public int $timeout = 120;

    public int $tries = 1;

    public function __construct(
        public readonly string $from,
        public readonly string $type,
        public readonly array $message,
        public readonly ?string $nombre = null,
    ) {}

    public function handle(WhatsAppBotService $bot): void
    {
        $bot->handleMessage($this->from, $this->type, $this->message, $this->nombre);
    }
}
