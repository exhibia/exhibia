<?php

function getUserName($uid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $resusername = db_query("select username from registration where id=$uid");

    $uname = 0;
    if (db_num_rows($resusername) > 0) {
        $uname = db_result($resusername, 0, 0);
    }
    db_free_result($resusername);

    return $uname;
}


