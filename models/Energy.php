<?php

class Energy {
    
    private int $type;
    private String $timestamp;
    private String $datetime;
    private float $value;
    
    function __construct(int $type, String $timestamp, float $value) {
        $this->type = $type;
        $this->timestamp = $timestamp;
        $this->value = $value;
        $this->datetime = date("Y-m-d H:i:s", $this->timestamp/1000);
    }    
    
    public function getDateTime() {
        return $this->datetime;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function getValue() {
        return $this->value;
    }
    
    public function getTimeStamp() {
        return $this->timestamp;        
    }
    
    public static function createFromRawData($rawData) {
        if (!array_key_exists('id', $rawData)) {
            return null;
        }
        if (!array_key_exists($rawData['id'], ENERGYTYPE)) {
            return null;
        }
        $type = ENERGYTYPE[$rawData['id']];
        if (!array_key_exists('data', $rawData)) {
            return null;
        }
        $data = $rawData['data'];
        $energyBunchByType = [];
        foreach($data as $timeValuePair) {
            $energy = new self($type, $timeValuePair[0], (float)$timeValuePair[1]);
            $energyBunchByType[] = $energy;
        }
        return $energyBunchByType;
    }
}
