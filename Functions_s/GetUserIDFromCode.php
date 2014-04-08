<?php


function GetUserIDFromCode($vercode) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $ressel = db_query("select id, account_status from registration where verifycode='$vercode'");
    $objsel = db_fetch_object($ressel);
    db_free_result($ressel);

    if ($objsel->account_status == 0)
        return $objsel->id;
}