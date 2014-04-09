 
        <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                
                <?php
                if($template != 'sticky' & $template != 'wavee' & $template != 'quibids-2.0'){
                ?>
                <div id="title-category-content">
                    <?php include("include/categorymenu.php"); ?>
                    <p class="bid-title"><strong><?php echo BID_NOW; ?></strong> - <?php echo THESE_AUCTIONS_ARE_ABOUT_TO_END; ?></p>
                </div>
                <!-- /title-category-content -->
                
                
                <div id="bid-products" class="content">
                
                
                    <?php
                    if ($totalauc > 0) {
                        $i = 1;
                        $add = "";
                        while (( $objauc = db_fetch_array($resauc))) {
                            $add .= ( $i == 1 ? $objauc["auctionID"] : "," . $objauc["auctionID"]);
                            $pname = $objauc['bidpack'] ? $objauc['bidpack_name'] : $objauc['name'];
                            $picture = $objauc['bidpack'] ? $objauc['bidpack_banner'] : $objauc['picture1'];
                            $price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];
                            $short_desc = $objauc['bidpack'] ? "{$objauc['bid_size']} Bids and {$objauc['freebids']} Freebids" : $objauc['short_desc'];
                    ?>
                            <div class="bid-box auction-item" title="<?= $objauc["auctionID"]; ?>" id="auction_<?= $objauc["auctionID"]; ?>">
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
                        </div>
                        <!-- /bid-image -->
                        <div class="bid-content">
                            <h2>
                                <?php if ($objauc['uniqueauction'] == false) {
                                ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></a>
                                <?php } else {
 ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'l'); ?>"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></a>
<?php } ?>
                            </h2>
                            <p><strong><?php echo HIGH_BIDDER; ?>:</strong> <span class="style1" id="product_bidder_<?= $objauc["auctionID"]; ?>">---</span></p>
                            <p class="timebox"> <strong> <span id="counter_index_page_<?= $objauc["auctionID"]; ?>">
                                        <script language="javascript">document.getElementById('counter_index_page_<?= $objauc["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?= $objauc["auc_due_time"]; ?>');</script>
                                    </span> </strong> <span id="currencysymbol_<?= $objauc["auctionID"]; ?>"></span><span id="price_index_page_<?= $objauc["auctionID"]; ?>">---</span> </p>

                            <?php if ($uid == 0) {
                            ?>
                                        <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>

                            <?php } else {
                            ?>

                            <?php if ($seatauction == true) {
                            ?>
                                            <div id="seat_button_<?php echo $objauc["auctionID"]; ?>">
                                                <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button butseat-button-link" name="getseat.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>
                                            </div>
                            <?php } ?>

                                        <div id="normal_button_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                <?php if ($objauc['uniqueauction'] == true) {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button ubid-button-link" rel="<?php echo $objauc["auctionID"]; ?>" name="getuniquebid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

                                <?php } else {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button bid-button-link" name="getbid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>
                                <?php } ?>
                                        </div>
                            <?php } ?>

                            </div>
                            <!-- /bid-content -->
                        </div>
                        <!-- /bid-box -->
                    <?
                                $i++;
                            }
                    ?>
                            <div class="clear"></div>
                    <?
                        }
                    ?>
                    </div>
                   
                    <!-- /content -->
                    <p class="bid-title"><strong><?php echo LOGIN; ?></strong></p>
                     <?php } ?>
			    <?php if(file_exists("include/$template/login.php")){
			    
				include("include/$template/login.php");
				
				}else{
				
				include("include/login.php");
				
				}
			    ?>
                </div>
                
           </div>

	
<?php include("footer.php"); ?>