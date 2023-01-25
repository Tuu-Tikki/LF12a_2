<?php

//Credentials
define("HOST", "127.0.0.1");
define("ADMIN", "root");
define("ADMINPASS", "");

//Application's settings
define("DB", "energiedaten");
define("USER", "user");
define("PASSWORD", "energieDatenLF12");

define ("MAXDAYS", 28); //the maximum number of days for which the website returns hourly results

define("URL", [
            "beginning" => "https://www.agora-energiewende.de/service/agorameter/chart/data/power_generation/",
            "middle" => "dd.mm.yyyy/dd.mm.yyyy", 
            "end" => "/today/chart.json"
        ]);

define("ENERGYTYPE", [
            "solar" => 1,
            "wind-onshore" => 2,
            "wind-offshore" => 3,
            "run-of-the-river" => 4,
            "biomass" => 5,
            "hydro-pumped-storage" => 6,
            "gas" => 7,
            "coal" => 8,
            "lignite" => 9,
            "uranium" => 10,
            "other" => 11,
            "total-load" => 12,
            "conventional-power" => 13,
            "emission-intensity" => 14
        ]);

