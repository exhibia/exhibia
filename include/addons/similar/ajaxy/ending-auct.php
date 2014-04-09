                              <?php
                            
                                ?>

                                <div class="auction-item" title="<?php echo $objauc["auctionID"]; ?>" id="auction_<?php echo $objauc["auctionID"]; ?>">
                                    <div class="endinng-auction">
                                        <h2>
                                            <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], $objauc['uniqueauction'] == false ? 'n' : 'l'); ?>"><?php echo stripslashes($pname); ?></a>
                                        </h2>
                                        <div class="retailprice">Retails for:<?php echo $Currency . number_format($objauc['price'], 2); ?></div>
                                        <?php if ($cornerImag != '') {
                                            ?>
                                            <div class="corner_image1">
                                                <img src="<?php echo $SITE_URL;?>include/addons/icons/<?php echo $template; ?>/<?php echo $cornerImag; ?>"  alt=""/>
                                            </div>
                                        <?php } ?>

                                        <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], $objauc['uniqueauction'] == false ? 'n' : 'l'); ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_big/thumbbig_<?php echo $picture; ?>);"></a>


                                        <?php if ($seatauction) {
                                            ?>
                                            <div class="seat_panel" id="seat_panel_<?php echo $objauc["auctionID"]; ?>" style="height:98px;">
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
                                            <div style="text-align: center;">
                                                <label id="counter_index_page_<?php echo $objauc["auctionID"]; ?>" class="endingtimer timer time-left">
                                                    <script language="javascript" type="text/javascript">
                                                        document.getElementById('counter_index_page_<?php echo $objauc["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $objauc["auc_due_time"]; ?>');
                                                    </script>
                                                </label>
                                            </div>
                                            <div class="save_text">

                                            </div>
                                            <div style="margin: 2px;">
                                                <div style="background-color: transparent;" class="price"><?php echo $Currency;?>
                                                    <?php if ($objauc['uniqueauction'] == false) {
                                                        ?>
                                                       <span id="price_index_page_<?php echo $objauc["auctionID"]; ?>">---</span>
                                                    <?php } else {
                                                        ?>
                                                        <span id="ubid_index_page_<?php echo $objauc["auctionID"]; ?>">---</span><strong>&nbsp;<?php echo BIDS; ?></strong>
                                                    <?php } ?>
                                                <?php echo $CurrencyName;?></div>
                                            </div>
                                            <div style="margin: 2px;">
                                                <div class="winning">
                                                    <?php if ($objauc['uniqueauction'] == false) { ?>
                                                        <div  id="product_bidder_<?php echo $objauc["auctionID"]; ?>">---</div>
                                                    <?php } else { ?>
                                                        <input id="lowestprice_<?php echo $objauc["auctionID"]; ?>" <?php echo $uid == 0 ? 'disabled' : ''; ?> name="lowestprice_<?php echo $objauc["auctionID"]; ?>"/>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>



                                        <?php if ($uid == 0) { ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange" onclick="window.location.href='<?php echo $SITE_URL;?>login.php'" onmouseout="$(this).text('<?php if($seatauction == true){echo BUY_SEAT;}else {echo BID;}?>');<?php if ($seatauction == true) { ?>$(this).css('font-size','18px');<?php } ?>" style="font-size:<?php echo $seatauction ? '18px' : '25px'; ?>" onmouseover="$(this).text('<?php echo LOGIN; ?>').css('font-size','25px')"><?php if ($seatauction == true) {echo BUY_SEAT;} else { echo BID;}?></a>
                                        <?php } else { ?>
                                            <?php if ($seatauction == true) { ?>
                                                <div class="seat_button_<?php echo $objauc["auctionID"]; ?>">
                                                    <a id="image_main_<?php echo $objauc["auctionID"]; ?>" style="font-size:18px;" class="loginfirst_orange butseat-button-link" name="getseat.php?prid=<?php echo $objauc2["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_SEAT; ?></a>
                                                </div>
                                            <?php } ?>
                                            <div class="normal_button_<?php echo $objauc["auctionID"]; ?>" id="normal_button_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo ($seatauction == true) ? 'none' : 'block'; ?>">
                                                <?php if ($objauc["uniqueauction"] == true) { ?>
                                                    <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange ubid-button-link" rel="<?php echo $objauc["auctionID"]; ?>" name="getuniquebid.php?prid=<?php echo $objauc2["productID"]; ?>&aid=<?php echo $objauc['auctionID']; ?>&uid=<?php echo $uid; ?>"><?php echo BID; ?></a>
                                                <?php } else { ?>
                                                    <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="loginfirst_orange bid-button-link" name="getbid.php?prid=<?php echo $objauc2["productID"]; ?>&aid=<?php echo $objauc['auctionID']; ?>&uid=<?php echo $uid; ?>"><?php echo BID; ?></a>
                                            <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div> 
