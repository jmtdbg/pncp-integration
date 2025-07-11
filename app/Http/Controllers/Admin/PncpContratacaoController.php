<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DTOs\ContratacaoDTO;
use App\Jobs\EnviarContratacaoJob;
use App\Services\PncpConsultaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PncpContratacaoController extends Controller
{
    protected $api;

    public function __construct(PncpConsultaService $api)
    {
        $this->api = $api;
    }

    public function enviar(Request $request)
    {
        try {
            $dados = ContratacaoDTO::fromRequest($request->all());
            EnviarContratacaoJob::dispatch($dados);
            return response()->json(['status' => 'Enviado para a fila']);
        } catch (\Throwable $e) {
            Log::error('Erro ao agendar envio de contratação', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao enviar contratação'], 500);
        }
    }

    public function atualizar($id, Request $request)
    {
        try {
            $dados = ContratacaoDTO::fromRequest($request->all());
            return response()->json(
                $this->api->put("/v1/contratacoes/{$id}", $dados)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao atualizar contratação no PNCP', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao atualizar contratação'], 500);
        }
    }
}
