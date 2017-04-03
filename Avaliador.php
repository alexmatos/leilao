<?php

/**
 * Description of Avaliador
 *
 * @author alex.matos
 */
class Avaliador {

    private $maiorDeTodos = -INF;
    private $menorDeTodos = INF;
    private $mediaDeLances = 0;
    private $maiores;

    public function avalia(Leilao $leilao) {

        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorDeTodos) {
                $this->maiorDeTodos = $lance->getValor();
            }
            if ($lance->getValor() < $this->menorDeTodos) {
                $this->menorDeTodos = $lance->getValor();
            }
            $this->mediaDeLances += $lance->getValor();
        }
        $nLances = count($leilao->getLances());
        if($nLances > 0) {
            $this->mediaDeLances /= $nLances;
        }
        $this->getTresMaioresNo($leilao);
    }

    private function getTresMaioresNo(Leilao $leilao) {
        $lances = $leilao->getLances();

        usort($lances, function ($a, $b) {
            if ($a->getValor() == $b->getValor()) {
                return 0;
            }
            return ($a->getValor() < $b->getValor()) ? 1 : -1;
        });

        $this->maiores = array_slice($lances, 0, 3);
    }

    public function getMaiorLance() {
        return $this->maiorDeTodos;
    }

    public function getMenorLance() {
        return $this->menorDeTodos;
    }

    public function getMediaLances() {
        return $this->mediaDeLances;
    }

    public function getTresMaiores() {
        return $this->maiores;
    }

}
