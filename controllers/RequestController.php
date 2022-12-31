<?php

class RequestController {
       
    public function getEnergyData($beginDate, $endDate) {
        $chart = new Chart();
        $rawData = $chart->getData($beginDate, $endDate);
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
            if (!DatabaseTableWerte::isValueExist($energy)) {
                DatabaseTableWerte::write($energy);
            }
        }
    }
    
    public function isSubmitted() {
        return !(empty($_POST['beginDate']) || empty($_POST['endDate']));
    }
}
