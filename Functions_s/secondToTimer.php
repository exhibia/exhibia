<?php

function secondToTimer($second) {
    $s = $second % 60;
    $m = floor($second / 60) % 60;
    $h = floor(floor($second / 60) / 60) % 60;
    return $h . ':' . $m . ':' . $s;
}

