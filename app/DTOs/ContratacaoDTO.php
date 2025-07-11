<?php

namespace App\DTOs;

class ContratacaoDTO
{
    public static function fromRequest(array $data): array
    {
        return [
            'numeroCompra' => $data['numeroCompra'] ?? null,
            'anoCompra' => $data['anoCompra'] ?? null,
            'modalidadeId' => $data['modalidadeId'] ?? null,
            'tipoInstrumentoConvocatorioId' => $data['tipoInstrumentoConvocatorioId'] ?? null,
            'numeroProcesso' => $data['numeroProcesso'] ?? null,
            'dataDisponibilizacaoEdital' => $data['dataDisponibilizacaoEdital'] ?? null,
            'criterioJulgamentoId' => $data['criterioJulgamentoId'] ?? null,
            'objeto' => $data['objeto'] ?? null,
            'unidadeMedida' => $data['unidadeMedida'] ?? null,
            'quantidade' => $data['quantidade'] ?? null,
            'valorEstimado' => $data['valorEstimado'] ?? null,
            'regimeExecucaoId' => $data['regimeExecucaoId'] ?? null,
            'tipoContratacaoId' => $data['tipoContratacaoId'] ?? null,
            'formaContratacaoId' => $data['formaContratacaoId'] ?? null,
        ];
    }
}
