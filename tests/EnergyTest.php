<?php

use PHPUnit\Framework\TestCase;
include_once '../load.php';

class EnergyTest extends TestCase{
    /** @test */
    public function getDateTime() { 
        $row = new Energy(1, "1668391200000", 5);
        $this->assertEquals("2022-11-14 03:00:00", $row->getDateTime());
    } 
    
    /** @test */
    public function createFromRawData() {
        $rawData = ["id" => "solar", "name" => "Solar", "legendIndex" => 20, 
            "index" => 40, "type" => "area", "color" => "rgb(255, 215, 68)", "connectNulls" => false, 
            "yAxis" => 0, "data" => [[1671318000000, 0], [1671321600000, 0]]];
        $energyArr = Energy::createFromRawData($rawData);
        $this->assertIsArray($energyArr);
    }
}
 