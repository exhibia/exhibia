<?php
ini_set('display_errors', 1);
?>					<div class="biddingArea">
                                        <?php if ($seatauction) {
                                            ?>
                                            <div class="seat_panel" id="seat_panel_<?php echo $objauc["auctionID"]; ?>" style="margin-top:20px;height:130px;">
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

                                        <?php } ?>
                                        <div id="normal_panel_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                            <div id="price_index_page_<?php echo $objauc["auctionID"]; ?>" class="last-price" style="background-color: transparent;">---</div>

                                            <div id="" class="auction-time">
                                                <div id="counter_index_page_<?= $objauc["auctionID"]; ?>" class="timer_10togo timer2ending time-leftending">
                                                    <script language="javascript">document.getElementById('counter_index_page_<?= $objauc["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?= $objauc["auc_due_time"]; ?>');</script>
                                                </div>
                                                <div id="blink_img" style="text-align:center;display:none;">
                                                    <img alt="" src="<?php echo $SITE_URL;?>img/blink.gif"/>
                                                </div>
                                            </div>

                                            <div class="currentWinnerTitle">
                                                <h2><?php echo BIDDER; ?></h2>
                                            </div>
                                            
                                            </div>

                                            <div id="" class="userInfo">
                                                <?php
                                                if (Sitesetting::isEnableAvatar()) {

                                                    $avatarPath = $UploadImagePath . "avatars/default.png";

                                                    if ($objauc['avatar'] != '') {
                                                        $tmppath = $UploadImagePath . "avatars/" . $objauc["avatar"];
                                                        if (file_exists($tmppath)) {
                                                            $avatarPath = $tmppath;
                                                        }
                                                    }
                                                    ?>

                                                    <div style="text-align:center;"><img id="product_avatarimage_<?php echo $objauc['auctionID']; ?>" alt="" src="<?php echo $avatarPath; ?>"/></div>
                                                <?php } ?>

                                                <div id="product_bidder_<?= $objauc["auctionID"]; ?>" class="ending-bidder">---</div>
                                                
                                                
                                                <?php if ($uid == 0) { ?>
                                                    <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="bid-logged" onclick="window.location.href='<?php echo $SITE_URL;?>login.php'" onmouseout="$(this).text('<?php if($seatauction == true){echo BUY_SEAT;}else {echo BID;}?>');<?php if ($seatauction == true) { ?>$(this).css('font-size','18px');<?php } ?>" style="font-size:<?php echo $seatauction ? '18px' : '25px'; ?>" onmouseover="$(this).text('<?php echo LOGIN; ?>').css('font-size','25px')"><?php if ($seatauction == true) {echo BUY_SEAT;} else { echo BID;}?></a>
                                                <?php } else { ?>
                                                    <?php if ($seatauction == true) { ?>
                                                        <div class="seat_button_<?php echo $objauc["auctionID"]; ?>">
                                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" style="font-size:18px;" class="bid-logged butseat-button-link" name="getseat.php?prid=<?php echo obj2['productID']; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_SEAT; ?></a>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="normal_button_<?php echo $objauc["auctionID"]; ?>" id="normal_button_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo ($seatauction == true) ? 'none' : 'block'; ?>">
                                                        <?php if ($objauc["uniqueauction"] == true) { ?>
                                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="bid-logged ubid-button-link" rel="<?php echo $objauc["auctionID"]; ?>" name="getuniquebid.php?prid=<?php echo obj2['productID']; ?>&aid=<?php echo $objauc['auctionID']; ?>&uid=<?php echo $uid; ?>"><?php echo BID; ?></a>
                                                        <?php } else { ?>
                                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="bid-logged bid-button-link" name="getbid.php?prid=<?php echo obj2['productID']; ?>&aid=<?php echo $objauc['auctionID']; ?>&uid=<?php echo $uid; ?>"><?php echo BID; ?></a>
                                                    <?php } ?>
                                                    </div>
                                                <?php } ?>


                                            </div>
                                        




                                    </div>

                                    <div id="costs">
                                        <small><?php echo WITH_EACH_BID_PRICE_WILL; ?> <?php echo ($objauc['reverseauction'] == true ? DECREASE : INCREASE) . BY; ?>  <?php echo ($objauc["pennyauction"] == "1" ? $Currency . "0.00" : $Currency . $objauc["auc_plus_price"]); ?>
                                        </small>
                                    </div>
                                </div>

                                <div class="clear"></div>
                                <div id="savings">
                                    <?php echo SAVINGS; ?>:
                                    <dl>
                                        <dt><?php echo WORTH_UP_TO; ?>:</dt>
                                        <dd><span><?php echo $Currency . $price; ?></span></dd>
                                        <dt><?php echo AUCTION_PRICE; ?>:</dt>
                                        <dd>-<?php echo $Currency; ?><label id="price2"><?php echo number_format($fprice,2); ?></label></dd>
                                        <?php
                                        if ($uid <> 0) {
                                            $resbid = db_query("select sum(bid_count) from bid_account where bid_flag='d' and auction_id=$aucid and user_id=$uid group by auction_id");
                                            if (db_num_rows($resbid) > 0) {
                                                $totbid = db_result($resbid, 0);
                                                $totbidprice = $totbid * $onlineperbidvalue;
                                            } else {
                                                $totbid = 0;
                                                $totbidprice = 0;
                                            }
                                            db_free_result($resbid);
                                            $price = $price;
                                            if ($objauc["fixedpriceauction"] == "1") {
                                                $fprice = $objauc["auc_fixed_price"];
                                            } elseif ($objauc["offauction"] == "1") {
                                                $fprice = "0.00";
                                            } else {
                                                $fprice = $objauc["auc_due_price"];
                                            }
                                            ?>
                                            <dt><label id="placebidscount"><?php echo ($totbid != "" ? $totbid : "0"); ?></label><?php echo BIDS; ?>:</dt>
                                            <dd style="display:none;">
                                                -<?php echo $Currency; ?><label id="placebidsamount"><?php echo number_format($totbidprice, 2); ?></label>
                                               

                                            </dd>
                                        <?php } ?>
                                            
                                        <dt class="last"><?php echo SAVINGS; ?>:</dt>
                                         <input type="hidden" id="onlineperbidvalue_text" value="<?php echo $onlineperbidvalue; ?>"/>
                                                <input type="hidden" id="price_text" value="<?php echo $price; ?>"/>
                                                <input type="hidden" id="fprice_text" value="<?php echo $fprice; ?>"/>
                                                <input type="hidden" id="aucid_text" value="<?php echo $objauc["auctionID"]; ?>"/>
                                        <dd class="last savingprice"><?php echo $Currency; ?>
                                            <label id="placebidssavingdisp"><?php echo number_format(($price - $fprice), 2); ?></label>
                                            <span id="placebidssaving" class="innerspan" style="display: none"><?php echo ($price - $fprice); ?></span>
                                        </dd>
                                    </dl>
                                </div>

                                <div class="clear"></div>
                                <div id="worth-up"><?php echo THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE; ?></div>
                            </div> 
