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

class AvaliadorTest extends PHPUnit_Framework_TestCase {

    public function testAceitaLeilaoComUmLance() {

        $joao = new Usuario("Joao");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 250));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $this->assertEquals(1, count($leilao->getLances()));
        $this->assertEquals(250, $leiloeiro->getMaiorLance());
        $this->assertEquals(250, $leiloeiro->getMenorLance());
    }

    public function testAceitaLeilaoEmOrdemCrescente() {

        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 250));
        $leilao->propoe(new Lance($renan, 350));
        $leilao->propoe(new Lance($felipe, 400));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $this->assertEquals(400, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals(250, $leiloeiro->getMenorLance(), 0.0001);
        $this->assertEquals(333.33, round($leiloeiro->getMediaLances(), 2), 0.0001);
    }

    public function testAceitaLeilaoEmOrdemDecrescente() {

        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 400));
        $leilao->propoe(new Lance($renan, 300));
        $leilao->propoe(new Lance($felipe, 200));
        $leilao->propoe(new Lance($joao, 100));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $this->assertEquals(400, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals(100, $leiloeiro->getMenorLance(), 0.0001);
    }

    public function testAceitaLeilaoEmOrdemAleatoria() {

        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 200));
        $leilao->propoe(new Lance($renan, 450));
        $leilao->propoe(new Lance($felipe, 120));
        $leilao->propoe(new Lance($joao, 700));
        $leilao->propoe(new Lance($renan, 630));
        $leilao->propoe(new Lance($felipe, 230));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $this->assertEquals(700, $leiloeiro->getMaiorLance(), 0.00001);
        $this->assertEquals(120, $leiloeiro->getMenorLance(), 0.00001);
    }

    public function testLeilaoComCincoLancesPegaOsTresMaiores() {

        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 250));
        $leilao->propoe(new Lance($renan, 300));
        $leilao->propoe(new Lance($felipe, 400));
        $leilao->propoe(new Lance($renan, 450));
        $leilao->propoe(new Lance($felipe, 500));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        $maiores = $leiloeiro->getTresMaiores();

        $this->assertEquals(3, count($maiores));
        $this->assertEquals(500, $maiores[0]->getValor());
        $this->assertEquals(450, $maiores[1]->getValor());
        $this->assertEquals(400, $maiores[2]->getValor());
    }

    public function testLeilaoComDoisLancesPegaOsDoisMaiores() {

        $leilao2 = new Leilao("Smartphone");

        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");

        $leilao2->propoe(new Lance($joao, 250));
        $leilao2->propoe(new Lance($renan, 300));

        $leiloeiro2 = new Avaliador();
        $leiloeiro2->avalia($leilao2);
        $maiores2 = $leiloeiro2->getTresMaiores();

        $this->assertEquals(2, count($maiores2));
        $this->assertEquals(300, $maiores2[0]->getValor());
        $this->assertEquals(250, $maiores2[1]->getValor());
    }

    public function testLeilaoSemLanceDevolveListaVazia() {

        $leilao = new Leilao("Smartphone");

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        $maiores = $leiloeiro->getTresMaiores();

        $this->assertEquals(0, count($maiores));
    }

}
