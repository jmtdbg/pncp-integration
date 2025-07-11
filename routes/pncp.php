<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PncpAtaController;
use App\Http\Controllers\Admin\PncpPlanoContratacaoController;
use App\Http\Controllers\Admin\PncpContratoController;
use App\Http\Controllers\Admin\PncpInstrumentoCobrancaController;
use App\Http\Controllers\Admin\PncpContratacaoController;
use App\Http\Controllers\Admin\PncpConsultaController;
use App\Http\Controllers\Admin\PncpEnvioController;

Route::prefix('pncp')->middleware('api')->group(function () {

    // Consultas públicas
    Route::get('contratacoes/publicacao', [PncpConsultaController::class, 'consultarContratacoesPublicadas']);
    Route::get('contratacoes/atualizacao', [PncpConsultaController::class, 'consultarContratacoesAtualizadas']);
    Route::get('compras/{id}', [PncpConsultaController::class, 'consultarCompraPorId']);

    // ✅ Nova rota adicionada para funcionar com:
    // GET /api/pncp/consultas/contratacoes/publicacao
    Route::get('consultas/contratacoes/publicacao', [PncpConsultaController::class, 'consultarContratacoesPublicadas']);

    // Contratação (com envio via job)
    Route::post('contratacoes', [PncpContratacaoController::class, 'enviar']);
    Route::put('contratacoes/{id}', [PncpContratacaoController::class, 'atualizar']);

    // Instrumento de Cobrança
    Route::get('instrumentos-cobranca/publicacao', [PncpInstrumentoCobrancaController::class, 'consultarPublicacao']);
    Route::get('instrumentos-cobranca/atualizacao', [PncpInstrumentoCobrancaController::class, 'consultarAtualizacao']);

    // Contrato
    Route::get('contratos/publicacao', [PncpContratoController::class, 'consultarPublicacao']);
    Route::get('contratos/atualizacao', [PncpContratoController::class, 'consultarAtualizacao']);
    Route::get('contratos/compras/{id}', [PncpContratoController::class, 'consultarComprasPorId']);

    // Ata
    Route::get('atas/vigencia', [PncpAtaController::class, 'consultarPorPeriodoVigencia']);
    Route::get('atas/atualizacao', [PncpAtaController::class, 'consultarPorAtualizacao']);

    // Plano de Contratação Anual (PCA)
    Route::get('pca/usuario', [PncpPlanoContratacaoController::class, 'consultarPorUsuario']);
    Route::get('pca/atualizacao', [PncpPlanoContratacaoController::class, 'consultarPorAtualizacao']);
    Route::get('pca', [PncpPlanoContratacaoController::class, 'consultarPorAno']);

    // Contratação antiga (se ainda usados)
    Route::get('consultas/contratacoes', [PncpConsultaController::class, 'consultarContratacoes']);
    Route::post('envio/contratacao', [PncpEnvioController::class, 'enviarContratacao']);
    Route::put('atualiza/contratacao/{id}', [PncpEnvioController::class, 'atualizarContratacao']);
});
