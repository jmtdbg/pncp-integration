<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PncpConsultaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PncpContratoController extends Controller
{
    protected $api;

    public function __construct(PncpConsultaService $api)
    {
        $this->api = $api;
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
                $this->api->get('/v1/contratos/publicacao', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar contratos - publicacao', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - contratos publicação'], 500);
        }
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
                $this->api->get('/v1/contratos/atualizacao', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar contratos - atualizacao', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - contratos atualização'], 500);
        }
    }

    public function consultarComprasPorId($id)
    {
        try {
            return response()->json(
                $this->api->get("/v1/contratos/compras/{$id}")
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar compras por ID do contrato', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - compras por contrato'], 500);
        }
    }
}

