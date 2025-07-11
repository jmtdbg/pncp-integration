<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PncpConsultaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PncpConsultaController extends Controller
{
    protected $api;

    public function __construct(PncpConsultaService $api)
    {
        $this->api = $api;
    }


    public function consultarContratacoesPublicadas(Request $request)
    {
        try {
            $params = $request->validate([
                'dataInicial' => 'required|date',
                'dataFinal' => 'required|date',
                'pagina' => 'required|integer|min:1',
                'codigoModalidadeContratacao' => 'required|integer',
                'tamanhoPagina' => 'nullable|integer|min:10|max:500',
            ]);

            $params['dataInicial'] = Carbon::parse($params['dataInicial'])->format('Ymd');
            $params['dataFinal'] = Carbon::parse($params['dataFinal'])->format('Ymd');

            return response()->json(
                $this->api->get('/v1/contratacoes/publicacao', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar contratacoes publicadas', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar contratacoes publicadas'], 500);
        }
    }

    public function consultarContratacoesAtualizadas(Request $request)
    {
        try {
            $params = $request->validate([
                'dataInicial' => 'required|date',
                'dataFinal' => 'required|date',
                'pagina' => 'required|integer|min:1',
                'codigoModalidadeContratacao' => 'required|integer',
                'tamanhoPagina' => 'nullable|integer|min:10|max:500',
            ]);

            $params['dataInicial'] = Carbon::parse($params['dataInicial'])->format('Ymd');
            $params['dataFinal'] = Carbon::parse($params['dataFinal'])->format('Ymd');

            return response()->json(
                $this->api->get('/v1/contratacoes/atualizacao', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar contratacoes atualizadas', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar contratacoes atualizadas'], 500);
        }
    }

    public function consultarCompraPorId($id)
    {
        try {
            return response()->json(
                $this->api->get("/v1/compras/{$id}")
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar compra por ID', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar compra'], 500);
        }
    }
    public function consultarContratacoes(Request $request, PncpConsultaService $pncp)
    {
        try {
            $dados = $pncp->get('/v1/contratacoes/publicacao', $request->all());
            return response()->json($dados);
        } catch (\Throwable $e) {
            \Log::error('Erro consulta PNCP', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP'], 500);
        }
    }
}



