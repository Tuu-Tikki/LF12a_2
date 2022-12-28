<?php

class RequestController {
    private String $url;
    private Chart $chart;
    function __construct($beginDate, $endDate) {
        $this->url = Chart::createUrl($beginDate, $endDate);
        $this->chart = new Chart($this->url);
    }
    
    public function getEnergyData() {
        $rawData = $this->chart->parseJson();
        $energyData = [];
        if (is_null($rawData)) {
            return null;
        }
        foreach ($rawData as $dataByType) {
            $energyBunchByType = Energy::createFromRawData($dataByType);
            if (!is_null($energyBunchByType)) {
                array_push($energyData, $energyBunchByType);
            }
        }
        return empty($energyData) ? null : $energyData;
    }
    
    public function saveEnergyData($energyData) {
        foreach ($energyData as $energy) {
            if (!Database::isValueExist($energy)) {
                Database::write($energy);
            }
        }
    }
}
