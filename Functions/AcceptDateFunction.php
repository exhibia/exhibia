<?php

function AcceptDateFunction($date) {
    global $globalDateformat;
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2) + 7;

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
        if ($globalDateformat == 'm/d/Y') {
            $date = str_pad($month, 2, 0, STR_PAD_LEFT) . "-" . str_pad($diff, 2, 0, STR_PAD_LEFT) . "-" . $year;
        } else {
            $date = str_pad($diff, 2, 0, STR_PAD_LEFT) . "-" . str_pad($month, 2, 0, STR_PAD_LEFT) . "-" . $year;
        }
    } else {
        if ($globalDateformat == 'm/d/Y') {
            $date = str_pad($month, 2, 0, STR_PAD_LEFT) . "-" . str_pad($day, 2, 0, STR_PAD_LEFT) . "-" . $year;
        } else {
            $date = str_pad($day, 2, 0, STR_PAD_LEFT) . "-" . str_pad($month, 2, 0, STR_PAD_LEFT) . "-" . $year;
        }
    }
    return $date;
}