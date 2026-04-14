<?php

namespace App\Http\Traits;

use App\Infrastructure\Shared\Services\TelegramBotService;
use App\Infrastructure\Shared\Services\TelegramService;

trait TelegramServiceTrait
{
    private TelegramService $telegram;

    private TelegramBotService $bot;

    private function initializeTelegramServices(): void
    {
        $this->telegram = new TelegramService;
        $this->bot = new TelegramBotService;
    }
}
