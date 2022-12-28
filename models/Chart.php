<?php

class Chart {
    
    private String $url;
    private String $answer = "";

    function __construct(String $url) {
        $this->url = $url;
        $this->answer = $this->getAnswer();
    }
    
    public function parseJson() {
        $pattern = '/.+series\\\\":\[/';                
        $replacement = "\[";                
        $json = preg_replace($pattern, $replacement, $this->answer);

        $replacement = "\]";
        $pattern = '/\]}}\)\(\).+/';
        $json = preg_replace($pattern, $replacement, $json);

        $pattern = '/<\\\\\\\\\\\\/';
        $replacement = "<";
        $json = preg_replace($pattern, $replacement, $json);

        $pattern = '/\\\/';
        $replacement = "";
        $json = preg_replace($pattern, $replacement, $json);

        $pattern = '/,\"events\":{\"legendItemClick\":showConventionalSeries,\"hide\":hideConventionalSeries}/';
        $replacement = "";
        $json = preg_replace($pattern, $replacement, $json);

        return json_decode($json, true);
    }
    
    public function getAnswer() {
        $this->answer = @file_get_contents($this->url);
        return $this->answer;
    }
    
    public static function createUrl($begin, $end) {
        $requestUrl = NULL;
        $begin = date("d.m.Y", strtotime($begin));
        $end = date("d.m.Y", strtotime($end));
        $requestUrl = "https://www.agora-energiewende.de/service/agorameter/chart/data/power_generation/"
                       . $begin . "/" . $end . "/today/chart.json";      
        
        return $requestUrl;
    }
    
}

