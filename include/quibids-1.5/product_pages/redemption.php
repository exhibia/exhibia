
        <div id="pagewidth">
  



            <?php include($BASE_DIR . '/include/' . $template . '/header.php'); ?>

            <div id="container">
                <?php //include("include/topmenu.php"); ?>

 
<!-- ============= End Header =============  -->	
	
  <div id="wrapper" class="clearfix index">
                      
  
<!-- ============= Ending Auctions =============  -->
                    <div id="ending-auctq">
                        

                                                <?php
                        $co = "";
                        if ($totalauc > 0) {
                            $rowindex = 0;
                            $is_first = TRUE;
                            while (( $objauc = db_fetch_array($resauc))) {
                                $co .= ( $is_first ? $objauc["auctionID"] : "," . $objauc["auctionID"]);
                                $is_first = FALSE;

                                $cornerImag = cornerImag($objauc);

                                $seatauction = $objauc['seatauction'];
                                if ($seatauction == true && $objauc['seatcount'] >= $objauc['minseats']) {
                                    $seatauction = false;
                                }

                                $pname = $objauc['bidpack'] ? $objauc['bidpack_name'] : $objauc['name'];
                                $picture = $objauc['bidpack'] ? $objauc['bidpack_banner'] : $objauc['picture1'];
                                $price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];
                        ?>
                                
           
                            
  <?php if ($objauc['uniqueauction'] == false) {

//check a file
if(file_exists($UploadImagePath."products/thumbs_big/thumbbig_".$picture))
{
$getpicture = $picture;
}
else
{
$getpicture = "noimage.jpg";
}

                            ?>

                                    

 <?php }  
?>
                          
                           
<?php if ($cornerImag != '') {
                            ?>
                                    
                            <?php } ?>
                                <!--<h2 class="productname"> -->
                                <?php if ($objauc['uniqueauction'] == false) {
                                ?>
                                    <a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>"><?php //echo stripslashes($objauc["name"]); ?></a>
                                <?php } else {
                                ?>
                                    <a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>"><?php echo stripslashes($pname); ?></a>
                                <?php } ?>
                            </h2>

                            <?php if ($seatauction) {
                            ?>
                                    <div class="seat_panel" style="font-size:10px;"
 id="seat_panel_<?php echo $objauc["auctionID"]; ?>">
                                        <div class="seat_bar" id="seat_bar_<?php echo $objauc["auctionID"]; ?>">
                                        </div>

                                        
                                        <div class="seat_text1"><?php //echo SEATS_AVAILABLE; ?></div>
                                        <div class="seat_text2">
                                    <?php ///echo SEAT_AUCTION_DESCRIPTION; ?>
                                </div>
                                
                            </div>

                            <?php }
                            ?>
                                <div id="normal_panel_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                    
                                    <p class="price">
                                    <?php if ($objauc['uniqueauction'] == false) {
                                    ?>
                                       
                                    <?php } else {
                                    ?>
                                        
                                    <?php } ?>
                                </p>
                            </div>

                            

                            <?php if ($objauc['uniqueauction'] == false) {

                            ?>


                                        <div>


                     
<?php }   else {
                            ?>

<ol class="top-bidders i3" id="topbider_index_page_<?php echo $objauc["auctionID"]; ?>">
                                           
                                            
                                        </ol>

<ol class="winner" id="product_bidder_<?php echo $objauc["auctionID"]; ?>">
                                            <li><label><?php //echo INPUT_YOUR_PRICE; ?>:</label></li>
                                            <li><input id="lowestprice_<?php echo $objauc["auctionID"]; ?>" <?php echo $uid == 0 ? 'disabled' : ''; ?> name="lowestprice_<?php echo $objauc["auctionID"]; ?>"/></li>
                                        </ol>
<?php } ?>


                            <?php if ($uid == 0) {
                            ?>


                                        <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orangez" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php //echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php //echo LOGIN; ?>')"><?php //echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>


                                      <!--  <a id="image_main_<?php //echo $objauc["auctionID"]; ?>" class="loginfirst_orangez" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php //echo PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php //echo PLACE_BID; ?></a>-->

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orangez" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php //echo "buy now @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php //echo LOGIN; ?>')"><?php //echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>

<?php
}
?>

                            <?php } else {
                            ?>

                            <?php if ($seatauction == true) {
                            ?>
                                            <div id="seat_button_<?php echo $objauc["auctionID"]; ?>">
                                                <a id="image_main_<?php //echo $objauc["auctionID"]; ?>" class="loginfirst_orangez bid-button-link" name="getseat.php?prid=<?php //echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php //echo BUY_A_SEAT; ?></a>

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orangez" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php //echo "buy now @ " . $Currency . $objauc["buynowprice"];?>')"><?php //echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>

<?php
}
?>
                                            </div>
                            <?php } ?>

                                        <div id="normal_button_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                <?php if ($objauc['uniqueauction'] == true) {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orangez bid-button-link" name="getuniquebid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php //echo PLACE_BID; ?></a>


<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orangez" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php //echo "buy now @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?>')"><?php //echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>

<?php
}
?>

                                <?php } else {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orangez bid-button-link" name="getbid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php //echo PLACE_BID; ?></a>

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orangez" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo "buy now @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php //echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?>')"><?php //echo "buy now @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>

<?php
}
?>


                                <?php } ?>
                                        </div>
                            <?php } ?>

                                </div><!-- /auction-item -->

                        <?php if ($rowindex % 5 == 0)
                                        echo '<div class="clear"></div>'; ?>
                        <?php
                                }
                            } else {
                        ?>
                                <div style="height: 45px; clear: both;">&nbsp;</div>

                                <div align="center" class="darkblue-14"><?php echo NO_LIVE_AUCTIONS_TO_DISPLAY; ?></div>

                                <div style="height: 15px;clear: both;">&nbsp;</div>
                        <?php
                            }
                            db_free_result($resauc);
                        ?>
                                <div class="clear"></div>
                                
                            
                            </div>
 <!-- ============= End Ending Auctions =============  -->

 <div class="clear"></div>
                            <!-- ============= Live Auctions =============  -->
                            <div id="live-auctions">
                                <div id="live-auctions-head">
                                    <h3><?php echo REDEMPTION; ?></h3>
                                </div>
                                <div id="live-th">
                                    <div id="product_title"><?php echo PRODUCTS; ?></div>
                                    <div id="price_title"><?php echo PRICE_BIDDER; ?></div>
                                    <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
                                </div>

                        <?php
                                $totalauc2 = 0;

                                if ($co != "") {

                                   // $qryauc2 = "select //auctionID,seatauction,allowbuynow,auc_start_price,buynowprice,picture1, name, short_desc, price, //auc_due_time, p.productID " . "from auction a left join products p on a.productID=p.productID left //join auc_due_table adt on a.auctionID=adt.auction_id " . "where a.auctionID not in (" . $co . ") //and adt.auc_due_time!=0 and a.auc_status=2 order by adt.auc_due_time limit 0, 30";


$qryauc2 ="select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a " .
        "left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id " .
        "where a.use_free='1' and adt.auc_due_time!=0 and a.auc_status='2' order by adt.auc_due_time limit 0, $featuredcount";








                                    $resauc2 = db_query($qryauc2);

                                    $totalauc2 = db_num_rows($resauc2);
                                }
                                if ($totalauc2 > 0) {
                                    while (( $objauc2 = db_fetch_array($resauc2))) {

 $co .= ( $is_first ? $objauc2["auctionID"] : "," . $objauc2["auctionID"]);
                                $is_first = FALSE;

                                $cornerImag = cornerImag($objauc2);



 $seatauction2 = $objauc2['seatauction'];
                                if ($seatauction2 == true && $objauc2['seatcount'] >= $objauc2['minseats']) {
                                    $seatauction2 = false;
                                }

                                $pname = $objauc['bidpack'] ? $objauc['bidpack_name'] : $objauc['name'];
                                $picture = $objauc['bidpack'] ? $objauc['bidpack_banner'] : $objauc['picture1'];
                                $price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];
 

                        ?>


                                        <div class="auction-item" title="<?php echo $objauc2["auctionID"]; ?>" id="auction_<?php echo $objauc2["auctionID"]; ?>">




                                            <div class="live-auction" style="background-color: white;">
                                                <a href="viewproduct.php?aid=<?php echo $objauc2["auctionID"]; ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $objauc2["picture1"]; ?>);"></a>
  
<?php if ($cornerImag != '') {
                            ?>
                                    <div class="corner_image1">
                                        <img src="img/icons/<?php echo $cornerImag; ?>"  alt="" style="margin-left: -122px;
margin-bottom: -73px;margin-top: -1px;
"/>
                                    </div>
                            <?php } ?>






                                                <div class="live-a-content">
                                                    <h2>
                                                        <a href="viewproduct.php?aid=<?php echo $objauc2["auctionID"]; ?>"><?php echo stripslashes($objauc2["name"]); ?></a>
                                                    </h2>
                                                    <p><?php echo stripslashes($objauc2['short_desc']); ?></p>
                                                </div>
                                                <div class="price-bidder">
                                                    <label id="price_index_page_<?php echo $objauc2["auctionID"]; ?>">---</label>
                                                    <span id="value_index_page_<?php echo $objauc2["auctionID"]; ?>"><?php echo $Currency . $objauc2['price']; ?></span>
                                                    <label class="winner" id="product_bidder_<?php echo $objauc2["auctionID"]; ?>">---</label>
                                                </div>
 



                                                <div class="countdown" style="margin-top:-18px;">

<div id="normal_panel_<?php echo $objauc2["auctionID"]; ?>" style="display:<?php echo $seatauction2 == true ? 'none' : 'block'; ?>">

                                                    <label class="timer time-left" id="counter_index_page_<?php echo $objauc2["auctionID"]; ?>">
                                                        <script language='javascript' type='text/javascript'>
                                                            document.getElementById('counter_index_page_<?php echo $objauc2["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $objauc2["auc_due_time"]; ?>');
                                                        </script>
                                                    </label>
</div>

  <?php if ($seatauction2) {
                            ?>
                                    <div class="seat_panel" style="font-size:10px;line-height:1em;"
 id="seat_panel_<?php echo $objauc2["auctionID"]; ?>">
                                        <div class="seat_bar" id="seat_bar_<?php echo $objauc2["auctionID"]; ?>">
                                        </div>

                                        <div class="seat_count">
                                            <span id="seat_count_<?php echo $objauc2["auctionID"]; ?>">-</span>/<span><?php echo $objauc2['minseats']; ?></span>
                                        </div>
                                        <div class="seat_text1"><?php echo SEATS_AVAILABLE; ?></div>
                                        <div class="seat_text2">
                                    <?php echo SEAT_AUCTION_DESCRIPTION; ?>
                                </div>
                                <div class="seat_text3">
                                    <?php echo FROM_W; ?>:<span><?php echo $Currency . $objauc2['auc_start_price'] ?></span>&nbsp;&nbsp;
                                    <?php echo SEAT_BIDS; ?>:<span><?php echo $objauc2['seatbids'] ?></span>
                                </div>
                            </div>

                            <?php }
                            ?>


                                                    <div class="buttonoffset">
                                        <?php if ($uid == 0) {
                            ?>


                                        <a id="image_main_<?php echo $objauc2["auctionID"]; ?>"  style="font-size:12px;" class="loginfirst_orange" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo $seatauction2 == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction2 == true ? BUY_A_SEAT : PLACE_BID; ?></a>


                                      <!--  <a id="image_main_<?php echo $objauc2["auctionID"]; ?>" class="loginfirst_orange" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo PLACE_BID; ?></a>-->

<?php
//Buy it now

if($objauc2['allowbuynow']==true)
{
?>

<a id="image_main_<?php echo $objauc2["auctionID"]; ?>" style="font-size:12px;margin-left:-17px;" class="loginfirst_orange1" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo "buy now @ " . $Currency . $objauc2["buynowprice"];?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo "buy now @ ".$Currency . $objauc2["buynowprice"]; ?></a>

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

                            <?php if ($seatauction2 == true) {
                            ?>
                                            <div id="seat_button_<?php echo $objauc2["auctionID"]; ?>">
                                                <a id="image_main_<?php echo $objauc2["auctionID"]; ?>" style="font-size:12px;margin-left:16px;" class="loginfirst_orange bid-button-link" name="getseat.php?prid=<?php echo $objauc2["productID"]; ?>&aid=<?php echo $objauc2["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>

<?php
//Buy it now

if($objauc2["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc2["auctionID"]; ?>" style="font-size:12px;margin-left:-17px;" class="loginfirst_orange2" href="buyitnow.php?auctionId=<?php echo $objauc2["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo "buy now @ " . $Currency . $objauc2["buynowprice"];?>')"><?php echo "buy now @ ".$Currency . $objauc2["buynowprice"]; ?></a>

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

                                        <div id="normal_button_<?php echo $objauc2["auctionID"]; ?>" style="display:<?php echo $seatauction2 == true ? 'none' : 'block'; ?>">
                                <?php if ($objauc2['uniqueauction'] == true) {
                                ?>
                                            <a id="image_main_<?php echo $objauc2["auctionID"]; ?>" style="font-size:12px;" class="loginfirst_orange bid-button-link" name="getuniquebid.php?prid=<?php echo $objauc2["productID"]; ?>&aid=<?php echo $objauc2["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>


<?php
//Buy it now

if($objauc2["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc2["auctionID"]; ?>" style="font-size:12px;margin-left:-17px;" class="loginfirst_orange2" href="buyitnow.php?auctionId=<?php echo $objauc2["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo "buy now @ " . $Currency . $objauc2["buynowprice"];?>')" onmouseover="$(this).text('<?php echo "buy now @ ".$Currency . $objauc2["buynowprice"]; ?>')"><?php echo "buy now @ ".$Currency . $objauc2["buynowprice"]; ?></a>

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
                                            <a id="image_main_<?php echo $objauc2["auctionID"]; ?>" style="font-size:12px;" class="loginfirst_orange bid-button-link" name="getbid.php?prid=<?php echo $objauc2["productID"]; ?>&aid=<?php echo $objauc2["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

<?php
//Buy it now

if($objauc2["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc2["auctionID"]; ?>" class="loginfirst_orange1" style="font-size:12px;margin-left:-17px;" href="buyitnow.php?auctionId=<?php echo $objauc2["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo "buy now @ " . $Currency . $objauc2["buynowprice"];?>')" onmouseover="$(this).text('<?php echo "buy now @ ".$Currency . $objauc2["buynowprice"]; ?>')"><?php echo "buy now @ ".$Currency . $objauc2["buynowprice"]; ?></a>

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
                                </div>

                                <div class="clear"></div>
                            </div>

                        </div>

                        <?php
                                    }
                                    db_free_result($resauc2);
                                }
                        ?>

                                <div id="live-auctions-end"><a href="allauctions.php?aid=2" class="view-all-btn"><?php echo VIEW_ALL_LIVE_AUCTIONS; ?></a></div>
                            </div>
                            <!-- ============= End Live Auctions =============  -->
                        </div>
                    </div>
                    <div id="wrap-end">

                    </div>
                </div>
	</div>
        <?php include $BASE_DIR . '/include/' . $template . '/footer.php' ?>
        <script type="text/javascript">
            <!--
           // swfobject.registerObject("FlashID1");
            //-->
        </script>
        <span id="usedflash" style="display:none;"></span>
  
