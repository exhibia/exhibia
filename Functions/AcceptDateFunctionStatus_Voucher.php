<?php


function AcceptDateFunctionStatus_Voucher($date, $validity) {
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2) + $validity;
    $newdate = explode(" ", $date);
    $exdate = explode("-", $newdate[0]);
    $newyear = $exdate[0];
    $newmonth = $exdate[1];
    $newday = $exdate[2];
    $newtime = explode(":", $newdate[1]);
    $newhour = $newtime[0];
    $newmin = $newtime[1];
    $newsec = $newtime[2];
    $returndate1 = date("Y-m-d H:i:s", mktime($newhour, $newmin, $newsec, $newmonth, $newday + $validity, $newyear));

    $newdate1 = explode(" ", $returndate1);
    $exdate1 = explode("-", $newdate1[0]);
    $newyear1 = $exdate1[0];
    $newmonth1 = $exdate1[1];
    $newday1 = $exdate1[2];
    $newtime1 = explode(":", $newdate1[1]);
    $newhour1 = $newtime1[0];
    $newmin1 = $newtime1[1];
    $newsec1 = $newtime1[2];

    $returndate = array("Hour" => $newhour1, "Min" => $newmin1, "Sec" => $newsec1, "Month" => $newmonth1, "Day" => $newday1, "Year" => $newyear1);

    return $returndate1;
}