<?php

require_once 'load.php';

$db = new DatabaseEnergiedaten();
$db->init();

require_once __DIR__.'\controllers\MainController.php';
