<div id="bid-products" class="content">
<p class="bid-title"><strong><?php echo BID_NOW; ?></strong> - <?php echo THESE_AUCTIONS_ARE_ABOUT_TO_END; ?></p>
                    <?
                    $qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,minseats,maxseats, seatauction, seatbids,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,lockauction,cashauction, reserve, locktype,locktime,lockprice,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc " .
                            " as seatcount from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id " .
                            "where adt.auction_id <> $aucid and adt.auc_due_time!=0 and a.auc_status='2' order by adt.auc_due_time limit 0, 3";

                    $resauc = db_query($qryauc);
                    $totalauc = db_num_rows($resauc);
                    if ($totalauc > 0) {
                        $i = 1;
                        $add = "";
                        while (( $objauc = db_fetch_array($resauc))) {
                            $cornerImag = cornerImag($objauc);


                            $pname = $objauc['bidpack'] ? $objauc['bidpack_name'] : $objauc['name'];
                            $picture = $objauc['bidpack'] ? $objauc['bidpack_banner'] : $objauc['picture1'];
                            $price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];
                            $short_desc = $objauc['bidpack'] ? "{$objauc['bid_size']} Bids and {$objauc['freebids']} Freebids" : $objauc['short_desc'];
                            $add .= ( $i == 1 ? $objauc["auctionID"] : "," . $objauc["auctionID"]);
                    ?>
                            <div class="bid-box auction-item" title="<?php echo $objauc["auctionID"]; ?>" id="auction_<?php echo $objauc["auctionID"]; ?>">
                        <?php if ($cornerImag != '') {
                        ?>
                                <div class="corner_imagev1">
                                    <img src="<?php echo $SITE_URL;?>css/<?php echo $template;?>/icons/<?php echo $cornerImag; ?>"  alt=""/>
                                </div>
                        <?php } ?>
                            <div class="bid-image">
                            <?php if ($objauc['uniqueauction'] == false) {
                            ?>
                                <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>">
                                    <img src="<?php echo $UploadImagePath; ?>products/thumbs_big/thumbbig_<?php echo $picture; ?>" alt="" border="0" width="118" height="100"/>
                                </a>
                            <?php } else {
                            ?>
                                <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'l'); ?>">
                                    <img src="<?php echo $UploadImagePath; ?>products/thumbs_big/thumbbig_<?php echo $picture; ?>" alt="" border="0" width="118" height="100"/>
                                </a>
                            <?php } ?>
                        </div><!-- /bid-image -->
                        <div class="bid-content">
                           
                                <?php if ($objauc['uniqueauction'] == false) {
                                
                                if($objauc['seatauction'] == 1){
                                
				       $seat_info = db_fetch_array(db_query("select count(id) from auction_seat where auction_id=$objauc[auctionID]"));
					
					if ($uid == 0 & $seat_info[0] >= $objauc['minseats']) {
					  ?>
					     <h2><a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></a>
					      </h2>
					      <p><strong><?php echo HIGH_BIDDER; ?>:</strong> <span class="style1" id="product_bidder_<?= $objauc["auctionID"]; ?>">---</span>
					      </p>
					      <div style="position:relative;top:-5px" id="seat_button_<?php echo $objauc["auctionID"]; ?>">
						<a style="" id="image_main_<?php echo $objauc["auctionID"]; ?>" class="gradient button" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>
					      </div>
				    <?php 
				    
					    } else {
					    
					    if($seat_info[0] < $objauc['minseats']){
					
				    ?>
						
				    <?php 
						}else{
						
						?>
						      <h2><a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></a>
						      </h2>
							<p style=""><strong><?php echo HIGH_BIDDER; ?>:</strong> <span class="style1" id="product_bidder_<?= $objauc["auctionID"]; ?>">---</span>
							    </p>
						    <div style="position:relative;top:5px;margin-bottom:-5px;" id="normal_button_<?php echo $objauc["auctionID"]; ?>">
							<a id="image_main_<?= $objauc["auctionID"]; ?>" class="button bid-button-link" name="getbid.php?prid=<?= $objauc["productID"]; ?>&aid=<?= $objauc["auctionID"]; ?>&uid=<?= $uid; ?>"><?php echo PLACE_BID; ?></a>
						    </div>
						           
						
						<?php
						
						}
				    
				    
						}
					
				    
				      }else{
				      
					    ?>
				 <h2>
					  <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></a>
					  <?php
				      
				    ?></h2><?php  
				      
				      }
				      
				      }else {
                                ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'l'); ?>"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></a>
                                <?php } ?>
                            
                            
                            <?php if($objauc['seatauction'] != '1'){ ?>
                            <p style="">
                            <?php 
                            //
                                if ($objauc['uniqueauction'] == false ) {
                                ?>
                                    <strong><?php echo HIGH_BIDDER; ?>:</strong> <span class="style1" id="product_bidder_<?= $objauc["auctionID"]; ?>">---</span>
                                <?php } else { ?>
                                
                                    <input id="lowestprice_<?php echo $objauc["auctionID"]; ?>"  <?php echo $uid == 0 ? 'disabled' : ''; ?> name="lowestprice_<?php echo $objauc["auctionID"]; ?>"/>
                               
                               <?php } 
                                
				
                                ?>
                            </p>
                            
                            <?php } ?>
                            <p class="timebox">
                            
                            <?php
                             if ($objauc['seatauction'] != 1 | ($seat_info[0] >= $objauc['minseats'])){
                             ?>
                                <strong>
                                    <span id="counter_index_page_<?= $objauc["auctionID"]; ?>" style="<?php if($objauc['seatauction'] == 1){ ?>position:relative;top:-15px;<?php } ?>">
                                        <script language="javascript">document.getElementById('counter_index_page_<?= $objauc["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?= $objauc["auc_due_time"]; ?>');</script>
                                    </span>
                                </strong>
			    <?php } ?>
                                <?php if ($objauc['uniqueauction'] == false) {
                                
                                
					  if ($objauc['seatauction'] == 1) {
					  
					      if($seat_info[0] < $objauc['minseats']){
				    ?>
				    <h2><a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></a>
						    </h2>
					  <div class="seat_panel" id="seat_panel_<?php echo $objauc["auctionID"]; ?>" style="position:relative;top:-30px;margin-bottom:-30px;">
					
						  <div style="" class="seat_bar_small" id="seat_bar_small_<?php echo $objauc2["auctionID"]; ?>">                                            </div>

                                          
						  
						  
					    
						    <div style="position:relative;left:80px;top:20px;padding-bottom:10px;" id="seat_button_<?php echo $objauc["auctionID"]; ?>">
							<a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button butseat-button-link" name="getseat.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>
						    </div>
						    
						    
						    <div class="seat_count">
							<b><span id="seat_count_<?php echo $objauc["auctionID"]; ?>">-</span>/<span><?php echo $objauc['minseats']; ?></span></b>
						    </div>
						  
						   <div class="seat_text1"><?php echo SEATS_AVAILABLE; ?>   
						   </div>
						  
						  <div class="seat_text2"><?php echo SEAT_AUCTION_DESCRIPTION; ?></div>
						  <div class="seat_text3">
						  
						  
						      <?php echo FROM_W; ?>:<span><?php echo $Currency . $objauc['auc_start_price'] ?></span>&nbsp;&nbsp;
						      <?php echo SEAT_BIDS; ?>:<span><?php echo $objauc['seatbids'] ?></span>
						  </div>
					  </div>
					  
				      
				    <?php 
					      }else{
					      
					      ?>
					
					       <span id="currencysymbol_<?= $objauc["auctionID"]; ?>" style="position:relative;top:-15px;"></span><span id="price_index_page_<?= $objauc["auctionID"]; ?>"  style="position:relative;top:-15px;">---</span>
                            
					      <?php
					      
					      
					      }
				    
					  }else{ ?>
                                
                                    <span id="currencysymbol_<?= $objauc["auctionID"]; ?>"></span><span id="price_index_page_<?= $objauc["auctionID"]; ?>">---</span>
                                <?php
                                
				      }
                                   } else {
                                ?>
                                    <span id="ubid_index_page_<?= $objauc["auctionID"]; ?>">---</span>
                                <?php } ?>
                            </p>
                            <?php
                            
                            if($objauc['seatauction'] != 1){
                            if ($objauc['uniqueauction'] == false) {
                            ?>
                            <?php if ($uid == 0) {
                            ?>
                                        <a id="image_main_<?= $objauc["auctionID"]; ?>" class="gradient button" onclick="window.location.href='<?php echo $SITE_URL; ?>login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo PLACE_BID; ?></a>
                            <?php } else {
                            ?>
                                        <a id="image_main_<?= $objauc["auctionID"]; ?>" class="button bid-button-link" name="getbid.php?prid=<?= $objauc["productID"]; ?>&aid=<?= $objauc["auctionID"]; ?>&uid=<?= $uid; ?>"><?php echo PLACE_BID; ?></a>

                            <?php } ?>
                            <?php } else {
                            ?>
                            <?php if ($uid == 0) {
                            ?>
                                        <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="gradient button" onclick="window.location.href='<?php echo $SITE_URL; ?>login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo PLACE_BID; ?></a>

                            <?php } else {
                            ?>
                                        <a id="image_main_<?php echo $objauc["auctionID"]; ?>" rel="<?php echo $objauc["auctionID"]; ?>" class="button ubid-button-link" name="getuniquebid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

                            <?php } ?>
                            <?php } 
                            
                            }
                            
                            ?>
                            </div><!-- /bid-content -->
                        </div><!-- /bid-box -->
                    <?
                                $i++;
                            }
                    ?>
                            <div class="clear"></div>
                    <?
                        }
                    ?>
                    </div><!-- /content -->