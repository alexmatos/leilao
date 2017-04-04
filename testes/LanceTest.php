<?php

/**
 * Description of LanceTest
 *
 * @author alex.matos
 */

require '../Lance.php';
require '../Usuario.php';

class LanceTest extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testLanceNegativo() {
        $lance = new Lance(new Usuario("João"), -5);
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testLanceIgualZero() {
        $lance = new Lance(new Usuario("João"), 0);
    }

}
