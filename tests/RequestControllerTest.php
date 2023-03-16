<?php

use PHPUnit\Framework\TestCase;
include_once '../load.php';

class RequestControllerTest extends TestCase {
    
    /** @test */
    public function datesWithMaxDaysIntervalShouldReturnArray() {
        $request = new RequestController();
        $this->assertIsArray($request->datesWithMaxDaysInterval('20-11-2022', '20-12-2022'));
    }
    
    /** @test */
    public function getEnergyDataShoudReturnOnlyEnergyObject() {
        $request = new RequestController();
        $energyArr = $request->getEnergyData('2023-01-01', '2023-01-01');
        $this->assertContainsOnlyInstancesOf(Energy::class, $energyArr[0]);
    }
    
    /** 
     * @test 
     * @dataProvider data
     */
    public function resultMessageShouldReturnString($data) {
        $request = new RequestController();
        $this->assertIsString($request->resultMessage($data, '2023-01-01', '2023-01-01'));
    }
    
    public function data(): array {
        return [['data' => null],
                ['data' => [["id" => "solar", "name" => "Solar", "legendIndex" => 20, 
                            "index" => 40, "type" => "area", "color" => "rgb(255, 215, 68)",
                            "connectNulls" => false, "yAxis" => 0, 
                            "data" => [[1671318000000, 10.5], [1671321600000, 0]]]]]
               ];
    }
       
    /**
     * @test
     * @dataProvider rawData
     */
    public function rawDataArrayToEnergyArrayReturnOnlyEnergyObject($rawData) {
        $energyData = [];
        $request = new RequestController();
        $request->rawDataArrayToEnergyArray($rawData, $energyData);
        $this->assertContainsOnlyInstancesOf(Energy::class, $energyData[0]);
    }
    
    public function rawData(): array {
        return [
                ['rawData' => [["id" => "solar", "name" => "Solar", "legendIndex" => 20, 
                            "index" => 40, "type" => "area", "color" => "rgb(255, 215, 68)",
                            "connectNulls" => false, "yAxis" => 0, 
                            "data" => [[1671318000000, 10.5], [1671321600000, 0]]]]]
               ];
    }
}

