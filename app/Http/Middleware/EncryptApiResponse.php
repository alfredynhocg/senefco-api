<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Cifra la respuesta JSON con AES-256-CBC.
 *
 * El cliente necesita la misma API_ENCRYPT_KEY para descifrar.
 * Formato de respuesta cifrada:
 * {
 *   "encrypted": "<base64 del ciphertext>",
 *   "iv":        "<hex del IV aleatorio de 16 bytes>"
 * }
 *
 * Para descifrar en el cliente (Angular / Web Crypto API):
 *   const key = await crypto.subtle.importKey('raw', hexToBuffer(API_ENCRYPT_KEY), 'AES-CBC', false, ['decrypt']);
 *   const plain = await crypto.subtle.decrypt({ name: 'AES-CBC', iv: hexToBuffer(iv) }, key, base64ToBuffer(encrypted));
 */
class EncryptApiResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Solo cifrar respuestas JSON exitosas
        if (! $this->debecifrarse($response)) {
            return $response;
        }

        $keyHex = config('services.api_encrypt.key');

        if (empty($keyHex)) {
            return $response;
        }

        $keyBin = hex2bin($keyHex);
        $iv = random_bytes(16);

        $ciphertext = openssl_encrypt(
            $response->getContent(),
            'AES-256-CBC',
            $keyBin,
            OPENSSL_RAW_DATA,
            $iv
        );

        if ($ciphertext === false) {
            return $response;
        }

        $response->setContent(json_encode([
            'encrypted' => base64_encode($ciphertext),
            'iv' => bin2hex($iv),
        ]));

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('X-Encrypted', '1');

        return $response;
    }

    private function debecifrarse(Response $response): bool
    {
        $contentType = $response->headers->get('Content-Type', '');

        return str_contains($contentType, 'application/json')
            && $response->getStatusCode() >= 200
            && $response->getStatusCode() < 300;
    }
}
