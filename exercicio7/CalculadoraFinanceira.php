<?php

class CalculadoraFinanceira
{
    public function calcularJurosSimples($capital, $taxa, $tempo)
    {
        if (!is_numeric($capital) || !is_numeric($taxa) || !is_numeric($tempo) || $capital < 0 || $taxa < 0 || $tempo < 0) {
            return "Valores Inválidos";
        }

        $juros = $capital * $taxa * $tempo;

        return $juros;
    }

    public function calcularJurosCompostos($capital, $taxa, $tempo)
    {
        if (!is_numeric($capital) || !is_numeric($taxa) || !is_numeric($tempo) || $capital < 0 || $taxa < 0 || $tempo < 0) {
            return "Valores Inválidos";
        }

        $montante = $capital * pow((1 + $taxa), $tempo);
        $juros = $montante - $capital;

        return round($juros, 2);
    }

    public function calcularAmortizacao($capital, $taxa, $tempo, $tipo)
    {
        try {
            if (!is_numeric($capital) || !is_numeric($taxa) || !is_numeric($tempo)) {
                throw new Exception('Valores Inválidos');
            }

            if ($tipo == 'SAC') {
                $amortizacao['Total de Juros Pagos'] = $capital / $tempo;
                for ($i = 1; $i < $tempo; $i++) {
                    $amortizacao["Parcela de Amortização $i"] = $amortizacao['Total de Juros Pagos'] + ($capital * $taxa);
                }
            } elseif ($tipo == 'Price') {
                $amortizacao = $capital * ($taxa / (1 - pow((1 + $taxa), -$tempo)));
            } else {
                throw new Exception('Tipo de Amortização Inválido');
            }

            return $amortizacao;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}