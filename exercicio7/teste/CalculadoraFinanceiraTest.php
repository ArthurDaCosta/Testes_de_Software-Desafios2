<?php

use PHPUnit\Framework\TestCase;
require_once 'CalculadoraFinanceira.php';

class CalculadoraFinanceiraTest extends TestCase
{
    public function testCalcularJurosSimples()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals(2000    , $calculadora->calcularJurosSimples(1000, 0.2, 10));   //Juros simples
        $this->assertEquals(0       , $calculadora->calcularJurosSimples(0, 0, 0));         //Capital inicial, taxa de juros e tempo zero
    }

    public function testCalcularJurosSimplesComValorInvalido()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals('Valores Inválidos'                 , $calculadora->calcularJurosSimples('a', 'a', 'a'));       //Capital inicial, taxa de juros e tempo não numéricos
        $this->assertEquals('Valores não podem ser negativos'   , $calculadora->calcularJurosSimples(-1000, -0.2, -10));    //Capital inicial, taxa de juros e tempo negativos
        $this->assertEquals('Tempo deve ser um número inteiro'  , $calculadora->calcularJurosSimples(1000, 0.2, 10.5));     //Tempo não inteiro
    }

    public function testCalcularJurosCompostos()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals(5191.74 , $calculadora->calcularJurosCompostos(1000, 0.2, 10)); //Juros compostos
        $this->assertEquals(0       , $calculadora->calcularJurosCompostos(0, 0, 0));       //Capital inicial, taxa de juros e tempo zero
    }

    public function testCalcularJurosCompostosComValorInvalido()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals('Valores Inválidos'                 , $calculadora->calcularJurosCompostos('a', 'a', 'a'));     //Capital inicial, taxa de juros e tempo string não numérica
        $this->assertEquals('Valores não podem ser negativos'   , $calculadora->calcularJurosCompostos(-1000, -0.2, -10));  //Capital inicial, taxa de juros e tempo negativos
        $this->assertEquals('Tempo deve ser um número inteiro'  , $calculadora->calcularJurosCompostos(1000, 0.2, 10.5));   //Tempo não inteiro
    }

    public function testCalcularAmortizacaoSAC()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals(
            [
                'Parcela de Amortização 1' => 100,
                'Juros Mês 1' => 100,
                'Parcela de Amortização 2' => 100,
                'Juros Mês 2' => 90,
                'Parcela de Amortização 3' => 100,
                'Juros Mês 3' => 80,
                'Parcela de Amortização 4' => 100,
                'Juros Mês 4' => 70,
                'Parcela de Amortização 5' => 100,
                'Juros Mês 5' => 60,
                'Parcela de Amortização 6' => 100,
                'Juros Mês 6' => 50,
                'Parcela de Amortização 7' => 100,
                'Juros Mês 7' => 40,
                'Parcela de Amortização 8' => 100,
                'Juros Mês 8' => 30,
                'Parcela de Amortização 9' => 100,
                'Juros Mês 9' => 20,
                'Parcela de Amortização 10' => 100,
                'Juros Mês 10' => 10,
                'Juros Total' => 550
            ],
            $calculadora->calcularAmortizacao(1000, 0.1, 10, 'SAC')
        );
    }

    public function testCalcularAmortizacaoPrice()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals(
            [
                'Parcela de Amortização 1' => 62.75,
                'Juros Mês 1' => 100,
                'Parcela de Amortização 2' => 69.02,
                'Juros Mês 2' => 93.73,
                'Parcela de Amortização 3' => 75.92,
                'Juros Mês 3' => 86.82,
                'Parcela de Amortização 4' => 83.51,
                'Juros Mês 4' => 79.23,
                'Parcela de Amortização 5' => 91.87,
                'Juros Mês 5' => 70.88,
                'Parcela de Amortização 6' => 101.05,
                'Juros Mês 6' => 61.69,
                'Parcela de Amortização 7' => 111.16,
                'Juros Mês 7' => 51.59,
                'Parcela de Amortização 8' => 122.27,
                'Juros Mês 8' => 40.47,
                'Parcela de Amortização 9' => 134.5,
                'Juros Mês 9' => 28.25,
                'Parcela de Amortização 10' => 147.95,
                'Juros Mês 10' => 14.8,
                'Juros Total' => 627.45
            ],
            $calculadora->calcularAmortizacao(1000, 0.1, 10, 'Price')
        );
    }

    public function testCalcularAmortizacaoComValorInvalido()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals('Tipo de Amortização Inválido'      , $calculadora->calcularAmortizacao(1000, 0.1, 10, 'teste'));       //Tipo de amortização errada
        $this->assertEquals('Valores Inválidos'                 , $calculadora->calcularAmortizacao('a', 'a', 'a', 'Price'));       //Capital inicial, taxa de juros e tempo string não numérica
        $this->assertEquals('Valores não podem ser negativos'   , $calculadora->calcularAmortizacao(-1000, -0.1, -10, 'SAC'));      //Capital inicial, taxa de juros e tempo negativos
        $this->assertEquals('Tempo deve ser um número inteiro'  , $calculadora->calcularAmortizacao(1000, 0.1, 10.5, 'Price'));     //Tempo não inteiro
    }
}