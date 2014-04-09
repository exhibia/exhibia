
        <div id="main">
            <?php include($BASE_DIR . '/include/' . $template . '/header.php'); ?>
            <div id="container">
          
                <div id="column-right">
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?php echo $SITE_NM; ?></strong> - <?php echo REDEMPTION; ?></p>
                    </div><!-- /title-category-content -->
                    <div id="product-details">
                        <div id="product-gallery">
                            <div class="main-product">
                                <div id="mainimage1">
                                    <?php if ($obj["picture1"] != "") {
 ?>
                                        <img alt="" src="<?= $UploadImagePath; ?>products/<?= $obj["picture1"]; ?>"/>
<?php } ?>
                                </div>

                                <div id="mainimage2" style="display: none;">
<?php if ($obj["picture2"] != "") { ?>
                                        <img alt=""  src="<?= $UploadImagePath; ?>products/<?= $obj["picture2"]; ?>"/>
<?php } ?>
                                </div>

                                <div id="mainimage3" style="display: none;">
<?php if ($obj["picture3"] != "") { ?>
                                        <img alt=""  src="<?= $UploadImagePath; ?>products/<?= $obj["picture3"]; ?>"/>
<?php } ?>
                                </div>
                                <div id="mainimage4" style="display: none;">
<?php if ($obj["picture4"] != "") { ?>
                                        <img alt="" src="<?= $UploadImagePath; ?>products/<?= $obj["picture4"]; ?>"/>
<?php } ?>
                                </div>

                            </div><!-- /main-product -->
                            <div class="product-small">
                                <span onclick="changeimage(1);" id="otherimageprd_1" style="cursor: pointer;"><img src="<?= $UploadImagePath; ?>products/thumbs/thumb_<?= $obj["picture1"]; ?>" alt="product" border="0" /></span>
                            </div><!-- /product-small -->
<?php if ($obj["picture2"] != "") { ?>
                                        <div class="product-small">
                                            <span onclick="changeimage(2);" id="otherimageprd_2" style="cursor: pointer;"><img src="<?= $UploadImagePath; ?>products/thumbs/thumb_<?= $obj["picture2"]; ?>" alt="product" border="0" /></span>
                                        </div><!-- /product-small -->
<?php } ?>

<?php if ($obj["picture3"] != "") { ?>
                                        <div class="product-small">
                                            <span onclick="changeimage(3);" id="otherimageprd_3" style="cursor: pointer;"><img src="<?= $UploadImagePath; ?>products/thumbs/thumb_<?= $obj["picture3"]; ?>" alt="product" border="0" /></span>
                                        </div><!-- /product-small -->
<?php } ?>

<?php if ($obj["picture4"] != "") { ?>
                                        <div class="product-small">
                                            <span onclick="changeimage(4);" id="otherimageprd_4" style="cursor: pointer;"><img src="<?= $UploadImagePath; ?>products/thumbs/thumb_<?= $obj["picture4"]; ?>" alt="product" border="0" /></span>
                                        </div><!-- /product-small -->
<?php } ?>

                                </div><!-- /product-gallery -->

                                <div id="product-information">
                                    <div class="product-box">
                                        <div class="product-content">
                                            <h3 class="savings"><?php echo AUCTION_TYPE; ?></h3>
                                            <ul>
                                                <li><span><?php echo WORTH_UP_TO; ?>:</span><em><?php echo $Currency . $obj["price"]; ?></em></li>
                                                <li><span><?php echo REDEMPTION_POINTS; ?>:</span> <em id="redemptionpoints"><?php echo $obj["redem_points"]; ?></em></li>
                                                <li><span><?php echo LAST_DATE_OF_AVAILIBILITY; ?>:</span> <em><?php echo arrangedate($obj["redem_enddate"]); ?></em></li>
                                                <li><span><?php echo SHIPPING_CHARGE; ?>:</span> <em><?php echo $Currency . $obj["shippingcharge"]; ?></em></li>
                                            </ul>

                                            <p align="center" style="margin:10px auto;">
                                                <a class="button" onclick="CheckForPay('<?= base64_encode($_GET["rid"]); ?>')"><?php echo REDEEM; ?></a>
                                            </p>
                                            <p align="left"><small><?php echo THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE; ?></small></p>
                                        </div><!-- /product-content -->
                                    </div>
                                </div><!--end of product-information-->

                            </div>

                            <div id="payment-information">
                                <h3><?php echo PRODUCT_DETAILS; ?>:</h3>

                                <div class="pro_detail">
                                    <div class="statictitle"><?= stripslashes($obj["name"]); ?></div>
                                    <div class="clear">&nbsp;</div>
                                    <div><?= stripslashes($obj["long_desc"]); ?></div>
                                </div>
                            </div>
                        </div><!--end column-right-->

                        <div id="column-left">

<?php include("leftside.php"); ?>

<?php include("include/bidpackage.php"); ?>

                                    <img src="img/icons/credit-cards.gif" alt="" />

                                </div><!-- /column-left -->


                            </div><!--end container-->

<?php include("$BASE_DIR/include/$template/footer.php"); ?>
                                </div><!--end main-->

                                <span id="userfreebids" style="display: none;"><?= GetUserFreeBids($_SESSION["userid"]); ?></span>
  
