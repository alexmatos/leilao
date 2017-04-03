<?php

class Leilao {

    private $descricao;
    private $lances;

    function __construct($descricao) {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function propoe(Lance $lance) {
        if (count($this->lances) == 0 || $this->podeDarLance($lance->getUsuario())) {
            $this->lances[] = $lance;
        }
    }

    public function dobraLance(Usuario $usuario) {
        if ($this->existeLanceDe($usuario) && $this->podeDarLance($usuario)) {
            $valorUltimoLance = $this->valorUltimoLance($usuario);
            $this->lances[] = new Lance($usuario, 2 * $valorUltimoLance);
        }
    }

    private function valorUltimoLance(Usuario $usuario) {
        $lances = $this->getLances();
        $i = count($lances) - 1;
        do {
            if($lances[$i]->getUsuario() == $usuario) {
                return $lances[$i]->getValor();
            }
        } while(--$i >= 0);
    }
    
    private function existeLanceDe($usuario) {
        foreach ($this->getLances() as $lance) {
            if($lance->getUsuario() == $usuario) {
                return true;
            }
        }
        return false;
    }
    
    private function podeDarLance(Usuario $usuario) {
        return $this->ultimoLanceDado()->getUsuario()->getNome() != $usuario->getNome() 
                && $this->qtdDelancesDo($usuario) < 5;
    }

    private function qtdDelancesDo(Usuario $usuario) {
        $total = 0;
        foreach ($this->lances as $lance) {
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