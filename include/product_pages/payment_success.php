<div id="main">
            <?
            include("header.php");
            ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>

                <div id="column-right">

                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><em><?php echo PAYMENT_SUCCESS; ?></em></p>
                    </div><!-- /title-category-content -->

                    <div class="rounded_corner">
                        <div class="content">
                            <p>
                                <?php
                                if ($payfor == PAYFOR_BUYBID) {
                                    $qrysel1 = "select * from bidpack where id='$itemid'";
                                    $ressel1 = db_query($qrysel1);
                                    $obj1 = db_fetch_object($ressel1);
                                ?>

                                    <strong><?php echo CONGRATULATIONS; ?>!</strong>
                                    <div class="normal_text"><strong><?php echo YOU_HAVE_PURCHASED; ?> <?php echo $obj1->bidpack_name . "&nbsp;(" . $obj1->bid_size . " Points / " . $Currency . $obj1->bid_price . ")."; ?> <?php echo YOUR_TRANSACTION_HAS_COMPLETED_SUCCESSFULLY; ?></strong></div>
                                    <div class="clear">&nbsp;</div>
                                    <div class="normal_text"><?php echo YOU_CAN_BID_NOW; ?></div>
                                    <div class="clear">&nbsp;</div>
                                    <div class="normal_text"><a href="index.php" class="darkblue-12-link"><?php echo CLICK_HERE; ?></a> <?php echo TO_FIND_AN_INCREDIBLE_BARGAINS; ?></div>
                                    <div class="clear">&nbsp;</div>
                                    <div class="normal_text"><?php echo $SITE_NM; ?> <?php echo TEAM; ?></div>
                                <?php
                                } else if ($payfor == PAYFOR_BUYITNOW) {
                                    $auctiondb = new Auction(null);
                                    $ressel1 = $auctiondb->selectByAuctionId($itemid);
                                    $obj1 = db_fetch_object($ressel1);
                                    $pname=$obj1->bidpack?($obj1->bidpack_name ." ({$obj1->bid_size} Bids and {$obj1->freebids} Freebids) " ):$obj1->name;
                                ?>
                                    <div class="normal_text"><strong><?php echo YOU_HAVE_PURCHASED; ?>
                                        <?php echo $pname . "&nbsp;by " . $Currency . $auctiondb->getBuynowPrice($userid, $itemid) . "."; ?> <?php echo YOUR_TRANSACTION_HAS_COMPLETED_SUCCESSFULLY; ?></strong></div>
                                <div class="clear">&nbsp;</div>
                                <div class="normal_text"><?php echo WE_WILL_SEND_THE_PRODUCT_AS_SOON_AS_POSSIBLE; ?></div>
                                <div class="clear">&nbsp;</div>

                                <?php } else if ($payfor == PAYFOR_REDEMPTION) {
                                ?>
                                        <strong><?php echo CONGRATULATIONS; ?>!</strong>
                                        <div class="clear" style="height: 30px;">&nbsp;</div>
                                        <div class="normal_text" align="center"><?php echo YOUR_TRANSACTION_FOR_REDEMPTION_COMPLETED_SUCCESSFULLY; ?><br /><a href="myredemption.php" class="darkblue-12-link"><?php echo CLICK_HERE; ?></a> to show your all redemptions.</div>
                                        <div class="clear" style="height: 20px;">&nbsp;</div>
        
                                <?php } else if ($payfor == PAYFOR_WONAUCTION) {
 ?>
                                        <strong><?php echo CONGRATULATIONS; ?>!</strong>
                                        <div class="normal_text" align="center"><?php echo WON_AUCTION_PAYMENT_RECEIVED_SUCCESFULLY; ?></div>
                                <?php } else { ?>
                                        <strong><?php echo CONGRATULATIONS; ?></strong>
                                        <div class="normal_text"><strong><?php echo YOU_HAVE_PURCHASED; ?> <?php echo YOUR_TRANSACTION_HAS_COMPLETED_SUCCESSFULLY; ?></strong></div>
                                        <div class="clear">&nbsp;</div>
                                <?php } ?>
                                </p>
                            </div><!--end content-->
                        </div>
                    </div>
                    <div id="column-left">
                    <?php include("leftside.php"); ?>
                    <?php include("include/bidpackage.php"); ?>
                                    <img src="img/icons/credit-cards.gif" alt="" />
                                </div><!-- /column-left -->
                            </div>

            <?
                                    include("footer.php");
            ?>
        </div> 
