<?php

/**
 * Description of BissextoTest
 *
 * @author alex.matos
 */

require "../exercicios/Bissexto.php";

class BissextoTest extends PHPUnit_Framework_TestCase {
    
    public function testEhBissexto() {
        $bissexto = new Bissexto();
        $this->assertFalse($bissexto->ehBissexto(2017));
        $this->assertTrue($bissexto->ehBissexto(2020));
    }
}
