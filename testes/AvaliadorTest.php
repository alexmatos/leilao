<?php

/**
 * Description of AvaliadorTest
 *
 * @author alex.matos
 */
//function autoload($class) {
//    require "../" . $class . ".php";
//}
//
//spl_autoload_register("autoload");

require '../Usuario.php';
require '../Leilao.php';
require '../Lance.php';
require '../Avaliador.php';
require '../CriadorDeLeilao.php';

class AvaliadorTest extends PHPUnit_Framework_TestCase {

    private $leiloeiro;
    private $joao;
    private $jose;
    private $maria;

    public function setUp() {
        $this->leiloeiro = new Avaliador();
        $this->joao = new Usuario("João");
        $this->jose = new Usuario("José");
        $this->maria = new Usuario("Maria");
    }

    /**
     * @expectedException     Exception
     */
    public function testNaoDeveAvaliarLeiloesSemNenhumLanceDado() {
        $criador = new CriadorDeLeilao();
        $leilao = $criador->para("Playstation 3 Novo")->constroi();
        $this->leiloeiro->avalia($leilao);
    }

    public function testAceitaLeilaoComUmLance() {
        $criador = new CriadorDeLeilao();
        $leilao = $criador->para("Playstation 3")->lance($this->joao, 250)->constroi();
        $this->leiloeiro->avalia($leilao);

        $this->assertEquals(1, count($leilao->getLances()));
        $this->assertEquals(250, $this->leiloeiro->getMaiorLance());
        $this->assertEquals(250, $this->leiloeiro->getMenorLance());
    }

    public function testAceitaLeilaoEmOrdemCrescente() {
        $criador = new CriadorDeLeilao();
        $leilao = $criador->para("Playstation 3")->lance($this->joao, 250)
                ->lance($this->maria, 350)->lance($this->jose, 400)
                ->constroi();

        $this->leiloeiro->avalia($leilao);

        $this->assertEquals(400, $this->leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals(250, $this->leiloeiro->getMenorLance(), 0.0001);
        $this->assertEquals(333.33, round($this->leiloeiro->getMediaLances(), 2), 0.0001);
    }

    public function testAceitaLeilaoEmOrdemDecrescente() {
        $criador = new CriadorDeLeilao();
        $leilao = $criador->para("Playstation 3")->lance($this->joao, 400)
                        ->lance($this->maria, 300)->lance($this->jose, 200)
                        ->lance($this->joao, 100)->constroi();

        $this->leiloeiro->avalia($leilao);

        $this->assertEquals(400, $this->leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals(100, $this->leiloeiro->getMenorLance(), 0.0001);
    }

    public function testAceitaLeilaoEmOrdemAleatoria() {
        $criador = new CriadorDeLeilao();
        $leilao = $criador->para("Playstation 3")->lance($this->joao, 200)
                        ->lance($this->maria, 450)->lance($this->jose, 120)
                        ->lance($this->joao, 700)->lance($this->maria, 630)
                        ->lance($this->jose, 230)->constroi();

        $this->leiloeiro->avalia($leilao);

        $this->assertEquals(700, $this->leiloeiro->getMaiorLance(), 0.00001);
        $this->assertEquals(120, $this->leiloeiro->getMenorLance(), 0.00001);
    }

    public function testLeilaoComCincoLancesPegaOsTresMaiores() {
        $criador = new CriadorDeLeilao();
        $leilao = $criador->para("Playstation 3")->lance($this->joao, 250)
                ->lance($this->maria, 300)->lance($this->jose, 400)
                ->lance($this->joao, 450)->lance($this->maria, 500)
                ->constroi();

        $this->leiloeiro->avalia($leilao);
        $maiores = $this->leiloeiro->getTresMaiores();

        $this->assertEquals(3, count($maiores));
        $this->assertEquals(500, $maiores[0]->getValor());
        $this->assertEquals(450, $maiores[1]->getValor());
        $this->assertEquals(400, $maiores[2]->getValor());
    }

    public function testLeilaoComDoisLancesPegaOsDoisMaiores() {
        $criador = new CriadorDeLeilao();
        $leilao = $criador->para("Smartphone")->lance($this->joao, 250)
                        ->lance($this->maria, 300)->constroi();

        $this->leiloeiro->avalia($leilao);
        $maiores2 = $this->leiloeiro->getTresMaiores();

        $this->assertEquals(2, count($maiores2));
        $this->assertEquals(300, $maiores2[0]->getValor());
        $this->assertEquals(250, $maiores2[1]->getValor());
    }

//    public function testLeilaoSemLanceDevolveListaVazia() {
//        $criador = new CriadorDeLeilao();
//        $leilao = $criador->para("Smartphone")->constroi();
//        $this->leiloeiro->avalia($leilao);
//        $maiores = $this->leiloeiro->getTresMaiores();
//        $this->assertEquals(0, count($maiores));
//    }

}
