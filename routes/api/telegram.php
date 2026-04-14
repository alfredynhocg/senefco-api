<?php

use App\Http\Controllers\Api\Telegram\TelegramManagementController;
use App\Http\Controllers\Api\Telegram\TelegramWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook', [TelegramWebhookController::class, 'webhook']);

Route::get('/set-webhook', [TelegramManagementController::class, 'setWebhook']);
Route::get('/webhook-info', [TelegramManagementController::class, 'webhookInfo']);
Route::delete('/webhook', [TelegramManagementController::class, 'deleteWebhook']);

Route::get('/me', [TelegramManagementController::class, 'me']);
Route::get('/bot-test', [TelegramManagementController::class, 'botTest']);
