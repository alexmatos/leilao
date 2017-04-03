<?php

/**
 * Description of FiltroDeLancesTest
 *
 * @author alex.matos
 */

require '../FiltroDeLances.php';
require '../Leilao.php';
require '../Lance.php';
require '../Avaliador.php';
require '../Usuario.php';

class FiltroDeLancesTest extends PHPUnit_Framework_TestCase {

    public function testDeveSelecionarLancesEntre1000E3000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao, 2000);
        $lances[] = new Lance($joao, 1000);
        $lances[] = new Lance($joao, 3000);
        $lances[] = new Lance($joao, 800);

        $resultado = $filtro->filtra($lances);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(2000, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesEntre500E700() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao, 600);
        $lances[] = new Lance($joao, 500);
        $lances[] = new Lance($joao, 700);
        $lances[] = new Lance($joao, 800);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(1, count($resultado));
        $this->assertEquals(600, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesMaioresQue5000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao, 4000);
        $lances[] = new Lance($joao, 4500);
        $lances[] = new Lance($joao, 5000);
        $lances[] = new Lance($joao, 8000);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(1, count($resultado));
        $this->assertEquals(8000, $resultado[0]->getValor(), 0.00001);
    }
    
    public function testDeveRetornarListaVazia() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao, 4000);
        $lances[] = new Lance($joao, 200);
        $lances[] = new Lance($joao, 5000);
        $lances[] = new Lance($joao, 800);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(0, count($resultado));
    }

}
