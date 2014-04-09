<?
$total_per_ini3 = 10;
$max_pages3 = 100;
$items_per_page3 = 5;

$iId = ( $iId <= 0 && $aid > 0 ) ? $aid : $id;

if (isset($_GET['pgno3'])) {
    $PageNo3 = chkInput($_GET['pgno3'], 'i');
    $PageNo3 = $PageNo3 > 0 ? $PageNo3 : 1;
} else {
    $PageNo3 = 1;
}

$from3 = $PageNo3 > 1 ? ($PageNo3 - 1) * $items_per_page3 : 0;

if ($aid == 1)
{
    $qryselC3 = "select count(*) as total3 from auction where auc_status='$iId'";

    $qrysel3 = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,cashauction,reserve,lockauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
            " from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 where a.auc_status='$iId' limit $from3, $items_per_page3";

	 //$qrysel3 = "SELECT * FROM auction WHERE auc_status='$iId'";

	 //die( $qrysel3 );
}
else
{
    $qryselC3 = "select count(*) as total3 from auction where auc_status='1' and categoryID=$iId";

    $qrysel3 = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
            " from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 where a.auc_status='1' and a.categoryID=$iId limit $from3, $items_per_page3";
}
$resultC3 = db_query($qryselC3) or die("1:====" . db_error());
$totalC3 = db_result($resultC3, 0);
db_free_result($resultC3);

//die( $qrysel3 );

$ressel3 = db_query($qrysel3) or die("2:====" . db_error());

$total_pages3 = ceil($totalC3 / $items_per_page3); // Figure out the total number of pages. Always round up using ceil()

$nextval3 = $PageNo3 + $total_per_ini3;
if ($total_pages3 >= $nextval3) {
    $start3 = $PageNo3;
    $max3 = $nextval3;
} else {
    if ($total_pages3 > $total_per_ini3) {
        $start3 = $total_pages3 - $total_per_ini3 + 1;
        $max3 = $total_pages3 + 1;
    } else {
        $start3 = 1;
        $max3 = $total_pages3 + 1;
    }
}

?>
<?php if ($totalC3 > 0) { ?>
    <p class="bid-title"><em><?php echo FUTURE_AUCTIONS; ?></em></p>
    <div id="mybids-box" class="content">
    <?
    $is_header = TRUE;
    while (( $obj = db_fetch_array($ressel3))) {

        $cornerImag = cornerImag($obj);

        $seatauction = $obj['seatauction'];
        if ($seatauction == true && $obj['seatcount'] >= $obj['minseats']) {
            $seatauction = false;
        }
        $pname = $obj['bidpack'] ? $obj['bidpack_name'] : $obj['name'];
        $picture = $obj['bidpack'] ? $obj['bidpack_banner'] : $obj['picture1'];
        $price = $obj['bidpack'] ? $obj['bidpack_price'] : $obj['price'];
        $short_desc = $obj['bidpack'] ? "{$obj['bid_size']} Bids and {$obj['freebids']} Freebids" : $obj['short_desc'];
    ?>
        <div class="bid-box auction-item">
        <?php if ($cornerImag != '') {
 ?>
            <div class="corner_imagev1">
                <img src="img/icons/<?php echo $cornerImag; ?>"  alt=""/>
            </div>
<?php } ?>
        <div class="bid-image">
            <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], $obj['uniqueauction'] == false?'n':'l'); ?>">
                <img onmouseout="javascript: closezoomimage('prd_image_large_<?= $obj["auctionID"]; ?>');" onmousemove="javascript: hidedisplayzoom('prd_image_large_<?= $obj["auctionID"]; ?>');" src="<?= $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?= $picture; ?>" alt="" width="118" height="100" border="0"/>
                <div id="prd_image_large_<?= $obj['auctionID']; ?>" style="width: 360px; height:320px; background-color: #FFFFFF; border: 2px solid #29395B; position:absolute; float:left; margin-left: 125px; margin-top: -100px; display: none;">
                    <div style="float:right;"><img src="images/btn_closezoom.png" onclick="closezoomimage('prd_image_large_<?= $obj["auctionID"]; ?>')" style="cursor: pointer" /></div>
                    <img src="<?= $UploadImagePath; ?>products/<?= $picture; ?>"/>
                </div>
            </a>
            <?php if ($uid == 0) { ?>
                <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>

            <?php } else {
            ?>
            <?php if ($seatauction == true) {
            ?>
                    <div id="seat_button_<?php echo $obj["auctionID"]; ?>">
                        <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button butseat-button-link" name="getseat.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>
                    </div>
            <?php } ?>

                <div id="normal_button_<?php echo $obj["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                <?php if ($obj['uniqueauction'] == false) {
                ?>
                    <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button bid-button-link" name="getbid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

                <?php } else {
                ?>
                    <a id="image_main_<?php echo $obj["auctionID"]; ?>" rel="<?php echo $obj["auctionID"]; ?>" class="button ubid-button-link" name="getuniquebid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>
                <?php } ?>
            </div>

            <?php } ?>
        </div><!-- /bid-image -->
        <div class="bid-content">
            <h2><a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></a></h2>
            <h3><?php echo DESCRIPTION; ?>:</h3>
            <p><?= htmlspecialchars(choose_short_desc(stripslashes($short_desc), 140), ENT_QUOTES); ?><a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>"><?php echo MORE; ?></a></p>
	    <p class="bidder"><strong><?php echo STARTS;?>: <?php echo date("l F d, Y H:i:s", $obj['future_tstamp']); ?></strong> <a href=""><span id="product_bidder_<?= $obj["auctionID"]; ?>"></span></a></p>
        </div><!-- /bid-content -->
        <div class="bid-countdown">
            <?php if ($seatauction) {
            ?>
                <div class="seat_panel" id="seat_panel_<?php echo $obj["auctionID"]; ?>">
                    <div class="seat_bar" id="seat_bar_<?php echo $obj["auctionID"]; ?>">
                    </div>

                    <div class="seat_count">
                        <span id="seat_count_<?php echo $obj["auctionID"]; ?>">-</span>/<span><?php echo $obj['minseats']; ?></span>
                    </div>
                    <div class="seat_text1"><?php echo SEATS_AVAILABLE; ?></div>
                    <div class="seat_text2">
                    <?php echo SEAT_AUCTION_DESCRIPTION; ?>
                </div>
                <div class="seat_text3">
                    <?php echo FROM_W; ?>:<span><?php echo $Currency . $obj['auc_start_price'] ?></span>&nbsp;&nbsp;
                    <?php echo SEAT_BIDS; ?>:<span><?php echo $obj['seatbids'] ?></span>
                </div>
                <p class="instead"><?php echo INSTEAD_OF; ?> <?= $Currency . number_format($price, 2); ?></p>
            </div>

            <?php }
            ?>
                <div id="normal_panel_<?php echo $obj["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                    <p class="timerbox"><?php echo COUNTDOWN; ?> <strong>
                            <span id="counter_index_page_<?= $obj["auctionID"]; ?>">
    						--:--:--
                            </span>
                        </strong>
                    </p>
                    <p class="instead"><strong><span id="price_index_page_<?= $obj["auctionID"]; ?>"><?= $Currency; ?><?= number_format($obj["auc_start_price"], 2); ?></span></strong> (<?php echo INSTEAD_OF; ?> <?= $Currency . $price; ?>)</p>
            </div>
        </div><!-- /bid-countdown -->
    </div><!-- /bid-box -->
    <?
            }
            db_free_result($ressel3);
    ?>
            <div class="clear" style="height: 15px;">&nbsp;</div>
            <div class="imagetital" align="center">
        <?
            $get_param = $aid == 1 ? "aid=1" : "id=$iId";

            if ($PageNo3 > 1) {
                $npage3 = $PageNo3 - 1;
        ?>
                <span><a class="darkblue-12-link" href="allauctions.php?pgno3=1&<?= $get_param; ?>#FutureAuction" style="text-decoration: none;">&lt;&lt;</a></span>
                <span class="<?= ($aid == 1 ? "style8" : "blue_link"); ?>"><a class="darkblue-12-link" href="allauctions.php?pgno3=<?= $npage3; ?>&<?= $get_param; ?>#FutureAuction" style="text-decoration: none;">&lt;</a></span>
        <?php } else {
 ?>
                <span>&lt;&lt;</span><span>&lt;</span>
<?php } ?>
            <span>
            <?
            for ($j = $start3; $j < $max3; $j++) {
                if ($j == $PageNo3) {
            ?>
        			| <span><?= $j ?></span>
            <?php } else { ?>
                    <span>|<a class="darkblue-12-link" href="allauctions.php?pgno3=<?= $j; ?>&<?= $get_param; ?>#FutureAuction" style="text-decoration: none;"><?= $j; ?></a></span>
            <?
                }
            }

            if ($PageNo3 < $total_pages3) {
                $npage3 = $PageNo3 + 1;
            ?>
                <span>|<a class="darkblue-12-link" href="allauctions.php?pgno3=<?= $npage3; ?>&<?= $get_param; ?>#FutureAuction" style="text-decoration: none;">&gt;</a></span>
                <a class="darkblue-12-link" href="allauctions.php?pgno3=<?= $total_pages3; ?>&<?= $get_param; ?>#FutureAuction" style="text-decoration: none;">&gt;&gt;</a>
            <?php } else {
            ?>
    			| &gt; &gt;&gt;
            <?php } ?>
        </span>
    </div>
</div>
<?
        }
?>
<div class="clear">&nbsp;</div>