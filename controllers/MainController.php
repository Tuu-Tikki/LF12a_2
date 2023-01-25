<?php

$message = "";

if (RequestController::isRequestSubmitted()) {
    $request = new RequestController();
    $beginDate = $_POST['beginDate'];
    $endDate = $_POST['endDate'];
    
    $data = $request->getEnergyData($beginDate, $endDate);
    $message = $request->resultMessage($data, $beginDate, $endDate);

    foreach ($data as $energyBunchByType) {
        $request->saveEnergyData($energyBunchByType);
    }
} 

$tableController = new EnergyDataTableController();
$rowCount = $tableController->getRowCount();
$dataList = $tableController->getTableData();

require_once __DIR__.'\..\views\main.php';

