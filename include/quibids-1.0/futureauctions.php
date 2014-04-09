<?php 
$total_per_ini3 = 10;
$max_pages3 = 100;
$items_per_page3 = 5;

$id = ( $id == 0 && $aid > 0 ) ? $aid : $id;

if ( isset($_GET['pgno3']) ) {
	$PageNo3 = chkInput($_GET['pgno3'], 'i');
	$PageNo3 = $PageNo3 > 0 ? $PageNo3 : 1;
} else {
	$PageNo3 = 1;
}

$from3 = $PageNo3 > 1 ? ($PageNo3-1) * $items_per_page3 : 0;

if ( $aid == 1 ) {
	$qryselC3 = "select count(*) as total3 from auction where auc_status='$id'";

	//$qrysel3  = "select auctionID, picture1, short_desc, auc_start_price, price, p.name as prdname from auction a ".
				   "left join products p on a.productID=p.productID where a.auc_status='$id' limit $from3, $items_per_page3";


    $qrysel3 = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,c.name as catname,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,username, " .
            "(case when use_free = '1' " .
            " then (select sum(bid_count) from free_account where bid_flag='d' and auction_id=a.auctionID and user_id=a.buy_user group by auction_id) " .
            " else (select sum(bid_count) from bid_account  where bid_flag='d' and auction_id=a.auctionID and user_id=a.buy_user group by auction_id) " .
            "end) as bidcount " .
            "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
            "left join categories c on p.categoryID=c.categoryID left join registration r on r.id=a.buy_user " .
            "where a.auc_status='$id' order by a.auc_final_end_date desc limit $from3, $items_per_page3";


} else {
	$qryselC3 = "select count(*) as total3 from auction where auc_status='1' and categoryID=$id";

//	$qrysel3  = "select auctionID, picture1,bidpack_banner,bidp short_desc, auc_start_price, price, p.name as prdname from auction a ".
				   "left join products p on a.productID=p.productID where a.auc_status='1' and a.categoryID=$id limit $from3, $items_per_page3";



    $qrysel3 = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,c.name as catname,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,username, " .
            "(case when use_free = '1' " .
            " then (select sum(bid_count) from free_account where bid_flag='d' and auction_id=a.auctionID and user_id=a.buy_user group by auction_id) " .
            " else (select sum(bid_count) from bid_account  where bid_flag='d' and auction_id=a.auctionID and user_id=a.buy_user group by auction_id) " .
            "end) as bidcount " .
            "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
            "left join categories c on p.categoryID=c.categoryID left join registration r on r.id=a.buy_user " .
            "where a.auc_status='1' and a.categoryID=$id order by a.auc_final_end_date desc limit $from3, $items_per_page3";
}
$resultC3 = db_query($qryselC3) or die ("1:====".db_error());
$totalC3 = db_result($resultC3, 0);
db_free_result($resultC3);

$ressel3 = db_query($qrysel3) or die ("2:====".db_error());

$total_pages3 = ceil($totalC3 / $items_per_page3);	// Figure out the total number of pages. Always round up using ceil()

$nextval3 = $PageNo3 + $total_per_ini3;
if ( $total_pages3 >= $nextval3 ) {
	$start3 = $PageNo3;
	$max3 = $nextval3;
} else {
	if ( $total_pages3 > $total_per_ini3 ) {
		$start3 = $total_pages3 - $total_per_ini3 + 1;
		$max3 = $total_pages3 + 1;
	} else {
		$start3 = 1;
		$max3 = $total_pages3+1;
	}
}
?>
<?php if ( $totalC3 > 0 ) { ?>
<div id="live-auctions">
        <div id="live-auctions-head">
            <h2><?php echo FUTURE_AUCTIONS; ?></h2>
    </div>
    <div id="live-th">
        <div id="product_title"><?php echo PRODUCTS; ?></div>
        <div id="price_title"><?php echo PRICE_BIDDER; ?></div>
        <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
    </div>

    <?php
            while ( ( $obj = db_fetch_array($ressel3) ) ) {
   if ($obj['uniqueauction'] == true) {
                                $cornerImag = 'lowestsmall.gif';
                            } else if ($obj['reverseauction'] == true) {
                                $cornerImag = 'reversesmall.gif';
                            } else if ($obj['fixedpriceauction'] == true) {
                                $cornerImag = 'fixedsmall.gif';
                            } else if ($obj['pennyauction'] == true) {
                                $cornerImag = 'centsmall.gif';
                            } else if ($obj['nailbiterauction'] == true) {
                                $cornerImag = 'nightsmall.gif';
                            } else if ($obj['offauction'] == true) {
                                $cornerImag = '100offsmall.gif';
                            } else if ($obj['nightauction'] == true) {
                                $cornerImag = 'nightsmall.gif';
                            } else if ($obj['openauction'] == true) {
                                $cornerImag = 'opensmall.gif';
                            } else if ($obj['halfbackauction'] == true) {
                                $cornerImag = '';
                            } else if ($obj['seatauction'] == true) {
                                $cornerImag = 'seatedd-small.gif';
                            } else if ($obj['lockauction'] == true) {
                                $cornerImag = 'lockedsmall.gif';
                            }

    ?>
                    <div class="auction-item">
                        <div class="live-auction" style="background-color: white;">
<?php if ($cornerImag != '') {
                        ?>
                                <div class="corner_imagev1">
                                    <img src="include/addons/icons/quibids-1.0/<?php echo $cornerImag; ?>"  alt=""/>
                                </div>
                        <?php } ?>
                            <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs/thumb_<?php echo $obj["picture1"]; ?>);"></a>
                            <div class="live-a-content">
                                <h2>
                                    <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>"><?php echo stripslashes($obj["prdname"]); ?></a>
                                </h2>
                                <p><?php echo stripslashes($obj['short_desc']); ?></p>
                            </div>
                            <div class="price-bidder">
                                <label id="price_index_page_<?php echo $obj["auctionID"]; ?>"><?=$Currency;?><?=number_format($obj["auc_start_price"], 2);?></label>
                                <span id="value_index_page_<?php echo $obj["auctionID"]; ?>"><?php echo $Currency . $obj['price']; ?></span>
                                <label class="winner" id="product_bidder_<?php echo $obj["auctionID"]; ?>">---</label>
                            </div>
                            <div class="countdown">
                                <label class="timer time-left" id="counter_index_page_<?php echo $obj["auctionID"]; ?>">
                                    --:--:--
                                </label>
                                <div class="buttonoffset">
                    <?php if ($uid == 0) {
                    ?>
                        <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="loginfirst" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo PLACE_BID; ?></a>

                    <?php } else {
                    ?>
                        <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="loginfirst bid-button-link" name="getbid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

                    <?php } ?>
                </div>
            </div>

            <div class="clear"></div>
        </div>

    </div>

    <?php
                }
                db_free_result($ressel3);
            $get_param = $aid == 1 ? "aid=1" : "id=$id";
    ?>

            <div id="live-auctions-end">
                <table align="right">
                    <tbody>
                        <tr>
                            <td valign="middle">
                                <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $totalC3 . ' ' . AUCTIONS ?>, <?php echo $PageNo3 . ' ' . OF . ' ' . $total_pages3 . ' ' . PAGES; ?> </div>
                            </td>
                            <td width="30">&nbsp;</td>
                            <td valign="middle">
                                <span id="pagination">
                            <?php if ($PageNo3 > 1) {
                            ?>
                                <a style="width: 50px;" id="prev" href="allauctions.php?pgno3=<?php echo $PageNo3 - 1; ?>&<?=$get_param;?>"><?php echo PREVIOUS; ?></a>
                            <?php } else {
                            ?>
                                <a style="width: 50px;" id="prev"><span style="color: rgb(192, 192, 192);"><?php echo PREVIOUS; ?></span></a>
                            <?php } ?>

                            &nbsp;

                            <?php
                            $pagestart = $PageNo3 - 3;
                            if ($pagestart < 1) {
                                $pagestart = 1;
                            }

                            $pageend = $pagestart + 7;
                            if ($pageend > $total_pages3) {
                                $pageend = $total_pages3;
                            }

                            for ($page = $pagestart; $page <= $pageend; $page++) {
                            ?>
                                <a href="allauctions.php?pgno3=<?php echo $page; ?>&<?=$get_param;?>" class="<?php echo $page == $PageNo3 ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                            <?php } ?>


                            <?php if ($PageNo3 < $total_pages3) {
                            ?>
                                <a id="next" href="allauctions.php?pgno3=<?php echo $PageNo3 + 1; ?>&<?=$get_param;?>"><?php echo NEXT; ?></a>
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
        <?php
}
?>
<div class="clear">&nbsp;</div>
