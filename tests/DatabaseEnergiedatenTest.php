<?php

use PHPUnit\Framework\TestCase;
include_once '../load.php';

class DatabaseEnergiedatenTest extends TestCase {
    /** @test*/
    public function schouldBeTrueIfDatabaseExists() {
        $db = new DatabaseEnergiedaten();
        $this->assertTrue($db->isExist());
    }
}
