<?
$total_per_ini = 10;
$max_pages = 100;
$items_per_page = 5;

$id = ( $id == 0 && $aid > 0 ) ? $aid : $id;

if (isset($_GET['pgno'])) {
    $PageNo = chkInput($_GET['pgno'], 'i');
    $PageNo = $PageNo > 0 ? $PageNo : 1;
} else {
    $PageNo = 1;
}

$from = $PageNo > 1 ? ($PageNo - 1) * $items_per_page : 0;

if ($searchdata != "") {
    $qryselC1 = "select count(*) as total from auction a left join products p on a.productID=p.productID " .
            "left join categories c on p.categoryID=c.categoryID left join auc_due_table adt on a.auctionID=adt.auction_id " .
            "where a.auc_status='2' and p.name like '%$searchdata%'";

    $qrysel1 = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,c.name as catname,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,halfbackauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
            "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join categories c on p.categoryID=c.categoryID " .
            "left join auc_due_table adt on a.auctionID=adt.auction_id " .
            "where a.auc_status='2' and p.name like '%$searchdata%' and a.uniqueauction=0 order by adt.auc_due_time limit $from, $items_per_page";
} else {
    if ($aid > 0) {
        $qryselC1 = "select count(*) as total from auction a left join auc_due_table adt on a.auctionID=adt.auction_id " .
                "where a.auc_status='$aid' and adt.auc_due_time!=0 and a.uniqueauction=0";

        $qrysel1 = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,c.name as catname,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
                "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
                "left join categories c on p.categoryID=c.categoryID left join auc_due_table adt on a.auctionID=adt.auction_id " .
                "where a.auc_status='$aid' and adt.auc_due_time!=0 and a.uniqueauction=0 order by adt.auc_due_time limit $from, $items_per_page";
    } else {
        $qryselC1 = "select count(*) as total from auction where auc_status='2' and categoryID=$id and uniqueauction=0";

        $qrysel1 = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,c.name as catname,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,seatbids,lockauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
                "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join categories c on p.categoryID=c.categoryID " .
                "left join auc_due_table adt on a.auctionID=adt.auction_id where a.auc_status='2' and a.categoryID=$id and a.uniqueauction=0 order by adt.auc_due_time " .
                "limit $from, $items_per_page";
    }
}


$resultC1 = db_query($qryselC1) or die("1:====" . db_error());
$totalC1 = db_result($resultC1, 0);
db_free_result($resultC1);

$ressel1 = db_query($qrysel1) or die("2:====" . db_error());

$total_pages = ceil($totalC1 / $items_per_page); // Figure out the total number of pages. Always round up using ceil()

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
<?php if ($totalC1 > 0) { ?>
    <div id="live-auctions">
        <div id="live-auctions-head">
            <h2><?php echo LIVE_AUCTIONS; ?></h2>
    </div>
    <div id="live-th">
        <div id="product_title"><?php echo PRODUCTS; ?></div>
        <div id="price_title"><?php echo PRICE_BIDDER; ?></div>
        <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
    </div>

    <?php
            while ( ( $objauc = db_fetch_array($ressel1) ) ) {

  $seatauction = $objauc['seatauction'];
                                if ($seatauction == true && $objauc['seatcount'] >= $objauc['minseats']) {
                                    $seatauction = false;
                                }

                                $pname = $objauc['bidpack'] ? $objauc['bidpack_name'] : $objauc['name'];
                                $picture = $objauc['bidpack'] ? $objauc['bidpack_banner'] : $objauc['picture1'];
                                $price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];
            
    ?>
                    <div class="auction-item" title="<?php echo $objauc["auctionID"]; ?>" id="auction_<?php echo $objauc["auctionID"]; ?>">
                        <div class="live-auction" style="background-color: white;">
                            <a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $objauc["picture1"]; ?>);"></a>
                            <div class="live-a-content">
                                <h2>
                                    <a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>"><?php echo stripslashes($objauc["name"]); ?></a>
                                </h2>
                                <p><?php echo stripslashes($objauc['short_desc']); ?></p>
                            </div>
                            <div class="price-bidder">
                                <label id="price_index_page_<?php echo $objauc["auctionID"]; ?>">---</label>
                                <span id="value_index_page_<?php echo $objauc["auctionID"]; ?>"><?php echo $Currency . $objauc['price']; ?></span>
                                <label class="winner" id="product_bidder_<?php echo $objauc["auctionID"]; ?>">---</label>
                            </div>
                            <div class="countdown" style="margin-top: -14px;">
 

 
 <div id="normal_panel_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">

                                <label class="timer time-left" id="counter_index_page_<?php echo $objauc["auctionID"]; ?>">
                                    <script language='javascript' type='text/javascript'>
                                        document.getElementById('counter_index_page_<?php echo $objauc["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $objauc["auc_due_time"]; ?>');
                                    </script>
                                </label>
</div>


 <?php if ($seatauction) {
                            ?>
                                    <div class="seat_panel" style="font-size:10px;"
 id="seat_panel_<?php echo $objauc["auctionID"]; ?>">
                                        <div class="seat_bar" id="seat_bar_<?php echo $objauc["auctionID"]; ?>">
                                        </div>

                                        <div class="seat_count">
                                            <span id="seat_count_<?php echo $objauc["auctionID"]; ?>">-</span>/<span><?php echo $objauc['minseats']; ?></span>
                                        </div>
                                        <div class="seat_text1"><?php echo SEATS_AVAILABLE; ?></div>
                                        <div class="seat_text2" style="line-height:1em;">
                                    <?php echo SEAT_AUCTION_DESCRIPTION; ?>
                                </div>
                                <div class="seat_text3">
                                    <?php echo FROM_W; ?>:<span><?php echo $Currency . $objauc['auc_start_price'] ?></span>&nbsp;&nbsp;
                                    <?php echo SEAT_BIDS; ?>:<span><?php echo $objauc['seatbids'] ?></span>
                                </div>
                            </div>

                            <?php }
                            ?>






                                
                                 <?php if ($uid == 0) {
                            ?>


                                        <a id="image_main_<?php echo $objauc["auctionID"]; ?>" style="font-size:12px;" class="loginfirst_orange" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>


                                      <!--  <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo PLACE_BID; ?></a>-->

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange1" style="font-size:12px;margin-left:-21px;" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo "buy now @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?></a></br>

<?php
}
else
{
?>
<p style="color:red;font-size:12px;">Buy It Now Not Available</p>
<?php
}
?>

                            <?php } else {
                            ?>

                            <?php if ($seatauction == true) {
                            ?>
                                            <div id="seat_button_<?php echo $objauc["auctionID"]; ?>">
                                                <a id="image_main_<?php echo $objauc["auctionID"]; ?>" style="font-size:12px;" class="loginfirst_orange bid-button-link" name="getseat.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>"  class="loginfirst_orange2" style="font-size:12px;margin-left:-21px;" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo "buy now @ " . $Currency . $objauc["buynowprice"];?>')"><?php echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?></a></br>
<?php
}
else
{
?>
<p style="color:red;font-size:12px;">Buy It Now Not Available</p>
<?php
}
?>
                                            </div>
                            <?php } ?>

                                        <div id="normal_button_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">


                                <?php if ($objauc['uniqueauction'] == true) {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid-button-link" style="font-size:12px;" name="getuniquebid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>


<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange2" style="font-size:12px;margin-left:-21px;" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo "buy now @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?>')"><?php echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>
<p style="color:red;font-size:12px;">Buy It Now Not Available</p>
<?php
}
?>

                                <?php } else {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid-button-link" style="font-size:12px;" name="getbid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange2" style="font-size:12px;margin-left:-21px;" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo "buy now @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?>')"><?php echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>
<p style="color:red;font-size:12px;">Buy It Now Not Available</p>
<?php
}
?>


                                <?php } ?>
                                        </div>
                            <?php } ?>
                
















</div>
            

            <div class="clear"></div>
        </div>

    </div>

    <?php
                }
                db_free_result($ressel1);            
            $get_param = $searchdata != "" ? "st=".htmlspecialchars(stripcslashes($searchdata), ENT_QUOTES) : ($aid == 2 ? "aid=2" : "id=$id");
    ?>

            <div id="live-auctions-end">
                <table align="right">
                    <tbody>
                        <tr>
                            <td valign="middle">
                                <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $totalC1 . ' ' . AUCTIONS ?>, <?php echo $PageNo . ' ' . OF . ' ' . $total_pages . ' ' . PAGES; ?> </div>
                            </td>
                            <td width="30">&nbsp;</td>
                            <td valign="middle">
                                <span id="pagination">
                            <?php if ($PageNo > 1) {
                            ?>
                                <a style="width: 50px;" id="prev" href="allauctions.php?pgno=<?php echo $PageNo - 1; ?>&<?=$get_param;?>"><?php echo PREVIOUS; ?></a>
                            <?php } else {
                            ?>
                                <a style="width: 50px;" id="prev"><span style="color: rgb(192, 192, 192);"><?php echo PREVIOUS; ?></span></a>
                            <?php } ?>

                            &nbsp;

                            <?php
                            $pagestart = $PageNo - 3;
                            if ($pagestart < 1) {
                                $pagestart = 1;
                            }

                            $pageend = $pagestart + 7;
                            if ($pageend > $total_pages) {
                                $pageend = $total_pages;
                            }

                            for ($page = $pagestart; $page <= $pageend; $page++) {
                            ?>
                                <a href="allauctions.php?pgno=<?php echo $page; ?>&<?=$get_param;?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                            <?php } ?>


                            <?php if ($PageNo < $total_pages) {
                            ?>
                                <a id="next" href="allauctions.php?pgno=<?php echo $PageNo + 1; ?>&<?=$get_param;?>"><?php echo NEXT; ?></a>
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

<div class="clear"></div>
