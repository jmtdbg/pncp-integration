<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PncpAuthService
{
    public function getToken(): string
    {
        return Cache::remember('pncp_token', 3500, function () {
            $response = Http::post(config('pncp.base_url') . config('pncp.login_endpoint'), [
                'login' => config('pncp.login'),
                'senha' => config('pncp.password'),
            ]);

            if ($response->failed()) {
                throw new \Exception('Erro ao autenticar no PNCP');
            }

            return $response->header('Authorization');
        });
    }
}
