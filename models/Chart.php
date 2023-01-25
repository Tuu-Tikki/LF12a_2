<?php

class Chart {
    
    public static function parseJson($answer) {
        $json = "";
        
        $pattern = '/\[{\\\\"id\\\\":.+\]\]}\]/';                  
        $result = preg_match_all($pattern, $answer, $matches);
        if(array_key_exists('0', $matches[0])) {
            $json = stripslashes($matches[0][0]);

            $pattern = '/,\"events\":{\"legendItemClick\":showConventionalSeries,\"hide\":hideConventionalSeries}/';
            $replacement = "";
            $json = preg_replace($pattern, $replacement, $json);
        }
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
        $requestUrl = URL['beginning'] . $begin . "/" . $end . URL['end'];      
        
        return $requestUrl;
    }    
}

