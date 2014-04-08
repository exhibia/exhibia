<?php

function getshipping($id) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $resgetshipping = db_query("select shippingcharge from shipping where id=$id") or die(db_error());
    if (db_num_rows($resgetshipping) > 0) {
        $shippingchr = db_result($resgetshipping, 0, 0);
        db_free_result($resgetshipping);
    }

    return ( $shippingchr ? $shippingchr : 0.00 );
}