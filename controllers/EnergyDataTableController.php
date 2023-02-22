<?php

class EnergyDataTableController {
    public function getTableData() {
        $rawData = DatabaseTableWerte::getLastEnergyData();
        $table = [];
        foreach ($rawData as $entry) {
            $row[0] = $entry['datumzeit'];
            $row[1] = $entry['titel'];
            $row[2] = $entry['wert'];
            $row[3] = $entry['einheit'];
            $table[] = $row;
        }
        return $table;
    }
    
    public function getRowCount() {
        return DatabaseTableWerte::getRowCount();
    }
}
