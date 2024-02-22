<?php

class CalculadoraFinanceira
{
    public function calcularJurosSimples($capital, $taxa, $tempo)
    {
        try {
            if (!is_numeric($capital) || !is_numeric($taxa) || !is_numeric($tempo)) {
                throw new Exception('Valores Inválidos');
            }

            if ($capital < 0 || $taxa < 0 || $tempo < 0) {
                throw new Exception('Valores não podem ser negativos');
            }

            if (!is_int($tempo)) {
                throw new Exception('Tempo deve ser um número inteiro');
            }

            $juros = $capital * $taxa * $tempo;

            return round($juros, 2);

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function calcularJurosCompostos($capital, $taxa, $tempo)
    {
        try {
            if (!is_numeric($capital) || !is_numeric($taxa) || !is_numeric($tempo)) {
                throw new Exception('Valores Inválidos');
            }

            if ($capital < 0 || $taxa < 0 || $tempo < 0) {
                throw new Exception('Valores não podem ser negativos');
            }

            if (!is_int($tempo)) {
                throw new Exception('Tempo deve ser um número inteiro');
            }

            $montante = $capital * pow((1 + $taxa), $tempo);
            $juros = $montante - $capital;

            return round($juros, 2);

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function calcularAmortizacao($capital, $taxa, $tempo, $tipo)
    {
        try {
            if (!is_numeric($capital) || !is_numeric($taxa) || !is_numeric($tempo)) {
                throw new Exception('Valores Inválidos');
            }

            if ($capital < 0 || $taxa < 0 || $tempo < 0) {
                throw new Exception('Valores não podem ser negativos');
            }

            if (!is_int($tempo)) {
                throw new Exception('Tempo deve ser um número inteiro');
            }

            if ($tipo != 'SAC' && $tipo != 'Price') {
                throw new Exception('Tipo de Amortização Inválido');
            }

            $capitalAtual = $capital;
            $jurosTotal = 0;

            if ($tipo == 'SAC') {
                for ($mes = 1; $mes <= $tempo; $mes++) {
                    $amortizacao["Parcela de Amortização $mes"] = $capital / $tempo;
                    $juros = $capitalAtual * $taxa;
                    $amortizacao["Juros Mês $mes"] = $juros;
                    $jurosTotal += $juros;
                    $capitalAtual -= $amortizacao["Parcela de Amortização $mes"];
                }

            } elseif ($tipo == 'Price') {
                $parcela = $capital * (pow((1+$taxa), $tempo) * $taxa) / (pow((1+$taxa), $tempo) - 1);
                for ($mes = 1; $mes <= $tempo; $mes++) {
                    $juros = $capitalAtual * $taxa;
                    $amortizacao["Parcela de Amortização $mes"] = $parcela - $juros;
                    $amortizacao["Juros Mês $mes"] = $juros;
                    $jurosTotal += $juros;
                    $capitalAtual -= $amortizacao["Parcela de Amortização $mes"];
                }

            }

            $amortizacao['Juros Total'] = $jurosTotal;

            foreach ($amortizacao as $key => $value) {
                $amortizacao[$key] = round($value, 2);
            }

            return $amortizacao;

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}