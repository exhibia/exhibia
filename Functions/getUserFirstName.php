<?php

function getUserFirstName($uid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $resusername = db_query("select firstname from registration where id=$uid");
    if (db_num_rows($resusername)) {
        $fname = db_result($resusername, 0, 0);
        db_free_result($resusername);

        return $fname;
    } else {
        return '';
    }
}