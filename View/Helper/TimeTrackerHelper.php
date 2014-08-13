<?php

class TimeTrackerHelper extends AppHelper {

    public function TimeToPercentage($timeTotal, $time) {

        $timeArray  = explode(':', $time);
        $timePerc   = 100 * $timeArray['0'] / $timeTotal;

        return $timePerc . ' %';
    }
}