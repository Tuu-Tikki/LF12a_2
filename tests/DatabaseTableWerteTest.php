<?php

use PHPUnit\Framework\TestCase;
include_once '../load.php';

class DatabaseTableWerteTest extends TestCase {
    /** @test */
    public function getAll() {     
        $this->assertIsArray(Database::getAll());
    }
    
//    /** @test */
//    public function write() {     
//        $this->assertEquals(1, Database::write(new Energy(1, "1662391100000", 1)));
//    }
    
    /** @test*/
    public function getEnergyData() {
        $this->assertIsArray(Database::getEnergyData(2));
    }
    
    /** @test */
    public function getRowCount() {
        $this->assertEquals(315, Database::getRowCount());
    }
    
    /** @test */
    public function isValueExist() {
        $energy = new Energy(6, "1672318800000", 509.5);
        $this->assertFalse(Database::isValueExist($energy));
    }
}
