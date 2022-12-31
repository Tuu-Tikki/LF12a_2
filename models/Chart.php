<?php

class Chart {
    
    public static function parseJson($answer) {
        $pattern = '/.+series\\\\":\[/';                
        $replacement = "\[";                
        $json = preg_replace($pattern, $replacement, $answer);

        $pattern = '/\]}}\)\(\).+/';
        $replacement = "\]";
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
    
    public function getData($begin, $end) {
        $url = self::createUrl($begin, $end);
        return self::parseJson(@file_get_contents($url));
    }
    
    public static function createUrl($begin, $end) {
        $requestUrl = null;
        $begin = date("d.m.Y", strtotime($begin));
        $end = date("d.m.Y", strtotime($end));
        $requestUrl = URL['part1'] . $begin . "/" . $end . URL['part2'];      
        
        return $requestUrl;
    }
    
}

