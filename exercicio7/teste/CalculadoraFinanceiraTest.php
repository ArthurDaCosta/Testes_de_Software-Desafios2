<?php

use PHPUnit\Framework\TestCase;
require_once 'CalculadoraFinanceira.php';

class CalculadoraFinanceiraTest extends TestCase
{
    public function testCalcularJurosSimples()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals(2000    , $calculadora->calcularJurosSimples(1000, 0.2, 10));   //Juros simples
        $this->assertEquals(0       , $calculadora->calcularJurosSimples(0, 0.2, 10));      //Capital inicial zero
        $this->assertEquals(0       , $calculadora->calcularJurosSimples(1000, 0, 10));     //Taxa de juros zero
        $this->assertEquals(0       , $calculadora->calcularJurosSimples(1000, 0.2, 0));    //Tempo zero
        $this->assertEquals(0       , $calculadora->calcularJurosSimples(0, 0, 0));         //Capital inicial, taxa de juros e tempo zero
    }

    public function testCalcularJurosSimplesComValorInvalido()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples('a', 0.2, 10));        //Capital inicial não numérico
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(1000, 'a', 10));       //Taxa de juros não numérica
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(1000, 0.2, 'a'));      //Tempo não numérico
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples('a', 'a', 'a'));       //Capital inicial, taxa de juros e tempo não numéricos
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(null, 0.2, 10));       //Capital inicial null
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(1000, null, 10));      //Taxa de juros null
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(1000, 0.2, null));     //Tempo null
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(null, null, null));    //Capital inicial, taxa de juros e tempo null
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(false, 0.2, 10));      //Capital inicial bool
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(1000, false, 10));     //Taxa de juros bool
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(1000, 0.2, true));     //Tempo bool
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(true, true, false));   //Capital inicial, taxa de juros e tempo bool
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(-1000, 0.2, 10));      //Capital inicial negativo
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(1000, -0.2, 10));      //Taxa de juros negativa
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(1000, 0.2, -10));      //Tempo negativo
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosSimples(-1000, -0.2, -10));    //Capital inicial, taxa de juros e tempo negativos

    }

    public function testCalcularJurosCompostos()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals(5191.74 , $calculadora->calcularJurosCompostos(1000, 0.2, 10)); //Juros compostos
        $this->assertEquals(0       , $calculadora->calcularJurosCompostos(0, 0.2, 10));    //Capital inicial zero
        $this->assertEquals(0       , $calculadora->calcularJurosCompostos(1000, 0, 10));   //Taxa de juros zero
        $this->assertEquals(0       , $calculadora->calcularJurosCompostos(1000, 0.2, 0));  //Tempo zero
        $this->assertEquals(0       , $calculadora->calcularJurosCompostos(0, 0, 0));       //Capital inicial, taxa de juros e tempo zero
    }

    public function testCalcularJurosCompostosComValorInvalido()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos('a', 0.2, 10));      //Capital inicial string não numérica
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(1000, 'a', 10));     //Taxa de juros string não numérica
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(1000, 0.2, 'a'));    //Tempo string não numérica
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos('a', 'a', 'a'));     //Capital inicial, taxa de juros e tempo string não numérica
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(null, 0.2, 10));     //Capital inicial null
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(1000, null, 10));    //Taxa de juros null
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(1000, 0.2, null));   //Tempo null
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(null, null, null));  //Capital inicial, taxa de juros e tempo null
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(false, 0.2, 10));    //Capital inicial bool
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(1000, false, 10));   //Taxa de juros bool
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(1000, 0.2, true));   //Tempo bool
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(true, true, false)); //Capital inicial, taxa de juros e tempo bool
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(-1000, 0.2, 10));    //Capital inicial negativo
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(1000, -0.2, 10));    //Taxa de juros negativa
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(1000, 0.2, -10));    //Tempo negativo
        $this->assertEquals('Valores Inválidos' , $calculadora->calcularJurosCompostos(-1000, -0.2, -10));  //Capital inicial, taxa de juros e tempo negativos
    }

    public function testCalcularAmortizacaoSAC()
    {
        $calculadora = new CalculadoraFinanceira();
        $this->assertEquals(
            [
                'Total de Juros Pagos' => 100,
                'Parcela de Amortização 1' => 120,
                'Parcela de Amortização 2' => 120,
                'Parcela de Amortização 3' => 120,
                'Parcela de Amortização 4' => 120,
                'Parcela de Amortização 5' => 120,
                'Parcela de Amortização 6' => 120,
                'Parcela de Amortização 7' => 120,
                'Parcela de Amortização 8' => 120,
                'Parcela de Amortização 9' => 120,
            ],
            $calculadora->calcularAmortizacao(1000, 0.1, 10, 'SAC')
        );
    }
}