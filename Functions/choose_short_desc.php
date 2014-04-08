<?php


function choose_short_desc($shortdesc, $length) {
    if (strlen(strip_tags($shortdesc)) > $length && ( $chr_pos = strpos(substr(strip_tags($shortdesc), $length), " ") ) !== FALSE)
        $shortdesc = substr(strip_tags(str_replace("<br>", "", $shortdesc)), 0, $length + $chr_pos);

    return (strip_tags(str_replace("<br>", "", $shortdesc)) . "...");
}