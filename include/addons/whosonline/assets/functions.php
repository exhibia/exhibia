<?php

/* ==================================================================*\
  ######################################################################
  #                                                                    #
  # Copyright 2010 Dynno.net . All Rights Reserved.                    #
  #                                                                    #
  # This file may not be redistributed in whole or part.               #
  #                                                                    #
  # Developed by: $ID: 1 $UNI: Imad Jomaa                              #
  # ----------------------- THIS FILE PREFORMS ----------------------- #
  #                                                                    #
  # MySQL Class                                                        #
  ######################################################################
  \*================================================================== */



//lets first check if IN_WOL is defined
if (!defined("IN_WOL")) {
    die(header("Location: ../index.php"));
}

/**
 * Converts time to relative time
 * @return 
 * @param object $time
 * @param object $now[optional]
 */
function relativeTime($time, $now = false) {
    $time = (int) $time;
    $curr = $now ? $now : time();
    $shift = $curr - $time;

    if ($shift < 60) {
        $diff = $shift;
        $term = "second";
    } elseif ($shift < 2700) {
        $diff = round($shift / 60);
        $term = "minute";
    } elseif ($shift < 64800) {
        $diff = round($shift / 60 / 60);
        $term = "hour";
    } elseif (round($shift / 60 / 60 / 24) < 30) {
        $diff = round($shift / 60 / 60 / 24);
        $term = "day";
    } elseif (round($shift / 60 / 60 / 24 / 30) < 12) {
        $diff = round($shift / 60 / 60 / 24 / 30);
        $term = "month";
    } else {
        $diff = round($shift / 60 / 60 / 24 / 30 / 12);
        $term = "year";
    }

    if ($diff > 1) {
        $term .= "s";
    }

    if ($shift < 1) {
        return "Just Now";
    } else {
        return "$diff $term ago";
    }
}

?>