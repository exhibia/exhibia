<style>
#login {
position:absolute;
left:595px;
}
#right-social {
    left: 755px;
    position: absolute;
    top: 160px;
    width: 200px;
}
</style>

        <div id="pagewidth">
        <div id="main" >
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
           
            
                <?php //include("include/topmenu.php"); ?>

 
                <div id="maincol">
                  
<!-- ============= End Header =============  -->	
	
  <div id="wrapper" class="clearfix index">
  
<?php include("$BASE_DIR/include/addons/slider/$template/index.php"); ?>
<?php  include("$BASE_DIR/include/addons/steps_box/$template/index.php"); ?>
                      
  
<!-- ============= Ending Auctions =============  -->
                    <div id="ending-auct">
                        <div id="ending-auct-head">
                            <h3><?php echo ENDING_AUCTIONS; ?></h3>
                            <h4 style="font-weight:bold;font-size:18px;"><?php echo BID_NOW; ?> - <?php echo THESE_AUCTIONS_ARE_ABOUT_TO_END; ?></h4>
                        </div>

                      <?php
                        $co = "";
                        if ($totalauc > 0) {
                            $rowindex = 0;
                            $is_first = TRUE;
                            while (( $objauc = db_fetch_array($resauc))) {
                                $co .= ( $is_first ? $objauc["auctionID"] : "," . $objauc["auctionID"]);
                                $is_first = FALSE;

                                $cornerImag = cornerImag($objauc);

if(!empty($objauc['bidpack_name'])){

                                 $objauc['name'] = $objauc['bidpack_name'];
                                 $objauc['picture1'] = $objauc['bidpack_banner'];
}

$price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];

$picture = $objauc['picture1'];
                        ?>
                                <div class="endinng-auction auction-item <?php echo (++$rowindex) % 5 == 0 ? 'last' : ''; ?>" title="<?php echo $objauc["auctionID"]; ?>" id="auction_<?php echo $objauc["auctionID"]; ?>" onclick="<?php echo $objauc["auc_due_price"]; ?>" >
                                    <p class="prodtitle"><b><?php echo stripslashes($objauc["name"]); ?></b></p>
                            
  <?php //if ($objauc['uniqueauction'] == false) {

//check a file

$getpicture = "thumb_" . $picture;


                            ?>


 <?php //}  
?>
                          
                           
<?php if ($cornerImag != '') {

                            ?>
                                       <div class="corner_imagev">
                                        <img src="include/addons/icons/quibids-1.0/<?php echo $cornerImag; ?>"  alt=""/>
                                    </div>
                            <?php } ?>
                            <span  style="position:relative;top:-30px;">

                                    <a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>">

                                        <img src="<?php echo $UploadImagePath; ?>products/thumbs/<?php echo $getpicture;?>" border="0"  alt="" class="" />

                                  </a>
                                  <div class="clear"></div>
                                <!--<h2 class="productname"> -->
                                <?php if ($objauc['uniqueauction'] == false) {
                                ?>
                                    <a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>" class=""><?php echo substr(stripslashes($objauc["name"]),0 , 25); ?></a>
                                <?php } else {
                                ?>
                                    <a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>" class=""><?php echo substr(stripslashes($pname), 0, 25); ?></a>
                                <?php } ?>
                          <!--  </h2>-->

                            <?php if ($seatauction) {
                            ?>
                                    <div class="seat_panel" style="font-size:10px;" id="seat_panel_<?php echo $objauc["auctionID"]; ?>">
                                        <div class="seat_bar" id="seat_bar_<?php echo $objauc["auctionID"]; ?>">
                                        </div>

                                        <div class="seat_count">
                                            <span id="seat_count_<?php echo $objauc["auctionID"]; ?>">-</span>/<span><?php echo $objauc['minseats']; ?></span>
                                        </div>
                                        <div class="seat_text1"><?php echo SEATS_AVAILABLE; ?></div>
                                        <div class="seat_text2">
                                    <?php echo SEAT_AUCTION_DESCRIPTION; ?>
                                </div>
                                <div class="seat_text3">
                                    <?php echo FROM_W; ?>:<span><?php echo $Currency . $objauc['auc_start_price'] ?></span>&nbsp;&nbsp;
                                    <?php echo SEAT_BIDS; ?>:<span><?php echo $objauc['seatbids'] ?></span>
                                </div>
                            </div>

                            <?php }
                            ?>
                                <div id="normal_panel_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                    <label id="counter_index_page_<?php echo $objauc["auctionID"]; ?>" class="endingtimer timer time-left">
                                                       
                                                    </label>
				<script language="javascript" type="text/javascript">
					document.getElementById('counter_index_page_<?php echo $objauc["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $objauc["auc_due_time"]; ?>', 'counter_index_page_<?php echo $objauc["auctionID"]; ?>');


                                </script>
                                    <p class="price">
                                    <?php if ($objauc['uniqueauction'] == false) {
                                    ?>
                                        <span id="currencysymbol_<?php echo $objauc["auctionID"]; ?>"></span><span id="price_index_page_<?php echo $objauc["auctionID"]; ?>">---</span><strong><?php echo $CurrencyName; ?></strong>
                                    <?php } else {
                                    ?>
                                        <span id="ubid_index_page_<?php echo $objauc["auctionID"]; ?>">---</span><strong>&nbsp;<?php echo BIDS; ?></strong>
                                    <?php } ?>
                                </p>
                            </div>

                            <small class="bidvalue"><?php echo VALUE; ?>: <?php echo $Currency;?><span id="value_index_page_<?php echo $objauc["auctionID"]; ?>"><?php echo $price; ?></span> <?php echo $CurrencyName; ?></small>

                            <?php if ($objauc['uniqueauction'] == false) {

                            ?>


                                        <div>
<label class="winner" id="product_bidder_<?php echo $objauc["auctionID"]; ?>">---</label></div>

                     
<?php }   else {
                            ?>

<ol class="top-bidders i3" id="topbider_index_page_<?php echo $objauc["auctionID"]; ?>">
                                            <li>---</li> 
                                            
                                        </ol>

<ol class="winner" id="product_bidder_<?php echo $objauc["auctionID"]; ?>">
                                            <li><label><?php echo INPUT_YOUR_PRICE; ?>:</label></li>
                                            <li><input id="lowestprice_<?php echo $objauc["auctionID"]; ?>" <?php echo $uid == 0 ? 'disabled' : ''; ?> name="lowestprice_<?php echo $objauc["auctionID"]; ?>"/></li>
                                        </ol>
<?php } ?>


                            <?php if ($uid == 0) {
                            ?>


                                        <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>


                                      <!--  <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo PLACE_BID; ?></a>-->

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange1" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo BUY_NOW. " @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo BUY_NOW . " @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>
<!--<p style="color:red;"><?php echo BUY_IT_NOW_UNAVAILABLE;?></p>-->
<?php
}
?>


                            <?php } else {
                            ?>

                            <?php if ($seatauction == true) {
                            ?>
                                            <div id="seat_button_<?php echo $objauc["auctionID"]; ?>">
                                                <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid-button-link" name="getseat.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange2" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo BUY_NOW . " @ " . $Currency . $objauc["buynowprice"];?>')"><?php echo BUY_NOW . " @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>
<!--<p style="color:red;">Buy It Now Not Available</p>-->
<?php
}
?>
                                            </div>
                            <?php } ?>

                                        <div id="normal_button_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                <?php if ($objauc['uniqueauction'] == true) {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid-button-link" name="getuniquebid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" style="padding-bottom:20px;"><?php echo PLACE_BID; ?></a>


<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange2" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo BUY_NOW. " @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php echo BUY_NOW ." @ ".$Currency . $objauc["buynowprice"]; ?>')"><?php echo BUY_NOW . " @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>
<!--<p style="color:red;">Buy It Now Not Available</p>-->
<?php
}
?>

                                <?php } else {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid-button-link" name="getbid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange2" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo BUY_NOW . " @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php echo BUY_NOW . " @ ".$Currency . $objauc["buynowprice"]; ?>')"><?php echo BUY_NOW . " @ ".$Currency . $objauc["buynowprice"]; ?></a>

<?php
}
else
{
?>
<!--<p style="color:red;">Buy It Now Not Available</p>-->
<?php
}
?>


                                <?php } ?>
                                        </div>
                            <?php } ?>
</span>
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
                                <a href="allauctions.php?aid=2" class="view-all-btn"><?php echo VIEW_ALL_LIVE_AUCTIONS; ?></a>
                                <div id="ending-auct-end"></div>    
                            </div>
                           
 <!-- ============= End Ending Auctions =============  -->

 <div class="clear"></div>
                            <!-- ============= Live Auctions =============  -->
                            <div id="live-auctions">
                                <div id="live-auctions-head">
                                    <h3><?php echo OTHER_AUCTIONS; ?></h3>
                                </div>
                                <div id="live-th">
                                    <div id="product_title"><?php echo PRODUCTS; ?></div>
                                    <div id="price_title"><?php echo PRICE_BIDDER; ?></div>
                                    <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
                                </div>

                        <?php
                                $totalauc2 = 0;

                                if ($co = "") {

                                    $qryauc2 = "select auctionID, picture1, name, short_desc, price, auc_due_time, p.productID " . "from auction a left join products p on a.productID=p.productID left join auc_due_table adt on a.auctionID=adt.auction_id " . "where a.auctionID not in (" . $co . ") and adt.auc_due_time!=0 and a.auc_status=2 order by adt.auc_due_time limit 0, 30";

                                    $resauc2 = db_query($qryauc2);

                                    $totalauc2 = db_num_rows($resauc2);
                                }
                                if ($totalauc2 > 0) {
                                    while (( $objauc2 = db_fetch_array($resauc2))) {
                        ?>


                                        <div class="auction-item" title="<?php echo $objauc2["auctionID"]; ?>" id="auction_<?php echo $objauc2["auctionID"]; ?>">
                                            <div class="live-auction">
                                                <a href="viewproduct.php?aid=<?php echo $objauc2["auctionID"]; ?>" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $objauc2["picture1"]; ?>);"></a>
                                                <div class="live-a-content">
                                                    <h2>
                                                        <a href="viewproduct.php?aid=<?php echo $objauc2["auctionID"]; ?>"><?php echo stripslashes($objauc2["name"]); ?></a>
                                                    </h2>
                                                    <p><?php echo substr(stripslashes($objauc2['short_desc']), 0 , 20 ); ?></p>
                                                </div>
                                                <div class="price-bidder">
                                                    <label id="price_index_page_<?php echo $objauc2["auctionID"]; ?>">---</label>
                                                    <span id="value_index_page_<?php echo $objauc2["auctionID"]; ?>"><?php echo $Currency . $objauc2['price']; ?></span>
                                                    <label class="winner" id="product_bidder_<?php echo $objauc2["auctionID"]; ?>">---</label>
                                                </div>
 
                                                <div class="countdown">
                                                    <label class="timer time-left" id="counter_index_page_<?php echo $objauc2["auctionID"]; ?>">
                                                        <script language='javascript' type='text/javascript'>
                                                           document.getElementById('counter_index_page_<?php echo $objauc2["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $objauc2["auc_due_time"]; ?>', 'counter_index_page_<?php echo $objauc["auctionID"]; ?>');
                                      

//update_time('counter_index_page_<?php echo $objauc2["auctionID"]; ?>', '<?php echo $objauc2["auc_due_time"]; ?>');
                                                        </script>
                                                    </label>
                                                    <div class="buttonoffset">
                                        <?php if ($uid == 0) {
                                        ?>
                                            <a id="image_main_<?php echo $objauc2["auctionID"]; ?>" class="loginfirst" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo PLACE_BID; ?></a>

                                        <?php } else {
                                        ?>
                                            <a id="image_main_<?php echo $objauc2["auctionID"]; ?>" class="loginfirst bid-button-link" name="getbid.php?prid=<?php echo $objauc2["productID"]; ?>&aid=<?php echo $objauc2["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

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
                  
                </div>

        <?php include("$BASE_DIR/include/$template/footer.php") ?>
        <script type="text/javascript">
            <!--
           // swfobject.registerObject("FlashID1");
            //-->
        </script>
        <span id="usedflash" style="display:none;"></span>

    



