<?php

class RequestController {
     
    public function getEnergyData($beginDate, $endDate) {
        $chart = new Chart();
        $rawData = $chart->getData($beginDate, $endDate) ?? [];
        $energyData = [];
        foreach ($rawData as $dataByType) {
            $energyBunchByType = Energy::createFromRawData($dataByType);
            if (!empty($energyBunchByType)) {
                array_push($energyData, $energyBunchByType);
            }
        }
        return $energyData;
    }
    
    public function saveEnergyData($energyDataBunch) {
        if (!empty($energyDataBunch)) {
            DatabaseTableWerte::writeBunch($energyDataBunch);
        }
    }
    
    public static function isRequestSubmitted() {
        return !(empty($_POST['beginDate']) || empty($_POST['endDate']));
    }
    
    public function resultMessage($data, $beginDate, $endDate) {
        if (empty($data)) {
            return "Keine Daten für den angegebenen Zeitraum: [" . 
                    $beginDate . "] - [" . $endDate . "]";
        } else {
            return "Es gibt " . array_sum(array_map("count", $data)) . " Einträge für den angegebenen Zeitraum: [" . 
                    $beginDate . "] - [" . $endDate . "]";
        }
    }
}
