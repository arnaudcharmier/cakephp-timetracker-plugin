<?php

class TimeUtil {


    public static function additionTime($time1, $time2) {
        $secondes1 = TimeUtil::hourToSecond($time1);
        $secondes2 = TimeUtil::hourToSecond($time2);
        $somme = $secondes1 + $secondes2;
        //transfo en h:i:s
        $s = $somme % 60; //reste de la division en minutes => secondes
        $m1 = ($somme - $s) / 60; //minutes totales
        $m = $m1 % 60;//reste de la division en heures => minutes
        $h = ($m1 - $m) / 60; //heures
        $result = sprintf("%02s", $h) . ":" . sprintf("%02s", $m) . ":" . sprintf("%02s", $s);
        return $result;
    }

    public static function subtractionTime($time1, $time2) {
        $secondes1 = TimeUtil::hourToSecond($time1);
        $secondes2 = TimeUtil::hourToSecond($time2);
        $somme = $secondes1 - $secondes2;
        //transfo en h:i:s
        $s = $somme % 60; //reste de la division en minutes => secondes
        $m1 = ($somme - $s) / 60; //minutes totales
        $m = $m1 % 60;//reste de la division en heures => minutes
        $h = ($m1 - $m) / 60; //heures
        $result = sprintf("%02s", $h) . ":" . sprintf("%02s", $m) . ":" . sprintf("%02s", $s);
        return $result;
    }

    public static function hourToSecond($time) {
        $arrayTime = explode(":", $time);
        $seconds = 3600 * $arrayTime[0] + 60 * $arrayTime[1] + $arrayTime[2];
        return $seconds;
    }
}