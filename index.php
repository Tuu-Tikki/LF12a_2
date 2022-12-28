<?php

require_once 'load.php';

$errorMessage = "";

if (!empty($_POST)) {
    if (!(empty($_POST['beginDate']) || empty($_POST['endDate']))) {
        $requestController = new RequestController($_POST['beginDate'], $_POST['endDate']);
        $data = $requestController->getEnergyData();
        if (is_null($data)) {
            $errorMessage = "Keine Daten für den angegebenen Zeitraum: [" . $_POST['beginDate']
                    . "] - [" . $_POST['endDate'] . "]";
        } else {
            foreach ($data as $energyBunchByType) {
                $requestController->saveEnergyData($energyBunchByType);
            }
        }
    }
} 

$tableController = new EnergyDataTableController();
$rowCount = $tableController->getRowCount();
$dataList = $tableController->getTableData();

require_once 'views/main.php';
