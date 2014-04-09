
        <div id="pagewidth">
        
        
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->
           
	    <div id="wrapper" >            
                   
                            <?php include("$BASE_DIR/include/addons/slider/$template/index.php"); ?>
		<div id="maincol">                     
<!-- ============= Steps =============  -->
                    <div id="steps">
                        <div id="bid-win">
                            <div class="bid-win-text">
                                <span><?php echo BID_NOW; ?></span><br/>
                                <div><?php echo EXCITING_PRODUCTS; ?></div>
                            </div>                           

                            <a href="registration.php" id="register_btn">
                                <?php echo REGISTER; ?>
                            </a>
                        </div>
                        <ul>
                            <li id="step1">
			      
			      <p id="step1-p1"></p>
                                <h4 id="step1-p2"></h4>
                                <span id="step1-span"><?php echo BID_PRICE;?></span>
                            </li>
                            <li id="step2">
			      <p id="step2-p1"></p>
                                <h4 id="step2-p2"></h4>
                                <span id="step2-span"><?php echo PICK_A_PRODUCT;?></span>
                            </li>
                            <li id="step3">
			      <p id="step3-p1"></p>
                                <h4 id="step3-p2"></h4>
                                <span id="step3-span"><?php echo IF_LAST;?></span>
                            </li>
                        </ul>
                    </div>
                    <!-- ============= End Steps =============  -->


                    <!-- ============= Ending Auctions =============  -->
                    <div id="ending-auct">
                        <div id="ending-auct-head">
                            <h3><?php echo ENDING_AUCTIONS; ?></h3>
                            <h4><?php echo BID_NOW; ?> - <?php echo THESE_AUCTIONS_ARE_ABOUT_TO_END; ?></h4>
                        </div>

                        <?php
                        
                        
$featuredcount = Sitesetting::getFeaturedAuctionCount();

//if ( $_GET["ref"] != "" ) $_SESSION["refid"] = $_GET["ref"];
//first six products get by this query

$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,bid_size,freebids,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a " .
        "left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id " .
        "where a.use_free='' and adt.auc_due_time>0 and a.auc_status='2' ";
        if(!empty($co)){
        $qryauc .= " and a.auctionID not in ( " . rtrim($co, ",") . " )";
        }
        
	  $qryauc .= " order by adt.auc_due_time limit 0, $featuredcount";

$resauc = db_query($qryauc) or die(db_error());

$totalauc = db_num_rows($resauc);
                                
                                if ($totalauc > 0) {
                                    $rowindex = 0;
                                    $is_first = TRUE;
                                    while (( $objauc = db_fetch_array($resauc))) {
                                    
				      if ($co == ''){
					  $co.=$objauc["auctionID"];
				      }else{
					  $co.="," . $objauc["auctionID"];
				      }

                                $cornerImag = cornerImag($objauc);

                               $seatauction = $objauc['seatauction'];
                                if ($seatauction == true && $objauc['seatcount'] >= $objauc['minseats']) {
                                    $seatauction = false;
                                }
                                
				$pname = $objauc['bidpack'] ? $objauc['bidpack_name'] : $objauc['name'];

				$pname = substr($pname, 0 , 25);
                                $picture = $objauc['bidpack'] ? $objauc['bidpack_banner'] : $objauc['picture1'];

                                $price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];
                                
                                if($objauc['bidpack'] == true){
                                
                                 $short_desc = $objauc['bid_size'] . " Bids";
                                 
				  if(!empty($objauc['freebids'])){  $short_desc .= $objauc['freebids'] . " Free Bids"; }
                                
                                }else{
                                
     
				    $short_desc = $objauc['short_desc'];
				}
     


				?>
                                <div class="endinng-auction auction-item <?php echo (++$rowindex) % 5 == 0 ? 'last' : ''; ?>" title="<?php echo $objauc["auctionID"]; ?>" id="auction_<?php echo $objauc["auctionID"]; ?>" onclick="<?php echo $objauc["auc_due_price"]; ?>" >
                                    <p class="prodtitle"><b><?php echo $pname; ?></b></p>
                            <?php if ($cornerImag != '') {

				?>
                                       <div class="corner_imagev">
					    <img src="include/addons/icons/quibids-1.5/<?php echo $cornerImag; ?>"  alt=""/>
				      </div>
				      
				<?php } ?>
				<?php //if ($objauc['uniqueauction'] == false) {

				    //check a file
				    if(!empty($picture))
				    {
				    $getpicture = "" . $picture;
				    }
				    else
				    {
				    $getpicture = "no_image.jpg";
				    }

				?>





                          
                           
				
				
				  <a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>">

                                        <img src="<?php echo $UploadImagePath; ?>products/<?php echo $getpicture;?>" border="0"  alt="" class="" style="" />

                                  </a>
                                  <div class="clear"></div>
                                <!--<h2 class="productname"> -->
                                <?php if ($objauc['uniqueauction'] == false) {
                                ?>
					<a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>" class=""><?php echo substr(stripslashes($pname),0 , 25); ?></a>
                                <?php } else {
                                ?>
					<a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>" class=""><?php echo substr(stripslashes($pname), 0, 25); ?></a>
                                <?php } ?>
			      

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
				<div class="bidonme_orange bid-button-link bid bid-button-link">

                                        <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>
				 </div>

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
                                            <div id="seat_button_<?php echo $objauc["auctionID"]; ?>" class>
                                                <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange" name="getseat.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid bid-button-link" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo BUY_NOW . " @ " . $Currency . $objauc["buynowprice"];?>')"><?php echo BUY_NOW . " @ ".$Currency . $objauc["buynowprice"]; ?></a>

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
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid bid-button-link" name="getuniquebid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" style="padding-bottom:20px;"><?php echo PLACE_BID; ?></a>


<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid bid-button-link" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo BUY_NOW. " @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php echo BUY_NOW ." @ ".$Currency . $objauc["buynowprice"]; ?>')"><?php echo BUY_NOW . " @ ".$Currency . $objauc["buynowprice"]; ?></a>

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
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid bid-button-link" name="getbid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

<?php
//Buy it now

if($objauc["allowbuynow"]==true)
{
?>

<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange1" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onmouseout="$(this).text('<?php echo BUY_NOW . " @ " . $Currency . $objauc["buynowprice"];?>')" onmouseover="$(this).text('<?php echo BUY_NOW . " @ ".$Currency . $objauc["buynowprice"]; ?>')"><?php echo BUY_NOW . " @ ".$Currency . $objauc["buynowprice"]; ?></a>

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

                                </div><!-- /auction-item -->

                        <?php if ($rowindex % 5 == 0)
                                        echo '<div class="clear"></div>'; ?>
                        <?php
                                    }
                                    db_free_result($resauc);
                                }
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
                                    <h3><?php echo MORE_AUCTIONS; ?></h3>
                                </div>
                                <div id="live-th">
                                    <div id="product_title"><?php echo PRODUCTS; ?></div>
                                    <div id="price_title"><?php echo PRICE_BIDDER; ?></div>
                                    <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
                                </div>

                        <?php
                                $totalauc2 = 0;

                               

 $qryauc2 = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as
categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,a.tax1,a.tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount "
                                        . "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join
auc_due_table adt on a.auctionID=adt.auction_id " . "where a.auctionID not in ( $co ) and adt.auc_due_time>0 and a.auc_status=2 and seatauction != '1' order by adt.auc_due_time limit 0,30";


                                    $resauc2 = db_query($qryauc2);

                                    $totalauc2 = db_num_rows($resauc2);
                               
                                if ($totalauc2 > 0) {
                                    while (( $objauc2 = db_fetch_array($resauc2))) {
                                    
                                $objauc2['name'] = $objauc2['bidpack'] ? $objauc2['bidpack_name'] : $objauc2['name'];
                                $objauc2['picture'] = $objauc2['bidpack'] ? $objauc2['bidpack_banner'] : $objauc2['picture1'];
                                $objauc2['price'] = $objauc2['bidpack'] ? $objauc2['bidpack_price'] : $objauc2['price'];
                                $objauc2['short_desc'] = $objauc2['bidpack'] ? "{$objauc2['bid_size']} Bids and {$objauc2['freebids']} Freebids" : $objauc2['short_desc'];
                                
                                
                                $cornerImag = cornerImag($objauc2);
                        ?>


                                        <div class="auction-item" title="<?php echo $objauc2["auctionID"]; ?>" id="auction_<?php echo $objauc2["auctionID"]; ?>">
                                        
                                        
                                            <div class="live-auction" style="background-color: white;">
                                            
					    <?php if ($cornerImag != '') {
					    ?>
							<div class="corner_imagev1">
							    <img src="include/addons/icons/quibids-1.5/<?php echo $cornerImag; ?>"  alt=""/>
							</div>
					    <?php } ?>
                                                <a href="viewproduct.php?aid=<?php echo $objauc2["auctionID"]; ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $objauc2["picture"]; ?>);"></a>
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
                                                <div class="countdown">
                                                    <label class="timer time-left" id="counter_index_page_<?php echo $objauc2["auctionID"]; ?>">
                                                        <script language='javascript' type='text/javascript'>
                                                            document.getElementById('counter_index_page_<?php echo $objauc2["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $objauc2["auc_due_time"]; ?>');
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
                    <div id="wrap-end">

                    </div>
                </div>

        <?php include("$BASE_DIR/include/$template/footer.php"); ?>
        <script type="text/javascript">
            <!--
           // swfobject.registerObject("FlashID1");
            //-->
        </script>
        <span id="usedflash" style="display:none;"></span>
    
