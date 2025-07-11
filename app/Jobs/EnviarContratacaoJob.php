<?php

namespace App\Jobs;

use App\Services\PncpEnvioService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EnviarContratacaoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $dados;

    public function __construct(array $dados)
    {
        $this->dados = $dados;
    }

    public function handle(PncpEnvioService $api)
    {
        try {
            $api->post('/v1/contratacoes', $this->dados);
        } catch (\Throwable $e) {
            Log::error('Erro ao enviar contratação para o PNCP', ['exception' => $e]);
            $this->release(30); // retry em 30s
        }
    }
}
