<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class ZoomApiService
{
    private function getToken(): string
    {
        $accountId    = config('zoom.account_id');
        $clientId     = config('zoom.client_id');
        $clientSecret = config('zoom.client_secret');

        $credentials = base64_encode("{$clientId}:{$clientSecret}");

        $response = Http::withHeaders([
            'Authorization' => "Basic {$credentials}",
        ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");

        if (! $response->ok()) {
            throw new RuntimeException('Zoom auth failed: '.$response->body());
        }

        return $response->json('access_token');
    }

    public function listarReuniones(): array
    {
        $token = $this->getToken();

        $response = Http::withToken($token)
            ->get('https://api.zoom.us/v2/users/me/meetings', [
                'type'      => 'scheduled',
                'page_size' => 50,
            ]);

        $response->throw();

        return collect($response->json('meetings', []))
            ->map(fn ($m) => [
                'id'             => $m['id'],
                'tema'           => $m['topic'],
                'fecha'          => $m['start_time'],
                'duracion_min'   => $m['duration'] ?? 0,
                'link_invitados' => $m['join_url'],
                'password'       => $m['password'] ?? '',
            ])
            ->values()
            ->all();
    }

    public function crearReunion(string $tema, string $fechaInicio, int $duracionMin = 60): array
    {
        $token = $this->getToken();

        $response = Http::withToken($token)
            ->post('https://api.zoom.us/v2/users/me/meetings', [
                'topic'      => $tema,
                'type'       => 2,
                'start_time' => $fechaInicio,
                'duration'   => $duracionMin,
                'timezone'   => config('zoom.timezone', 'America/La_Paz'),
                'settings'   => [
                    'host_video'        => true,
                    'participant_video' => true,
                    'join_before_host'  => false,
                    'waiting_room'      => true,
                    'auto_recording'    => 'cloud',
                ],
            ]);

        $response->throw();

        $data = $response->json();

        return [
            'id'             => $data['id'],
            'tema'           => $data['topic'],
            'fecha'          => $data['start_time'],
            'duracion_min'   => $data['duration'],
            'link_anfitrion' => $data['start_url'],
            'link_invitados' => $data['join_url'],
            'password'       => $data['password'] ?? '',
        ];
    }

    public function grabaciones(): array
    {
        $token      = $this->getToken();
        $all        = [];
        $seen       = [];
        $mesesVacios = 0;
        $i          = 0;

        while ($mesesVacios < 3) {
            $hasta  = Carbon::now()->subDays(30 * $i)->toDateString();
            $desde  = Carbon::now()->subDays(30 * ($i + 1))->toDateString();
            $chunk  = $this->grabacionesEnRango($token, $desde, $hasta);

            if (! empty($chunk)) {
                foreach ($chunk as $item) {
                    $key = $item['link_descarga'] ?? $item['link_play'] ?? null;
                    if ($key && ! isset($seen[$key])) {
                        $seen[$key] = true;
                        $all[]      = $item;
                    }
                }
                $mesesVacios = 0;
            } else {
                $mesesVacios++;
            }

            $i++;
        }

        return $all;
    }

    private function grabacionesEnRango(string $token, string $desde, string $hasta): array
    {
        $url       = 'https://api.zoom.us/v2/users/me/recordings';
        $results   = [];
        $nextToken = null;

        do {
            $params = $nextToken
                ? ['next_page_token' => $nextToken]
                : ['page_size' => 300, 'from' => $desde, 'to' => $hasta];

            $response = Http::withToken($token)->get($url, $params);

            if (! $response->ok()) {
                break;
            }

            $data = $response->json();

            foreach ($data['meetings'] ?? [] as $meeting) {
                foreach ($meeting['recording_files'] ?? [] as $file) {
                    $results[] = [
                        'curso'          => $meeting['topic'],
                        'fecha'          => $meeting['start_time'],
                        'duracion_min'   => $meeting['duration'],
                        'tipo_archivo'   => $file['file_type'],
                        'tamanio_mb'     => round(($file['file_size'] ?? 0) / 1_048_576, 1),
                        'link_descarga'  => $file['download_url'] ?? null,
                        'link_play'      => $file['play_url'] ?? null,
                    ];
                }
            }

            $nextToken = $data['next_page_token'] ?? null;
        } while ($nextToken);

        return $results;
    }
}
