<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PncpConsultaService;
use App\Jobs\EnviarContratacaoJob;
use Illuminate\Http\Request;

class PncpEnvioController extends Controller
{
    public function enviarContratacao(Request $request)
    {
        EnviarContratacaoJob::dispatch($request->all());
        return response()->json(['status' => 'Enviado para fila']);
    }

    public function atualizarContratacao($id, Request $request, PncpConsultaService $pncp)
    {
        try {
            $dados = $pncp->put("/v1/contratacoes/{$id}", $request->all());
            return response()->json($dados);
        } catch (\Throwable $e) {
            \Log::error('Erro atualização PNCP', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao atualizar PNCP'], 500);
        }
    }
}
