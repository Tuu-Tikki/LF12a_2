<?php

use PHPUnit\Framework\TestCase;
include_once '../load.php';

class ChartTest extends TestCase {
    
    private $url = 'chart.json';
     
    /** @test */
    public function parseJson() {     
        $chart = new Chart($this->url);
        $this->assertNotNull($chart->parseJson());
    }

    /** @test */
    public function getAnswer() {
        $chart = new Chart($this->url);
        $this->assertIsString($chart->getAnswer('chart.json'));
    }
    
    /** @test */
    public function createUrl() {
        $begin = '11.11.2022';
        $end = $begin;
        $url = Chart::createUrl($begin, $end);
        $this->assertIsString($url);
    }
}

