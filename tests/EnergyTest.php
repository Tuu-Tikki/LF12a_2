<?php

use PHPUnit\Framework\TestCase;
include_once '../load.php';

class EnergyTest extends TestCase {
    /** @test */
    public function datetimeAttributeShouldBeDateTimeString() { 
        $row = new Energy(1, "1668391200000", 5);
        $this->assertEquals("2022-11-14 03:00:00", $row->getDateTime());
    } 
    
    /** 
     * @test
     * @dataProvider validRawDataProvider 
    */
    public function isDataValidShoudReturnTrue($rawData) {
        $this->assertTrue(Energy::isDataValid($rawData));
    }
    
    /** 
     * @test
     * @dataProvider invalidRawDataProvider 
    */
    public function isDataValidShoudReturnFalse($rawData) {
        $this->assertFalse(Energy::isDataValid($rawData));
    }
    
    /** 
     * @test
     * @dataProvider validRawDataProvider 
    */
    public function createFromRawDataShouldReturnArrayOfEnergy($rawData) {
        $energyArr = Energy::createFromRawData($rawData);
        $this->assertContainsOnlyInstancesOf(Energy::class, $energyArr);
    }
    
    public function validRawDataProvider(): array {
        return [
                'valid' => [["id" => "solar", "name" => "Solar", "legendIndex" => 20, 
                            "index" => 40, "type" => "area", "color" => "rgb(255, 215, 68)",
                            "connectNulls" => false, "yAxis" => 0, 
                            "data" => [[1671318000000, 10.5], [1671321600000, 0]]]]
               ];
    }
    
    public function invalidRawDataProvider(): array {
        return [
                'invalid' => [["name" => "Solar", "legendIndex" => 20, 
                               "index" => 40, "type" => "area", "color" => "rgb(255, 215, 68)",
                               "connectNulls" => false, "yAxis" => 0, 
                               "data" => [[1671318000000, 10.5], [1671321600000, 0]]],
                              ["id" => "solar", "name" => "Solar", "legendIndex" => 20, 
                              "index" => 40, "type" => "area", "color" => "rgb(255, 215, 68)",
                              "connectNulls" => false, "yAxis" => 0, 
                              "values" => [[1671318000000, 10.5], [1671321600000, 0]]],
                              ["id" => "notExistedType", "name" => "Solar", "legendIndex" => 20, 
                               "index" => 40, "type" => "area", "color" => "rgb(255, 215, 68)",
                               "connectNulls" => false, "yAxis" => 0, 
                               "data" => [[1671318000000, 10.5], [1671321600000, 0]]]
                             ]
               ];
    }
}
 