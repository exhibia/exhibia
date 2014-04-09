
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->
            <div id="wrapper" class="clearfix">
                <div id="maincol">

                    <!-- ============= Auctions ID =============  -->
                    <div id="auction-id">
                        <div id="auction-id-ttl">
                            <span><?php echo REDEMPTION; ?>:</span>
                        </div>

                        <div id="auction-id-descr">
                            <h1><?php echo $obj['name'] ?></h1>
                            <p><?php echo $obj['short_desc'] ?></p>
                        </div>


                        <!-- ============= Auctions Product =============  -->
                        <div id="auction-id-prod-view">
                            <div id="mainimage1">
                                <?php if ($obj["picture1"] != "") {
                                ?>
                                    <div class="image-placeholder" style="background-image: url(<?php echo $UploadImagePath; ?>products/<?php echo $obj["picture1"]; ?>);">

                                    </div>
                                <?php } ?>
                            </div>

                            <div id="mainimage2" style="display: none;">
                                <?php if ($obj["picture2"] != "") {
                                ?>
                                    <div class="image-placeholder" style="background-image: url(<?php echo $UploadImagePath; ?>products/<?php echo $obj["picture2"]; ?>);">

                                    </div>
                                <?php } ?>
                            </div>

                            <div id="mainimage3" style="display: none;">
                                <?php if ($obj["picture3"] != "") {
                                ?>
                                    <div class="image-placeholder" style="background-image: url(<?php echo $UploadImagePath; ?>products/<?php echo $obj["picture3"]; ?>);">

                                    </div>
                                <?php } ?>
                            </div>
                            <div id="mainimage4" style="display: none;">
                                <?php if ($obj["picture4"] != "") {
                                ?>
                                    <div class="image-placeholder" style="background-image: url(<?php echo $UploadImagePath; ?>products/<?php echo $obj["picture4"]; ?>);">

                                    </div>
                                <?php } ?>
                            </div>
                            <br/>
                            <ul id="thumbs">
                                <li>
                                    <a onclick="changeimage(1);return false;" id="otherimageprd_1">
                                        <img src="<?php echo $UploadImagePath; ?>products/thumbs/thumb_<?php echo $obj["picture1"]; ?>" alt="" width="70" border="0" height="56"/>
                                    </a>
                                </li>
                                <?php if ($obj["picture2"] != "") {
                                ?>
                                    <li>
                                        <a onclick="changeimage(2);return false;" id="otherimageprd_2">
                                            <img src="<?php echo $UploadImagePath; ?>products/thumbs/thumb_<?php echo $obj["picture2"]; ?>" alt="" width="70" border="0" height="56"/>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if ($obj["picture3"] != "") {
                                ?>
                                    <li>
                                        <a onclick="changeimage(3);return false;" id="otherimageprd_3">
                                            <img src="<?php echo $UploadImagePath; ?>products/thumbs/thumb_<?php echo $obj["picture3"]; ?>" alt="" width="70" border="0" height="56"/>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php if ($obj["picture4"] != "") {
                                ?>
                                    <li>
                                        <a onclick="changeimage(4);return false;" id="otherimageprd_4">
                                            <img src="<?php echo $UploadImagePath; ?>products/thumbs/thumb_<?php echo $obj["picture4"]; ?>" alt="" width="70" border="0" height="56"/>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>

                        <!-- ============= End Auctions Product =============  -->
                        <!-- ============= Auctions Stats =============  -->


                        <div id="auction-stats-redeem">
                                <br/>
                            
                            <div id="savings"><?php echo AUCTION_TYPE; ?>:
                                <dl>
                                    <dt><?php echo WORTH_UP_TO; ?>:</dt>
                                    <dd><span><?php echo $Currency . $obj["price"]; ?></span></dd>
                                    <dt><?php echo REDEMPTION_POINTS; ?>:</dt>
                                    <dd><label id="redemptionpoints"><?php echo $obj["redem_points"]; ?></label></dd>

                                    <dt><?php echo LAST_DATE_OF_AVAILIBILITY; ?>:</dt>
                                    <dd><span><?php echo arrangedate($obj["redem_enddate"]); ?></span></dd>

                                    <dt><?php echo SHIPPING_CHARGE; ?>:</dt>
                                    <dd><span><?php echo $Currency . $obj["shippingcharge"]; ?></span></dd>

                                </dl>

                            </div>

                            <div class="clear"></div>
                            <div style="height: 140px;">
                                <div class="biddingArea">
                                    <br/>
                                    <br/>

                                    <div id="" class="userInfo">

                                        <a class="bid-logged" onclick="CheckForPay('<?=base64_encode($_GET["rid"]); ?>')"><?php echo REDEEM; ?></a>

                                    </div>

                                </div>
                            </div>

                            <div class="clear"></div>
                            <div id="worth-up"><?php echo THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE; ?></div>
                        </div>

                        <!-- ============= End Auctions Stats =============  -->

                        <div id="bid-o-matic-wrap">


                            <!-- ============= End Ad Register =============  -->
                            <!-- ============= BID-O-MATICr =============  -->

                            <div id="bid-o-matic-ad">
                                <h4>How exactly does the bidding <br/>work? </h4>

                                <div>In case you don't know, check out our help pages!<br/>
                                    <a href="help.php">Want to know more?</a></div>
                            </div>

                            <!-- ============= End BID-O-MATIC =============  -->


                        </div>
                        <!-- ============= End Bid history Register BID-O-MATIC wrap =============  -->

                        <div class="clear"></div>

                        <!-- ============= End Buy It Now - Bid to Save! =============  -->


                        <div class="big-box-end"></div>
                    </div>
                    <!-- ============= End Auctions ID =============  -->
                    <!-- ============= Product Details =============  -->
                    <div id="product-details">
                        <h2><?php echo PRODUCT_DETAILS; ?></h2>
                        <div id="product-details-ttl"><?php echo htmlspecialchars(stripslashes($obj["name"]), ENT_QUOTES); ?></div>

                        <div id="product-details-description" style="margin-top: -35px;">
                            <p>
                                <?php echo stripslashes($obj["long_desc"]); ?>
                                    </p>
                                </div>
                                <div id="product-details-end">Contents of package may vary from those pictured </div>
                            </div>
                            <!-- ============= End Product Details =============  -->

                        </div>
                    </div>
                    <div id="wrap-end"></div>

                </div> <!--end pagewidth-->

        <?php include("$BASE_DIR/include/$template/footer.php") ?>

                                        <span id="userfreebids" style="display: none;"><?=GetUserFreeBids($_SESSION["userid"]); ?></span>
    

