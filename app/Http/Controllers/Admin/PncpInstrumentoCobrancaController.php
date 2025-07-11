<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PncpEnvioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PncpInstrumentoCobrancaController extends Controller
{
    protected $api;

    public function __construct(PncpEnvioService $api)
    {
        $this->api = $api;
    }

    public function consultarAtualizacao(Request $request)
    {
        try {
            $params = $request->validate([
                'dataInicial' => 'required|date',
                'dataFinal' => 'required|date',
                'pagina' => 'required|integer|min:1',
                'tamanhoPagina' => 'nullable|integer|min:10|max:500'
            ]);

            return response()->json(
                $this->api->get('/v1/instrumentos-cobranca/atualizacao', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar instrumentos de cobrança - atualizacao', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - instrumentos de cobrança atualização'], 500);
        }
    }

    public function consultarPublicacao(Request $request)
    {
        try {
            $params = $request->validate([
                'dataInicial' => 'required|date',
                'dataFinal' => 'required|date',
                'pagina' => 'required|integer|min:1',
                'tamanhoPagina' => 'nullable|integer|min:10|max:500'
            ]);

            return response()->json(
                $this->api->get('/v1/instrumentos-cobranca/publicacao', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar instrumentos de cobrança - publicacao', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - instrumentos de cobrança publicação'], 500);
        }
    }
}
