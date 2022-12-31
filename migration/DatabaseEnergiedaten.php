<?php

class DatabaseEnergiedaten {
    
    private PDO $pdo;
    
    function __construct() {
        $dsn = 'mysql:host='.HOST;
        $this->pdo = new PDO($dsn, ADMIN, ADMINPASS);
    }
    
    public function isExist() {
        $sql = "SHOW DATABASES LIKE '".DB."'";
        return !empty($this->pdo->query($sql)->fetch());
    }
    
    public function create() {
        $sql = file_get_contents(DIR.'migration\energiedaten.sql');
        $this->pdo->query($sql);
        $sql = 'CREATE USER `' . USER . '`@`' . HOST . '` IDENTIFIED BY "' . PASSWORD . '";
                GRANT SELECT, INSERT, UPDATE, DELETE ON `energiedaten`.* TO `' . USER . '`@`' . HOST . '`;
                FLUSH PRIVILEGES;';
        $this->pdo->query($sql);
    }
}
