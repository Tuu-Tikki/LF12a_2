<?php

class RequestController {
     
    public function getEnergyData($beginDate, $endDate) {
        $chart = new Chart();
        $intervals = $this->datesWithMaxDaysInterval($beginDate, $endDate);
        $energyData = [];
        foreach($intervals as $dates) {
            $rawData = $chart->getData($dates['begin'], $dates['end']) ?? [];
            $this->rawDataArrayToEnergyArray($rawData, $energyData);        
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
    
    public function datesWithMaxDaysInterval($beginDate, $endDate) {
        $end = strtotime ($endDate);
        $begin = strtotime($beginDate);
        $intervalBegin = $begin;
        $intervalEnd = 0;
        $intervals = [];
        do {
            $intervalEnd = ($intervalBegin + MAXDAYS*86400) < $end ? ($intervalBegin + MAXDAYS*86400) : $end;
            $intervals[] = ['begin' => date("d.m.Y", $intervalBegin), 'end' => date("d.m.Y", $intervalEnd)];
            $intervalBegin += (MAXDAYS+1)*86400;
        }
        while ($intervalEnd < $end);
        
        return $intervals;
    }
    
    public function rawDataArrayToEnergyArray($rawData, &$energyData) {
        foreach ($rawData as $dataByType) {
            $energyBunchByType = Energy::createFromRawData($dataByType);
            if (!empty($energyBunchByType)) {
                array_push($energyData, $energyBunchByType);
            }
        } 
    }
}
