<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PncpConsultaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PncpPlanoContratacaoController extends Controller
{
    protected $api;

    public function __construct(PncpConsultaService $api)
    {
        $this->api = $api;
    }

    public function consultarPorUsuario(Request $request)
    {
        try {
            $params = $request->validate([
                'ano' => 'required|integer',
                'idUsuario' => 'nullable|integer',
                'cnpj' => 'nullable|string',
                'codigoUnidadeAdministrativa' => 'nullable|string',
                'pagina' => 'required|integer|min:1',
                'tamanhoPagina' => 'nullable|integer|min:10|max:500'
            ]);

            return response()->json(
                $this->api->get('/v1/pca/usuario', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar PCA por usuário', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - PCA usuário'], 500);
        }
    }

    public function consultarPorAtualizacao(Request $request)
    {
        try {
            $params = $request->validate([
                'dataInicial' => 'required|date',
                'dataFinal' => 'required|date',
                'idUsuario' => 'nullable|integer',
                'cnpj' => 'nullable|string',
                'codigoUnidadeAdministrativa' => 'nullable|string',
                'pagina' => 'required|integer|min:1',
                'tamanhoPagina' => 'nullable|integer|min:10|max:500'
            ]);

            return response()->json(
                $this->api->get('/v1/pca/atualizacao', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar PCA por atualização', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - PCA atualização'], 500);
        }
    }

    public function consultarPorAno(Request $request)
    {
        try {
            $params = $request->validate([
                'ano' => 'required|integer',
                'idUsuario' => 'nullable|integer',
                'cnpj' => 'nullable|string',
                'codigoUnidadeAdministrativa' => 'nullable|string',
                'pagina' => 'required|integer|min:1',
                'tamanhoPagina' => 'nullable|integer|min:10|max:500'
            ]);

            return response()->json(
                $this->api->get('/v1/pca', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar PCA por ano', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - PCA ano'], 500);
        }
    }
}

