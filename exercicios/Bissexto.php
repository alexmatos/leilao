<?php

class Bissexto {

    public function ehBissexto($ano) {

        if (($ano % 400 == 0) || (($ano % 4 == 0) && ($ano % 100 != 0)))
            return true;
        return false;
    }

}
