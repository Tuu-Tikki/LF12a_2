<?php

class Chart {
    
    public static function parseJson($answer) {
        $pattern = '/\[{\\\\"id\\\\":.+\]\]}\]/';                  
        echo "\n" . $answer . "\n";
        $result = preg_match_all($pattern, $answer, $matches);
        echo "Result: " . $result . "\n";
        $str = trim(stripslashes($matches[0][0]),'[]');
        echo $str;
        return json_decode($str, true);
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

