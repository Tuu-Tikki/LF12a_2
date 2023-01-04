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
    
    public function createUser() {
        $sql = 'CREATE USER IF NOT EXISTS `' . USER . '`@`' . HOST . '` IDENTIFIED BY "' . PASSWORD . '";
                GRANT SELECT, INSERT, UPDATE, DELETE ON `energiedaten`.* TO `' . USER . '`@`' . HOST . '`;
                FLUSH PRIVILEGES;
                SET PASSWORD FOR `' . USER . '`@`' . HOST . '` = PASSWORD("' . PASSWORD . '");';
        $this->pdo->query($sql);
    }
    
    public function create() {
        $sql = file_get_contents(__DIR__.'\migration\energiedaten.sql');
        $this->pdo->query($sql);    
    }
}
