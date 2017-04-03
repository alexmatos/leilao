<?php

/**
 * Description of MatematicaMalucaTest
 *
 * @author alex.matos
 */

require "../MatematicaMaluca.php";

class MatematicaMalucaTest extends PHPUnit_Framework_TestCase {
    
    public function testNumeroMenorQueDez(){
        $calc = new MatematicaMaluca();
        $this->assertEquals(8, $calc->contaMaluca(4));
    }
    
    public function testNumeroIgualDez(){
        $calc = new MatematicaMaluca();
        $this->assertEquals(20, $calc->contaMaluca(10));
    }
    
    public function testNumeroEntreDezETrinta(){
        $calc = new MatematicaMaluca();
        $this->assertEquals(60, $calc->contaMaluca(20));
    }
    
    public function testNumeroIgualATrinta(){
        $calc = new MatematicaMaluca();
        $this->assertEquals(90, $calc->contaMaluca(30));
    }
    
    public function testNumeroMaiorQueTrinta(){
        $calc = new MatematicaMaluca();
        $this->assertEquals(160, $calc->contaMaluca(40));
    }
    
    public function testNumeroMuitoGrande(){
        $calc = new MatematicaMaluca();
        $this->assertEquals(4000000000, $calc->contaMaluca(1000000000));
    }
    public function testNumeroMuitoPequeno(){
        $calc = new MatematicaMaluca();
        $this->assertEquals(-2000000000, $calc->contaMaluca(-1000000000));
    }
        
}
