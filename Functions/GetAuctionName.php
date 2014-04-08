<?php
function GetAuctionName($auctionid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $resselauc1 = db_query("select auctionID, name from auction a left join products p on a.productID=p.productID where a.auctionID=$auctionid");
    $objselauc1 = db_fetch_array($resselauc1);
    db_free_result($resselauc1);

    return ('&nbsp;(<a href="' . SEOSupport::getProductUrl($objselauc1["name"], $objselauc1["auctionID"], 'n') . '" class="darkblue-12-link">' . $objselauc1["name"] . '</a>)');
}
