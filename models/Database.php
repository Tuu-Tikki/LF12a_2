<?php

class Database {

    public static function getAll() {
        $pdo = Database::setPDO();
        return $pdo->query("SELECT * FROM werte JOIN kennwerte ON werte.kennwertIdf=kennwerte.id ORDER BY unixzeitstempel DESC")
                ->fetchAll();
    }
    
    public static function getEnergyData($amount) {
        $pdo = Database::setPDO();
        $sql = "SELECT * FROM werte JOIN kennwerte ON werte.kennwertIdf=kennwerte.id ORDER BY unixzeitstempel DESC LIMIT " . $amount;
        return $pdo->query($sql)->fetchAll();
    }
    
    public static function write(Energy $energyData) {
        $pdo = Database::setPDO();
        $sql = "INSERT INTO werte(kennwertIdf, unixzeitstempel, datumzeit, wert) VALUES(:idf, :timestamp, :datetime, :value)";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute([":idf" => $energyData->getType(), ":timestamp" => $energyData->getTimeStamp(), ":datetime" => $energyData->getDateTime(), ":value" => $energyData->getValue()]);
        return $statement->rowCount();
    }
    
    public static function isValueExist(Energy $energyData) {
        $pdo = Database::setPDO();
        $sql = "SELECT * FROM werte WHERE kennwertIdf=:idf AND unixzeitstempel=:timestamp";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute([":idf" => $energyData->getType(), ":timestamp" => $energyData->getTimeStamp()]);
        return $statement->fetchColumn();
    }
    
    private static function setPDO() {
        $dsn = 'mysql:dbname='.DB.';host='.HOST;
        return new PDO($dsn, USER, PASSWORD);  
    }
    
    public static function isExist() {
        $dsn = 'mysql:host='.HOST;
        $pdo = new PDO($dsn, ADMIN, ADMINPASS);
        $sql = "SHOW DATABASES LIKE '".DB."'";
        return !empty($pdo->query($sql)->fetch());
    }
    
    public static function getRowCount() {
        $pdo = Database::setPDO();
        return (int)$pdo->query('SELECT COUNT(*) FROM werte')->fetchColumn(); 
    }
    
    public static function create() {
        $dsn = 'mysql:host='.HOST;
        $pdo = new PDO($dsn, ADMIN, ADMINPASS);
        $sql = file_get_contents(DIR.'models\energiedaten.sql');
        $pdo->query($sql);
        $sql = 'CREATE USER `' . USER . '`@`' . HOST . '` IDENTIFIED BY "energieDatenLF12";
                GRANT SELECT, INSERT, UPDATE, DELETE ON `energiedaten`.* TO `' . USER . '`@`' . HOST . '`;
                FLUSH PRIVILEGES;';
        $pdo->query($sql);
    }
}
