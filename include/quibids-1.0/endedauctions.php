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
    <div id="live-auctions">
        <div id="live-auctions-head">
            <h2><?php echo ENDED_AUCTIONS; ?></h2>
        </div>
        <div id="live-th">
            <div id="product_title"><?php echo PRODUCTS; ?></div>
            <div id="price_title"><?php echo PRICE_BIDDER; ?></div>
            <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
        </div>

    <?php
    while (( $obj = db_fetch_array($ressel2))) {


        $pname = $obj['bidpack'] ? $obj['bidpack_name'] : $obj['name'];
        $obj['picture1'] = $obj['bidpack'] ? $obj['bidpack_banner'] : $obj['picture1'];
        $obj['price'] = $obj['bidpack'] ? $obj['bidpack_price'] : $obj['price'];
        $obj['short_desc'] = $obj['bidpack'] ? "{$obj['bid_size']} Bids and {$obj['freebids']} Freebids" : $obj['short_desc'];




                        $cornerImag = cornerImag($obj);

        if ($obj["fixedpriceauction"] == 1) {
            $fprice = $obj["auc_fixed_price"];
        } else {
            $fprice = $obj["offauction"] == 1 ? "0.00" : $obj["auc_final_price"];
        }
try{
if(!empty($obj['price'])){
        $saving_percent =  (@ $obj["price"] - (@ $obj["bidcount"] * 0.50) - @ $fprice);


	  $saving_percent = $saving_percent * 100 / @ $obj["price"] . '%';
}else{

 $saving_percent =  'no data avail.';
}
}catch (Exception $e) { 

}


if(empty($obj['picture1'])){


$obj['picture1'] = 'no_image.jpg';


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
                <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>" class="thumb" style="background-image: url('<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $obj["picture1"]; ?>');"></a>
                <div class="live-a-content">
                    <h3>
                        <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>"><?php echo $pname; ?></a>
                    </h3>
                    <p><?php echo stripslashes($obj['short_desc']); ?></p>
                </div>
                <div class="price-bidder">
                    <span >
                    <?php echo SAVINGS; ?>
                                        <span><font id="value_index_page_<?php echo $obj["auctionID"]; ?>">---</font><?php if($obj["buy_user"] != "0"){ echo $saving_percent;} ?></span>
                </span>
                <label class="winner" id="product_bidder_<?php echo $obj["auctionID"]; ?>">
                                    <?=($obj["buy_user"] != "0" ? htmlspecialchars(stripslashes($obj["username"]), ENT_QUOTES) : "---"); ?>
                </label>
            </div>
            <div class="countdown">
                <label class="timer time-left" id="counter_index_page_<?php echo $obj["auctionID"]; ?>">
                      <?php echo END_DATE; ?>:<br /><?= enddatefunction($obj["auc_final_end_date"]) . ' ' . substr($obj["auc_final_end_date"], 10); ?>
                </label>

            </div>

            <div class="clear"></div>
        </div>

    </div>

    <?php
                }
                db_free_result($ressel2);
                $get_param = $aid == 3 ? "aid=3" : "id=$id";
    ?>

                <div id="live-auctions-end">
                    <table align="right">
                        <tbody>
                            <tr>
                                <td valign="middle">
                                    <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $totalC2 . ' ' . AUCTIONS ?>, <?php echo $PageNo2 . ' ' . OF . ' ' . $total_pages2 . ' ' . PAGES; ?> </div>
                                </td>
                                <td width="30">&nbsp;</td>
                                <td valign="middle">
                                    <span id="pagination">
                            <?php if ($PageNo2 > 1) {
                            ?>
                                <a style="width: 50px;" id="prev" href="allauctions.php?pgno2=<?php echo $PageNo2 - 1; ?>&<?=$get_param; ?>"><?php echo PREVIOUS; ?></a>
                            <?php } else {
                            ?>
                                <a style="width: 50px;" id="prev"><span style="color: rgb(192, 192, 192);"><?php echo PREVIOUS; ?></span></a>
                            <?php } ?>

                            &nbsp;

                            <?php
                            $pagestart = $PageNo2 - 3;
                            if ($pagestart < 1) {
                                $pagestart = 1;
                            }

                            $pageend = $pagestart + 7;
                            if ($pageend > $total_pages2) {
                                $pageend = $total_pages2;
                            }

                            for ($page = $pagestart; $page <= $pageend; $page++) {
                            ?>
                                <a href="allauctions.php?pgno2=<?php echo $page; ?>&<?=$get_param; ?>" class="<?php echo $page == $PageNo2 ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                            <?php } ?>


                            <?php if ($PageNo2 < $total_pages2) {
                            ?>
                                <a id="next" href="allauctions.php?pgno2=<?php echo $PageNo2 + 1; ?>&<?=$get_param; ?>"><?php echo NEXT; ?></a>
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
