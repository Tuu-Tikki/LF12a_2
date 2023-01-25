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
}

