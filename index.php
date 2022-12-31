<?php

require_once 'load.php';

$db = new DatabaseEnergiedaten();
if (!$db->isExist()) {
    $db->create();
}

$errorMessage = "";

$request = new RequestController();
if ($request->isSubmitted()) {
    $data = $request->getEnergyData($_POST['beginDate'], $_POST['endDate']);
    if (is_null($data)) {
        $errorMessage = "Keine Daten für den angegebenen Zeitraum: [" . 
                        $_POST['beginDate'] . "] - [" . $_POST['endDate'] . "]";
    } else {
        foreach ($data as $energyBunchByType) {
            $request->saveEnergyData($energyBunchByType);
        }
    }
} 

$tableController = new EnergyDataTableController();
$rowCount = $tableController->getRowCount();
$dataList = $tableController->getTableData();

require_once 'views/main.php';
