<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PncpConsultaService
{
    public function get(string $endpoint, array $query = [])
    {
        return Http::acceptJson()
            ->get(config('pncp.consulta.base_url') . $endpoint, $query)
            ->json();
    }
}
