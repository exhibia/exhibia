<?php

function enddatefunction($date) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2) + 5;

    if ($day > 31) {
        if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) {
            if ($month == 12) {
                $month = 01;
                $year = $year + 1;
                $day1 = 31;
                $diff = $day - $day1;
            } else {
                $month = $month + 01;
                $day1 = 31;
                $diff = $day - $day1;
            }
        } else {
            $month = $month + 01;
            $day1 = 30;
            $diff = $day - $day1;
        }
        $date = $month . "/" . str_pad($diff, 2, '0', STR_PAD_LEFT) . "/" . $year;
    } else {
        $date = $month . "/" . str_pad($day, 2, '0', STR_PAD_LEFT) . "/" . $year;
    }
    return $date;
}
