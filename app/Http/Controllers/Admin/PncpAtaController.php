<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PncpConsultaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PncpAtaController extends Controller
{
    protected $api;

    public function __construct(PncpConsultaService $api)
    {
        $this->api = $api;
    }

    public function consultarPorPeriodoVigencia(Request $request)
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
                $this->api->get('/v1/atas', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar ata por vigência', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - Ata'], 500);
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
                $this->api->get('/v1/atas/atualizacao', $params)
            );
        } catch (\Throwable $e) {
            Log::error('Erro ao consultar ata por atualização', ['exception' => $e]);
            return response()->json(['erro' => 'Erro ao consultar PNCP - Ata Atualização'], 500);
        }
    }
}
