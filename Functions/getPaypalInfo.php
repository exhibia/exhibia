<?php

function getPaypalInfo($stat) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $qrysel = "select * from paypal_info where id='1'";
    $ressel = db_query($qrysel);
    $obj = db_fetch_object($ressel);
    $businessid = $obj->business_id;
    $token = $obj->token;

    if ($stat == 1)
        return $businessid;
    if ($stat == 2)
        return $token;
}