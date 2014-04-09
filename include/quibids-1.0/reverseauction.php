<?
$total_per_ini = 10;
$max_pages = 100;
$items_per_page = 5;


if (isset($_GET['pgno'])) {
    $PageNo = chkInput($_GET['pgno'], 'i');
    $PageNo = $PageNo > 0 ? $PageNo : 1;
} else {
    $PageNo = 1;
}

$from = $PageNo > 1 ? ($PageNo - 1) * $items_per_page : 0;

if ($searchdata != "") {
    $qryselCR = "select count(*) as total from auction a left join products p on a.productID=p.productID " .
            "left join categories c on p.categoryID=c.categoryID left join auc_due_table adt on a.auctionID=adt.auction_id " .
            "where a.auc_status='2' and p.name like '%$searchdata%' and a.reverseauction=1";

    $qryselR = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,c.name as catname,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
            "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join categories c on p.categoryID=c.categoryID " .
            "left join auc_due_table adt on a.auctionID=adt.auction_id " .
            "where a.auc_status='2' and p.name like '%$searchdata%' and a.reverseauction=1 order by adt.auc_due_time limit $from, $items_per_page";
} else {

    $qryselCR = "select count(*) as total from auction where auc_status='2' and reverseauction=1";

    $qryselR = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,c.name as catname,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
            "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join categories c on p.categoryID=c.categoryID " .
            "left join auc_due_table adt on a.auctionID=adt.auction_id where a.auc_status='2' and a.reverseauction=1 order by adt.auc_due_time " .
            "limit $from, $items_per_page";
}

$resultCR = db_query($qryselCR) or die("1:====" . db_error());
$totalCR = db_result($resultCR, 0);
db_free_result($resultCR);

$resselR = db_query($qryselR) or die("2:====" . db_error());

$total_pages = ceil($totalCR / $items_per_page); // Figure out the total number of pages. Always round up using ceil()

$nextval = $PageNo + $total_per_ini;
if ($total_pages >= $nextval) {
    $start = $PageNo;
    $max = $nextval;
} else {
    if ($total_pages > $total_per_ini) {
        $start = $total_pages - $total_per_ini + 1;
        $max = $total_pages + 1;
    } else {
        $start = 1;
        $max = $total_pages + 1;
    }
}
?>
<?php if ($totalCR > 0) { ?>
    <p class="bid-title"><em><?php echo LIVE_AUCTIONS; ?></em></p>
    <div id="mybids-box" class="content">

    <?php
    $is_header = TRUE;
    while (( $obj = db_fetch_array($resselR))) {
        $cornerImag = '';
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
        }else if ($obj['lockauction'] == true) {
            $cornerImag = 'lockedsmall.gif';
        }

        $seatauction = $obj['seatauction'];
        if ($seatauction == true && $obj['seatcount'] >= $obj['minseats']) {
            $seatauction = false;
        }

        $pname = $obj['bidpack'] ? $obj['bidpack_name'] : $obj['name'];
        $picture = $obj['bidpack'] ? $obj['bidpack_banner'] : $obj['picture1'];
        $price = $obj['bidpack'] ? $obj['bidpack_price'] : $obj['price'];
        $short_desc = $obj['bidpack'] ? "{$obj['bid_size']} Bids and {$obj['freebids']} Freebids" : $obj['short_desc'];
        if ($is_header) {
            $is_header = FALSE;
    ?>
            <div class="clear">&nbsp;</div>
            <div class="auction_subtitle" style="padding-bottom: 15px; margin-left: 15px;">
                <strong>
            <?php
            echo REVERSE_AUCTION_W;
            ?>
        </strong>
    </div>

    <?php } ?> <!--end header-->
        <div class="bid-box auction-item" title="<?= $obj["auctionID"]; ?>" id="auction_<?= $obj["auctionID"]; ?>">
        <?php if ($cornerImag != '') {
        ?>
            <div class="corner_imagev1">
                <img src="include/addons/icons/quibids-1.0/<?php echo $cornerImag; ?>"  alt=""/>
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
            <?php if ($uid == 0) {
            ?>
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
            <p class="bidder"><strong><?php echo HIGH_BIDDER; ?>:</strong> <a href=""><span id="product_bidder_<?= $obj["auctionID"]; ?>">---</span></a></p>
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
                        <script language="javascript" type="text/javascript">
                            document.getElementById('counter_index_page_<?= $obj["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?= $obj["auc_due_time"]; ?>');
                        </script>
                    </span>
                </strong>
            </p>
            <p class="instead"><strong><span id="currencysymbol_<?= $obj["auctionID"]; ?>"></span><span id="price_index_page_<?= $obj["auctionID"]; ?>">---</span></strong> (<?php echo INSTEAD_OF; ?> <?= $Currency . number_format($price, 2); ?>)</p>
            </div>
        </div><!-- /bid-countdown -->
    </div><!-- /bid-box -->
    <?
        }
        db_free_result($resselR);
    ?>
        <div class="clear" style="height: 15px;">&nbsp;</div>
        <div class="imagetital" align="center">
        <?
        $get_param = $searchdata != "" ? "st=" . htmlspecialchars(stripcslashes($searchdata), ENT_QUOTES) : ($aid == 4 ? "aid=4" : "id=$id");

        if ($PageNo > 1) {
            $npage = $PageNo - 1;
        ?>
            <span><a class="darkblue-12-link" href="allauctions.php?pgno=1&<?= $get_param;
        ?>" style="text-decoration: none;">&lt;&lt;</a></span>
        <span class="blue_link"><a class="darkblue-12-link" href="allauctions.php?pgno=<?= $npage;
        ?>&<?= $get_param;
        ?>" style="text-decoration: none;">&lt;</a></span>
                                   <?
                               } else {
                                   ?>
        <span>&lt;&lt;</span><span>&lt;</span>
        <?php } ?>
                               <span>
            <?
                               for ($i = $start; $i < $max; $i++) {
                                   if ($i == $PageNo) {
            ?>
                                                                                         			| <span><?= $i ?></span>
            <?php } else {
            ?>
                                       <span> | <a class="darkblue-12-link" href="allauctions.php?pgno=<?= $i; ?>&<?= $get_param; ?>" style="text-decoration: none;"><?= $i; ?></a></span>
            <?
                                   }
                               }

                               if ($PageNo < $total_pages) {
                                   $npage = $PageNo + 1;
            ?>
                                   <span> |<a class="darkblue-12-link" href="allauctions.php?pgno=<?= $npage;
            ?>&<?= $get_param; ?>" style="text-decoration: none;">&gt;</a></span>
                        <a class="darkblue-12-link" href="allauctions.php?pgno=<?= $total_pages; ?>&<?= $get_param; ?>" style="text-decoration: none;">&gt;&gt;</a>
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
