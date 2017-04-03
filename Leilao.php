<?php

class Leilao {

    private $descricao;
    private $lances;

    function __construct($descricao) {
        $this->descricao = $descricao;
        $this->lances = array();
    }

    public function propoe(Lance $lance) {
        if (count($this->lances) == 0 || $this->podeDarLance($lance->getUsuario())) {
            $this->lances[] = $lance;
        }
    }

    private function podeDarLance(Usuario $usuario) {
        return !$this->ultimoLanceDado()->getUsuario()->getNome() == $usuario->getNome() 
                && $this->qtdDelancesDo($usuario) < 5;
    }

    private function qtdDelancesDo(Usuario $usuario) {
        $total = 0;
        foreach ($lances as $lance) {
            if ($lance->getUsuario()->getNome() == $usuario->getNome())
                $total++;
        }
        return $total;
    }

    private function ultimoLanceDado() {
        return $this->lances[count($this->lances) - 1];
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getLances() {
        return $this->lances;
    }

}

?>