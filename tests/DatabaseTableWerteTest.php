<?php

use PHPUnit\Framework\TestCase;
include_once '../load.php';

class DatabaseTableWerteTest extends TestCase {    
    /** @test*/
    public function getEnergyDataShouldReturnArray() {
        $this->assertIsArray(DatabaseTableWerte::getLastEnergyData());
    }
    
    /** @test */
    public function getRowCountShouldReturnNumber() {
        $this->assertIsNumeric(DatabaseTableWerte::getRowCount());
    }
    
    /** @test */
    public function getTimeFramesForDatabaseEntriesShouldReturnArray() {
        $dates = DatabaseTableWerte::getTimeFramesForDatabaseEntries();
        $this->assertIsArray($dates);
    }
}
