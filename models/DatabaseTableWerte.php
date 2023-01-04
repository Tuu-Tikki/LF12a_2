<?php

class DatabaseTableWerte {

    public static function getAll() {
        $pdo = self::setPDO();
        return $pdo->query("SELECT * FROM werte JOIN kennwerte ON werte.kennwertIdf=kennwerte.id ORDER BY unixzeitstempel DESC")
                ->fetchAll();
    }
    
    public static function getEnergyData($amount) {
        $pdo = self::setPDO();
        $sql = "SELECT * FROM werte JOIN kennwerte ON werte.kennwertIdf=kennwerte.id ORDER BY unixzeitstempel DESC LIMIT " . $amount;
        return $pdo->query($sql)->fetchAll();
    }
    
    public static function write(Energy $energyData) {
        $pdo = self::setPDO();
        $sql = "INSERT INTO werte(kennwertIdf, unixzeitstempel, datumzeit, wert) VALUES(:idf, :timestamp, :datetime, :value)";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute([":idf" => $energyData->getType(), ":timestamp" => $energyData->getTimeStamp(), ":datetime" => $energyData->getDateTime(), ":value" => $energyData->getValue()]);
    }
    
    public static function isValueExist(Energy $energyData) {
        $pdo = self::setPDO();
        $sql = "SELECT * FROM werte WHERE kennwertIdf=:idf AND unixzeitstempel=:timestamp AND wert=:value";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute([":idf" => $energyData->getType(), ":timestamp" => $energyData->getTimeStamp(), ":value" => $energyData->getValue()]);
        return $statement->fetchColumn();
    }
    
    private static function setPDO() {
        $dsn = 'mysql:dbname='.DB.';host='.HOST;
        return new PDO($dsn, USER, PASSWORD);  
    }
    
    public static function getRowCount() {
        $pdo = self::setPDO();
        return (int)$pdo->query('SELECT COUNT(*) FROM werte')->fetchColumn(); 
    }
}
