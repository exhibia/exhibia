<?php
function GetRedemptionName($redemptionid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $resselpro = db_query("select id, name from redemption r left join products p on r.product_id=p.productID where id=$redemptionid");
    $objpro = db_fetch_array($resselpro);
    db_free_result($resselpro);

    return ('&nbsp;(<a href="redemptiondetail.php?rid=' . $objpro["id"] . '" class="darkblue-12-link">' . $objpro["name"] . '</a>)');
}