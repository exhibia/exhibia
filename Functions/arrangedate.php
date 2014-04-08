<?php

function arrangedate($date) {
    global $globalDateformat;
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2);

    if ($globalDateformat == 'm/d/Y') {
        return ($month . "/" . $day . "/" . $year);
    } else {
        return ($day . "/" . $month . "/" . $year);
    }
}