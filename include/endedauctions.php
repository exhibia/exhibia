<?
$total_per_ini2 = 10;
$max_pages2 = 100;
$items_per_page2 = 5;

$id = ( $id == 0 && $aid > 0 ) ? $aid : $id;

$dispauctiondate = CreateSelEndDate();
/*
  ///////////////////////////
  Important Note:
  If you want to display all ended auctions than remove a.auc_final_end_date conditions from all queries
  ///////////////////////////
 */

if (isset($_GET['pgno2'])) {
    $PageNo2 = chkInput($_GET['pgno2'], 'i');
    $PageNo2 = $PageNo2 > 0 ? $PageNo2 : 1;
} else {
    $PageNo2 = 1;
}

$from2 = $PageNo2 > 1 ? ($PageNo2 - 1) * $items_per_page2 : 0;

if ($aid == 3) {
    $qryselC2 = "select Count(*) as total2 from auction where auc_status='$aid' and auc_final_end_date>='$dispauctiondate' and " .
            "auc_final_end_date<='" . date("Y-m-d") . " 23:59:59' order by auctionID desc";

    $qrysel2 = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,c.name as catname,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,halfbackauction,cashauction,reserve,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,username, " .
            "(case when use_free = '1' " .
            " then (select sum(bid_count) from free_account where bid_flag='d' and auction_id=a.auctionID and user_id=a.buy_user group by auction_id) " .
            " else (select sum(bid_count) from bid_account  where bid_flag='d' and auction_id=a.auctionID and user_id=a.buy_user group by auction_id) " .
            "end) as bidcount " .
            "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
            "left join categories c on p.categoryID=c.categoryID left join registration r on r.id=a.buy_user " .
            "where a.auc_status='$aid' and a.auc_final_end_date>='$dispauctiondate' and a.auc_final_end_date<='" . date("Y-m-d") . " 23:59:59' " .
            "order by a.auc_final_end_date desc limit $from2, $items_per_page2";
} else {
    $qryselC2 = "select Count(*) as total2 from auction where auc_status='3' and categoryID=$id and " .
            "auc_final_end_date>='$dispauctiondate' and auc_final_end_date<='" . date("Y-m-d") . " 23:59:59' order by auctionID desc";

    $qrysel2 = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,c.name as catname,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,cashauction,reserve,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,username, " .
            "(case when use_free = '1' " .
            " then (select sum(bid_count) from free_account where bid_flag='d' and auction_id=a.auctionID and user_id=a.buy_user group by auction_id) " .
            " else (select sum(bid_count) from bid_account  where bid_flag='d' and auction_id=a.auctionID and user_id=a.buy_user group by auction_id) " .
            "end) as bidcount " .
            "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
            "left join categories c on p.categoryID=c.categoryID left join registration r on r.id=a.buy_user " .
            "where a.auc_status='3' and a.categoryID=$id and a.auc_final_end_date>='$dispauctiondate' and " .
            "a.auc_final_end_date<='" . date("Y-m-d") . " 23:59:59' order by a.auc_final_end_date desc limit $from2, $items_per_page2";
}

$resultC2 = db_query($qryselC2) or die("1:====" . db_error());
$totalC2 = db_result($resultC2, 0);
db_free_result($resultC2);

$ressel2 = db_query($qrysel2) or die("2:====" . db_error());

$total_pages2 = ceil($totalC2 / $items_per_page2); // Figure out the total number of pages. Always round up using ceil()

$nextval2 = $PageNo2 + $total_per_ini2;
if ($total_pages2 >= $nextval2) {
    $start2 = $PageNo2;
    $max2 = $nextval2;
} else {
    if ($total_pages2 > $total_per_ini2) {
        $start2 = $total_pages2 - $total_per_ini2 + 1;
        $max2 = $total_pages2 + 1;
    } else {
        $start2 = 1;
        $max2 = $total_pages2 + 1;
    }
}
?>
<?php if ($totalC2 > 0) { ?>
    <p class="bid-title"><em><?php echo ENDED_AUCTIONS; ?></em></p>
    <div id="mybids-box" class="content">
    <?
    $is_header = TRUE;
    while (( $obj = db_fetch_array($ressel2))) {
        $cornerImag = cornerImag($obj);

        $pname = $obj['bidpack'] ? $obj['bidpack_name'] : $obj['name'];
        $picture = $obj['bidpack'] ? $obj['bidpack_banner'] : $obj['picture1'];
        $price = $obj['bidpack'] ? $obj['bidpack_price'] : $obj['price'];
        $short_desc = $obj['bidpack'] ? "{$obj['bid_size']} Bids and {$obj['freebids']} Freebids" : $obj['short_desc'];

        if ($obj["fixedpriceauction"] == 1) {
            $fprice = $obj["auc_fixed_price"];
        } else {
            $fprice = $obj["offauction"] == 1 ? "0.00" : $obj["auc_final_price"];
        }
        $saving_percent = $price==0?'100': (($price - $fprice) * 100 / $price);
    ?>
        <div class="bid-box">
<?php if ($cornerImag != '') { ?>
                <div class="corner_imagev1">
                    <img src="img/icons/<?php echo $cornerImag; ?>"  alt=""/>
            </div>
<?php } ?>
        <div class="bid-image">
            <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>">
                <img onmouseout="javascript: closezoomimage('prd_image_large_<?= $obj["auctionID"]; ?>');" onmousemove="javascript: hidedisplayzoom('prd_image_large_<?= $obj["auctionID"]; ?>');" src="<?= $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?= $picture; ?>" alt="" width="118" height="100" border="0"/>
                <div id="prd_image_large_<?= $obj['auctionID']; ?>" style="width: 360px; height:320px; background-color: #FFFFFF; border: 2px solid #29395B; position:absolute; float:left; margin-left: 125px; margin-top: -100px; display: none;">
                    <div style="float:right;"><img src="images/btn_closezoom.png" onclick="closezoomimage('prd_image_large_<?= $obj["auctionID"]; ?>')" style="cursor: pointer" /></div>
                    <img src="<?= $UploadImagePath; ?>products/<?= $picture; ?>"/>
                </div>	
            </a>
            
        </div><!-- /bid-image -->
        <div class="bid-content">
            <h2><a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></a></h2>
            <h3><?php echo DESCRIPTION; ?>:</h3>
            <p><?= choose_short_desc(strip_tags($short_desc), 140); ?><a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>"><?php echo MORE; ?></a></p>
            <p class="bidder"><strong><?php echo HIGH_BIDDER; ?>:</strong> <a href=""><span id="product_bidder_<?= $obj["auctionID"]; ?>"><?= ($obj["buy_user"] != "0" ? htmlspecialchars(stripslashes($obj["username"]), ENT_QUOTES) : "---"); ?></span></a></p>
        </div><!-- /bid-content -->
        <div class="bid-countdown">
            <p>
                <strong><?php echo END_DATE; ?>:</strong><?= enddatefunction($obj["auc_final_end_date"]) . ' ' . substr($obj["auc_final_end_date"], 10); ?>
            </p>
            <p>
                <strong><?php echo SAVINGS; ?>:</strong><?= ($obj["buy_user"] != "0" ? number_format($saving_percent, 2) . "%" : "---"); ?>
            </p>
        </div><!-- /bid-countdown -->
    </div><!-- /bid-box -->	
<?
    }
    db_free_result($ressel2);
?>
    <div class="clear" style="height: 15px;">&nbsp;</div>
    <div class="imagetital" align="center">
<?
    $get_param = $aid == 3 ? "aid=3" : "id=$id";

    if ($PageNo2 > 1) {
        $npage2 = $PageNo2 - 1;
?>
        <span><a class="darkblue-12-link" href="allauctions.php?pgno2=1&<?= $get_param; ?>#EndedAuction" style="text-decoration: none;">&lt;&lt;</a></span>
        <span class="blue_link"><a class="darkblue-12-link" href="allauctions.php?pgno2=<?= $npage2; ?>&<?= $get_param; ?>#EndedAuction" style="text-decoration: none;">&lt;</a></span>
<?php } else { ?>
        <span>&lt;&lt;</span><span>&lt;</span>
<?php } ?>
        <span>
<?
    for ($j = $start2; $j < $max2; $j++) {
        if ($j == $PageNo2) {
?>
			| <span><?= $j ?></span>
            <?php } else {
 ?>
            <span>|<a class="darkblue-12-link" href="allauctions.php?pgno2=<?= $j; ?>&<?= $get_param; ?>#EndedAuction" style="text-decoration: none;"><?= $j; ?></a></span>
            <?
        }
    }

    if ($PageNo2 < $total_pages2) {
        $npage2 = $PageNo2 + 1;
            ?>
            <span>|<a class="darkblue-12-link" href="allauctions.php?pgno2=<?= $npage2; ?>&<?= $get_param; ?>#EndedAuction" style="text-decoration: none;">&gt;</a></span>
            <a class="darkblue-12-link" href="allauctions.php?pgno2=<?= $total_pages2; ?>&<?= $get_param; ?>#EndedAuction" style="text-decoration: none;">&gt;&gt;</a>
            <?php } else {
 ?>
			|&gt;&gt;&gt;
<?php } ?>
        </span>
    </div>
</div>
<?
    }
?>


<div class="clear">&nbsp;</div>