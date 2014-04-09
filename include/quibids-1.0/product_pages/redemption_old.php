<?
include("config/connect.php");
include("functions.php");

$changeimage = "redemption";
$uid = $_SESSION["userid"];

$PRODUCTSPERPAGE_REDEEM = 16;

if (!$_GET['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_GET['pgno'];
}

$currentdate = date("Y-m-d");

$qrysel = "select * from redemption red left join products p on red.product_id=p.productID where (red.redem_startdate='" . $currentdate . "' and red.redem_enddate>='" . $currentdate . "') or (red.redem_startdate<='" . $currentdate . "' and red.redem_enddate>='" . $currentdate . "')";
$ressel = db_query($qrysel);
$totalpro = db_num_rows($ressel);
$total = $totalpro;
$totalpage = ceil($totalpro / $PRODUCTSPERPAGE_REDEEM);

if ($totalpage >= 1) {
    $startrow = $PRODUCTSPERPAGE_REDEEM * ($PageNo - 1);
    $qrysel .=" LIMIT $startrow,$PRODUCTSPERPAGE_REDEEM";
    $ressel = db_query($qrysel);
    $totalpro = db_num_rows($ressel);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $AllPageTitle; ?></title>
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
        <link rel="stylesheet" href="css/auction-listing.css" type="text/css"/>
        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    </head>

    <body>
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include 'header.php'; ?>
            <!-- ============= End Header =============  -->

            <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <div id="auction-listing">
                        <div id="live-auctions">
                            <div id="live-auctions-head">
                                <h2><?php echo REDEMPTION; ?></h2>
                            </div>

                            <h3><?php echo REDEMPTION; ?> (<?php echo $total . ' ' . RESULTS ?>)</h3>
                            <div id="live-th">
                                <div id="product_title"><?php echo PRODUCTS; ?></div>
                                <div id="price_title"><?php echo PRICE; ?></div>
                                <div id="countdown_title"><?php echo REDEMPTION; ?></div>
                            </div>

                            <?php
                            if ($totalpro > 0) {
                                $i = 1;
                                while ($obj = db_fetch_array($ressel)) {
                            ?>
                                    <div id="livespot_1">
                                        <div class="live-auction" id="auction_964929334" style="background-color: white;">
                                            <a href="redemptiondetail.php?rid=<?php echo $obj["id"]; ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_big/thumbbig_<?php echo $obj["picture1"]; ?>);"></a>
                                            <div class="live-a-content">
                                                <h2>
                                                    <a href="redemptiondetail.php?rid=<?php echo $obj["id"]; ?>"><?php echo $obj["name"]; ?></a>
                                                </h2>
                                                <p><?php echo stripslashes($obj['short_desc']); ?></p>
                                                <div class="watchlist">
                                                </div>
                                            </div>
                                            <div class="price-bidder">
                                                <label style="background-color: transparent;font-size:12px;">
                                            <?php echo PRICE; ?>:<strong><?php echo $Currency . $obj["price"]; ?></strong><br/>
                                            <?php echo POINTS; ?>:<strong><?php echo $obj["redem_points"]; ?></strong><br/>
                                        </label>
                                        <label class="winner"><?php echo arrangedate($obj["redem_enddate"]); ?></label>
                                    </div>
                                    <div class="countdown">                                        
                                        <div class="buttonoffset">
                                            <?php if ($obj["redem_qty"] > $obj["redem_soldqty"]) {
                                            ?>
                                            <?php if ($uid == 0) {
                                            ?>
                                                    <a class="bidonme" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo REDEEM; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo REDEEM; ?></a>

                                            <?php } else {
                                            ?>
                                                    <a class="bidonme" onclick="window.location.href='redemptiondetail.php?rid=<?=$obj["id"]; ?>'"><?php echo REDEEM; ?></a>

                                            <?php } ?>
                                            <?php } else {
                                            ?>
                                            <a class="bidonsold" ><?php echo SOLD; ?></a>
                                            <?php } ?>

                                        </div>
                                    </div>

                                    <div class="clear"></div>

                                </div>
                            </div>

                            <?php
                                    }
                                }
                                db_free_result($ressel);
                            ?>


                                <div id="live-auctions-end">
                                    <table align="right">
                                        <tbody>
                                            <tr>
                                                <td valign="middle">
                                                    <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $total . ' ' . AUCTIONS ?>, <?php echo $PageNo . ' ' . OF . ' ' . $totalpage . ' ' . PAGES; ?> </div>
                                                </td>
                                                <td width="30">&nbsp;</td>
                                                <td valign="middle">
                                                    <span id="pagination">
                                                    <?php if ($PageNo > 1) {
                                                    ?>
                                                        <a style="width: 50px;" id="prev" href="redemption.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
                                                    <?php } else {
                                                    ?>
                                                        <a style="width: 50px;" id="prev"><span style="color: rgb(192, 192, 192);"><?php echo PREVIOUS; ?></span></a>
                                                    <?php } ?>

                                                    &nbsp;

                                                    <?php
                                                    $pagestart=$PageNo-3;
                                                    if($pagestart<1){
                                                        $pagestart=1;
                                                    }

                                                    $pageend=$pagestart+7;
                                                    if($pageend>$totalpage){
                                                        $pageend=$totalpage;
                                                    }

                                                    for($page=$pagestart;$page<=$pageend;$page++){

                                                    ?>
                                                    <a href="redemption.php?pgno=<?php echo $page; ?>" class="<?php echo $page==$PageNo?'selected':''; ?>"><?php echo $page;?></a>&nbsp;
                                                    <?php }?>
                                                    
                                                   
                                                    <?php if ($PageNo < $totalpage) {
                                                    ?>
                                                        <a id="next" href="redemption.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
                                                    <?php } else {
                                                    ?>
                                                        <a id="next"><span style="color: rgb(192, 192, 192);"><?php echo NEXT; ?></span></a>
                                                    <?php } ?>

                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="wrap-end"></div>
        </div>

        <?php include 'footer.php' ?>
    </body>
</html>
