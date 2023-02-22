<?php

use PHPUnit\Framework\TestCase;
include_once '../load.php';

class DatabaseTableWerteTest extends TestCase {
    /** @test */
    public function getAllShouldReturnArray() {     
        $this->assertIsArray(DatabaseTableWerte::getAll());
    }
      
    /** @test*/
    public function getEnergyDataShouldReturnArray() {
        $this->assertIsArray(DatabaseTableWerte::getLastEnergyData());
    }
    
    /** @test */
    public function getRowCountShouldReturnNumber() {
        $this->assertIsNumeric(DatabaseTableWerte::getRowCount());
    }
    
    /** @test */
    public function isValueNotExistShouldReturnFalse() {
        $energy = new Energy(36, "9672318800000", 509.5);
        $this->assertFalse(DatabaseTableWerte::isValueExist($energy));
    }
}
