<?php

class DatabaseTableWerte {
    
    private static function setPDO() {
        $dsn = 'mysql:dbname='.DB.';host='.HOST;
        return new PDO($dsn, USER, PASSWORD);  
    }

    public static function getLastEnergyData() {
        $pdo = self::setPDO();
        $sql = "SELECT * FROM werte JOIN kennwerte ON werte.kennwertIdf=kennwerte.id "
                . "WHERE unixzeitstempel > (SELECT MAX(werte.unixzeitstempel) FROM werte)-86400000 "
                . " ORDER BY kennwertIdf, unixzeitstempel DESC";
        return $pdo->query($sql)->fetchAll();
    }

    public static function writeBunch($energyDataBunch) {
        $pdo = self::setPDO();
        $sql = "INSERT IGNORE INTO werte (kennwertIdf, unixzeitstempel, datumzeit, wert) VALUES ";
        foreach ($energyDataBunch as $key => $energy) {
            $sql = $sql . "('" . $energy->getType() . "', '" . $energy->getTimeStamp() .
                    "', '" . $energy->getDateTime() . "', '" . $energy->getValue() . "')";
            if (!($key === array_key_last($energyDataBunch))) {
                $sql = $sql . ", ";
            }
        }

        $result = $pdo->query($sql);
    }
       
    public static function getRowCount() {
        $pdo = self::setPDO();
        return (int)$pdo->query('SELECT COUNT(*) FROM werte')->fetchColumn(); 
    }
    
    public static function getTimeFramesForDatabaseEntries() {
        $pdo = self::setPDO();
        $sql = "SELECT * FROM werte GROUP BY unixzeitstempel ASC";
        $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $dates = [];
        $begin = null;
        $end = null;
        foreach ($result as $row) {
            $begin = $begin ?? $row['unixzeitstempel']/1000;
            $end = $end ?? $row['unixzeitstempel']/1000;
            if ($end != ($row['unixzeitstempel']/1000 - 3600) && $end > $begin) {
                $date = [date("Y-m-d H:i:s",$begin), date("Y-m-d H:i:s",$end)];
                $dates[] = $date;
                $end = null;
                $begin = null;
            } else {
                $end = $row['unixzeitstempel']/1000;
            }            
        }
        $dates[] = [date("Y-m-d H:i:s",$begin), date("Y-m-d H:i:s",$end)];
        return $dates;
    }
}
