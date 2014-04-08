<?php

function arrangedate2($date) {
    global $globalDateformat;
    $year = substr($date, 6);
    $month = substr($date, 3, 2);
    $day = substr($date, 0, 2);
    if($globalDateformat=='d/m/Y') {
        return ($day . "-" . $month . "-" . $year);
    } else {
        return ($month . "-" .$day . "-" .  $year);
    }
}