<?php

use App\Http\Controllers\Api\WhatsApp\WhatsAppContactController;
use App\Http\Controllers\Api\WhatsApp\WhatsAppController;
use App\Http\Controllers\Api\WhatsApp\WhatsAppInteractiveController;
use App\Http\Controllers\Api\WhatsApp\WhatsAppLocationController;
use App\Http\Controllers\Api\WhatsApp\WhatsAppMediaController;
use App\Http\Controllers\Api\WhatsApp\WhatsAppMessageController;
use App\Http\Controllers\Api\WhatsApp\WhatsAppProductController;
use App\Http\Controllers\Api\WhatsApp\WhatsAppProfileController;
use App\Http\Controllers\Api\WhatsApp\WhatsAppTemplateController;
use Illuminate\Support\Facades\Route;

Route::get('/webhook', [WhatsAppController::class, 'verify']);
Route::post('/webhook', [WhatsAppController::class, 'receive']);

Route::get('/test', [WhatsAppController::class, 'test']);
Route::get('/bot-test', [WhatsAppController::class, 'botTest']);

Route::prefix('send')->group(function () {
    Route::post('/text', [WhatsAppMessageController::class, 'text']);
    Route::post('/document', [WhatsAppMediaController::class, 'document']);
    Route::post('/audio', [WhatsAppMediaController::class, 'audio']);
    Route::post('/image', [WhatsAppMediaController::class, 'image']);
    Route::post('/video', [WhatsAppMediaController::class, 'video']);
    Route::post('/sticker', [WhatsAppMediaController::class, 'sticker']);
    Route::post('/location', [WhatsAppLocationController::class, 'location']);
    Route::post('/location-request', [WhatsAppLocationController::class, 'locationRequest']);
    Route::post('/contacts', [WhatsAppContactController::class, 'contacts']);
    Route::post('/buttons', [WhatsAppInteractiveController::class, 'buttons']);
    Route::post('/list', [WhatsAppInteractiveController::class, 'list']);
    Route::post('/template', [WhatsAppTemplateController::class, 'template']);
    Route::post('/product', [WhatsAppProductController::class, 'singleProduct']);
    Route::post('/products', [WhatsAppProductController::class, 'multiProduct']);
});

Route::prefix('message')->group(function () {
    Route::post('/read', [WhatsAppMessageController::class, 'markAsRead']);
    Route::post('/react', [WhatsAppMessageController::class, 'react']);
});

Route::prefix('media')->group(function () {
    Route::post('/', [WhatsAppMediaController::class, 'uploadMedia']);
    Route::get('/{mediaId}', [WhatsAppMediaController::class, 'downloadMedia']);
});

Route::get('/profile', [WhatsAppProfileController::class, 'getProfile']);
Route::put('/profile', [WhatsAppProfileController::class, 'updateProfile']);

Route::post('/plantilla/confirmacion', [WhatsAppController::class, 'plantillaConfirmacion']);
Route::post('/plantilla/entrega', [WhatsAppController::class, 'plantillaEntrega']);
Route::post('/plantilla/promocion', [WhatsAppController::class, 'plantillaPromocion']);
