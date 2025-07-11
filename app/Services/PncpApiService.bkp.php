<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PncpApiService
{
    protected $authService;

    public function __construct(PncpAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function get(string $endpoint, array $query = [])
    {
        $url = config('pncp.base_url') . $endpoint;
        Log::info('GET PNCP', ['url' => $url, 'query' => $query]);

        return Http::withToken($this->authService->getToken())
            ->acceptJson()
            ->get(config('pncp.base_url') . $endpoint, $query)
            ->json();
    }

    public function post(string $endpoint, array $data)
    {
        return Http::withToken($this->authService->getToken())
            ->acceptJson()
            ->post(config('pncp.base_url') . $endpoint, $data)
            ->json();
    }

    public function put(string $endpoint, array $data)
    {
        return Http::withToken($this->authService->getToken())
            ->acceptJson()
            ->put(config('pncp.base_url') . $endpoint, $data)
            ->json();
    }

    public function delete(string $endpoint, array $data = [])
    {
        return Http::withToken($this->authService->getToken())
            ->acceptJson()
            ->withBody(json_encode($data), 'application/json')
            ->delete(config('pncp.base_url') . $endpoint)
            ->json();
    }
}
