<?php
     // $featuredcount = Sitesetting::getFeaturedAuctionCount();
      if(empty($_REQUEST['pgno'])){
			  $PageNo = 0;
			  }else{
			  $PageNo = $_REQUEST['pgno'];
			  }
      //if ( $_GET["ref"] != "" ) $_SESSION["refid"] = $_GET["ref"];
      //first six products get by this query
      if(!empty($co)){
      $exclude = "and a.auctionID not in ( $co )";
      }else{
      $exclude = '';
      }
      $featuredcount = 20;
	$exclude .= " and a.escroe != '1' ";
	$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,a.tax1,a.tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a " .
        "left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id " .
        "where adt.auc_due_time>0 and a.auc_status='2' $exclude order by adt.auc_due_time limit $PageNo, $featuredcount";
	$resauc = db_query($qryauc);
	$totalauc = db_num_rows($resauc);
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
                           <div class="auction-item <?php echo (++$rowindex) % 4 == 0 ? 'last' : ''; ?>" title="<?php echo $objauc["auctionID"]; ?>" id="auction_<?php echo $objauc["auctionID"]; ?>" onclick="<?php echo $objauc["auc_due_price"]; ?>">
                                    <p class="prodtitle"><b><?php echo FEATURED_AUCTIONS; ?></b></p>
                            <?php if ($objauc['uniqueauction'] == false) {
                            ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>">
                                        <img src="<?php echo $UploadImagePath; ?>products/thumbs_big/thumbbig_<?php echo $picture; ?>" alt="" class="bidimagebox" border="0" />
                                    </a>
                            <?php } else {
                            ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'l'); ?>">
                                        <img src="<?php echo $UploadImagePath; ?>products/thumbs_big/thumbbig_<?php echo $picture; ?>" alt="" class="bidimagebox" border="0" />
                                    </a>

                            <?php } ?>
                                <h2 class="productname">
                                <?php if ($objauc['uniqueauction'] == false) {
                                ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>"><?php echo stripslashes($pname); ?></a>
                                <?php } else {
                                ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'l'); ?>"><?php echo stripslashes($pname); ?></a>
                                <?php } ?>
                            </h2>

                            <?php if ($seatauction) {
                            ?>
                                    <div class="seat_panel" id="seat_panel_<?php echo $objauc["auctionID"]; ?>">
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
                                <img id="product_avatarimage_<?php echo $objauc["auctionID"]; ?>" src="img/blank.png" class="small_avatar" />
                                <ul class="top-bidders" id="topbider_index_page_<?php echo $objauc["auctionID"]; ?>">
                                     <li>---</li>
                                </ul>
                            </div>
                            <?php }
                            ?>
                                <div id="normal_panel_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
				    <p class="auc_manage" id="auc_time_<?php echo $objauc["auctionID"]; ?>">
                                    </p>
                                    <p class="timerbox">
                                        <span id="counter_index_page_<?php echo $objauc["auctionID"]; ?>">
                                            <script language="javascript" type="text/javascript">
                                                document.getElementById('counter_index_page_<?php echo $objauc["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $objauc["auc_due_time"]; ?>');
                                            </script>
                                        </span>
                                    </p>
                                    <p class="price">
                                    <?php if ($objauc['uniqueauction'] == false) {
                                    ?>
                                        <span id="currencysymbol_<?php echo $objauc["auctionID"]; ?>"></span><span id="price_index_page_<?php echo $objauc["auctionID"]; ?>">---</span><strong><?php echo USD; ?></strong>
                                    <?php } else {
                                    ?>
                                        <span id="ubid_index_page_<?php echo $objauc["auctionID"]; ?>">---</span><strong>&nbsp;<?php echo BIDS; ?></strong>
                                    <?php } ?>
                                </p>
                            </div>
                            <small class="bidvalue"><?php echo VALUE; ?> <span id="value_index_page_<?php echo $objauc["auctionID"]; ?>"><?php echo $price; ?></span> <?php echo GBP; ?></small>
                            <?php if ($objauc['uniqueauction'] == false) {
                            ?>
                            <img id="product_avatarimage_<?php echo $objauc["auctionID"]; ?>" src="img/blank.png" class="small_avatar" />
                                        <ol class="top-bidders" id="topbider_index_page_<?php echo $objauc["auctionID"]; ?>">
                                            <li>---</li>
                                        </ol>
                            <?php } else {
                            ?>
                                        <ol class="top-bidders" id="ubider_index_page_<?php echo $objauc["auctionID"]; ?>">
                                            <li><label><?php echo INPUT_YOUR_PRICE; ?>:</label></li>
                                            <li><input id="lowestprice_<?php echo $objauc["auctionID"]; ?>" <?php echo $uid == 0 ? 'disabled' : ''; ?> name="lowestprice_<?php echo $objauc["auctionID"]; ?>"/></li>
                                        </ol>
                            <?php } 
                            if (empty($_SESSION['userid'])) {
                            ?>
                                        <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="gradient button" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>

                            <?php } else {
                                      if ($seatauction == true) {
                                       ?>
                                            <div id="seat_button_<?php echo $objauc["auctionID"]; ?>">
                                                <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button butseat-button-link gradient" name="getseat.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $_SESSION['userid']; ?>"><?php echo BUY_A_SEAT; ?></a>
                                            </div>
                                      <?php } ?>

                                        <div id="normal_button_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                <?php if ($objauc['uniqueauction'] == true) {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button ubid-button-link gradient" rel="<?php echo $objauc["auctionID"]; ?>" name="getuniquebid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $_SESSION['userid']; ?>"><?php echo PLACE_BID; ?></a>
                               <?php } else {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button bid-button-link gradient" name="getbid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $_SESSION['userid']; ?>"><?php echo PLACE_BID; ?></a>
                                <?php } ?>
                                        </div>
                            <?php } ?>
			      <?php
			      if($objauc["allowbuynow"]==true)
			      {
			      if(empty($_SESSION['userid'])){
			      ?>
			          <a id="image_main_buy_<?php echo $objauc["auctionID"]; ?>" class="button butseat-button-link" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo BUY_NOW;?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo BUY_NOW; ?></a>
			      <?php
			      }else{
			      ?>
			           <a id="image_main_buy_<?php echo $objauc["auctionID"]; ?>" style="font-size:10px;" class="button butseat-button-link" href="buyitnow.php?auctionId=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $_SESSION['userid']; ?>" onmouseout="$(this).text('<?php echo BUY_NOW;?>')" onmouseover="$(this).html($('#bids_back_html_<?php echo $objauc['auctionID']; ?>').html());">
			            <?php echo BUY_NOW ; ?>
			           </a>


			      <?php
			      }
			      }
			      else
			      {
			      
			      }
			      ?>
                              </div><!-- /auction-item -->
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
                            
                         <script>
                         function retrieve_auctions(page, cat){
                         var d = new Date();
                         var n = d.getTime(); 
                         if(empty(cat)){
			  cat = '';
			 }
                          $('#escroe_results .auction-item').fadeOut( 300, function() { add_timer_break('body'); });
			    $.ajax({
				    url: '<?php echo $SITE_URL; ?>include/addons/auction_boxes/exhibia/auctions_index_bottom.php',
				    data: { PageNo: page, cat: cat },
				    type: 'post',
				    dataType: 'html',
				    success: function(response){
					var width = $('#escroe_results').width();
					  $('#escroe_results').html(response);
					  $('#escroe_results .auction-item').fadeIn( 300, function() { remove_timer_break(); });
				      }
				 });
			 }
			 function get_escrow(cat, li){
                         var d = new Date();
                         var n = d.getTime(); 
                          $('#escroe_results .auction-item').fadeOut( 300, function() { add_timer_break('body'); });
                          $('#categories_escroe ul li').removeClass('active');
                          $('#' + li).addClass('active');
			    $.ajax({
				    url: '<?php echo $SITE_URL; ?>include/addons/auction_boxes/exhibia/auctions_index_bottom.php?&_' + n,
				    data: { cat: cat },
				    type: 'get',
				    dataType: 'html',
				    success: function(response){
					var width = $('#escroe_results').width();
					  $('#escroe_results').html(response);
					  $('#escroe_results .auction-item').fadeIn( 300, function() { remove_timer_break(); });
				      }
				 });
			 }
			</script>