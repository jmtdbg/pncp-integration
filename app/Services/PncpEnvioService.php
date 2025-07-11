<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PncpEnvioService
{
    public function get(string $endpoint, array $query = [])
    {
        return Http::withToken($this->getToken())
            ->acceptJson()
            ->get(config('pncp.envio.base_url') . $endpoint, $query)
            ->json();
    }

    public function post(string $endpoint, array $data = [])
    {
        return Http::withToken($this->getToken())
            ->acceptJson()
            ->post(config('pncp.envio.base_url') . $endpoint, $data)
            ->json();
    }

    public function put(string $endpoint, array $data = [])
    {
        return Http::withToken($this->getToken())
            ->acceptJson()
            ->put(config('pncp.envio.base_url') . $endpoint, $data)
            ->json();
    }

    protected function getToken()
    {
        return Cache::remember('pncp_envio_token', now()->addMinutes(55), function () {
            $response = Http::post(
                config('pncp.envio.base_url') . config('pncp.envio.login_endpoint'),
                [
                    'login' => config('pncp.envio.login'),
                    'senha' => config('pncp.envio.password'),
                ]
            );

            $data = $response->json();

            return 'Bearer ' . ($data['token'] ?? throw new \Exception('Token não retornado'));
        });
    }
}
