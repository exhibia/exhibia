<?php
function secondToTimer($second) {
    $s = $second % 60;
    $m = floor($second / 60) % 60;
    $h = floor(floor($second / 60) / 60) % 60;
    return ($h < 10 ? '0' . $h : $h) . ':' . ($m < 10 ? '0' . $m : $m) . ':' . $s;
}

