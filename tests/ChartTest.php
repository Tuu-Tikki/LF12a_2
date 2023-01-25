<?php

use PHPUnit\Framework\TestCase;
include_once '../load.php';

class ChartTest extends TestCase {
    
    private $url = 'chart.json';
     
    /** @test */
    public function parseJsonShouldReturnArray() { 
        $this->assertIsArray(Chart::parseJson(@file_get_contents($this->url)));
    }
    
    /** 
     * @test
     * @dataProvider dateDataProvider 
    */
    public function createUrlShouldReturnUrl($begin, $end) {
        $url = Chart::createUrl($begin, $end);
        $this->assertEquals(URL['beginning'] . '20.11.2022/20.12.2022' . URL['end'],$url);
    }
    
    public function dateDataProvider(): array {
        return [
                ['begin' => '20.11.2022', 'end' => '20.12.2022'],
                ['begin' => '20-11-2022', 'end' => '20-12-2022'],
                ['begin' => '2022-11-20', 'end' => '2022-12-20']
        ];
    }
}

