
        <div id="main">
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><em><?= $SITE_NM; ?> - <?php echo REDEMPTION_PAYMENT; ?></em>

                        </p>
                    </div><!-- /title-category-content -->


                    <div id="buyproduct-box" class="content">
                        <div class="productinfo1">
                            <h5><?php echo REDEMPTION_DETAILS; ?>:</h5>
                            <p>
                                <strong><?= stripslashes($objsel["name"]); ?>:&nbsp;</strong><?= $objsel["redem_points"]; ?>&nbsp;<?php echo POINTS; ?><br/>

                                <strong><?php echo SHIPPING_CHARGE; ?>:&nbsp;</strong><?= $Currency . $objsel["shippingcharge"]; ?>
                            </p>

                            <?php if ($objsel["shippingcharge"] <= 0) {
                            ?>
                                <p>
                                    <strong><?php echo AFTER_CLICKING_ON_CONFIRM_BUTTON_POINTS_WILL_BE_AUTOMATICALLY_DEBITED_FROM_YOUR_ACCOUNT; ?></strong>
                                </p>
                                <p>
                                    <form name="payment" action="payment.php" method="post">
<!--                                        <button style="cursor: pointer" class="buttonmake" onclick="window.location.href='<?php echo $SITE_URL; ?>payment.php?redemid=<?= $_GET["pu"]; ?>&payfor=<?php echo PAYFOR_REDEMPTION; ?>'"><?php echo SUBMIT; ?></button>-->
                                        <input type="hidden" name="payfor" value="<?php echo PAYFOR_REDEMPTION; ?>"/>
                                        <input type="hidden" name="redemid" value="<?php echo $_GET["pu"]; ?>" />
                                        <button style="cursor: pointer" class="buttonmake" type="submit"><?php echo SUBMIT; ?></button>
                                    </form>
                                </p>
                            <?php } ?>

                        </div>

                        <div class="clear"></div>

                        <div id="buybidBox">

                            <?php include("$BASE_DIR/modules/gateways/redeempaymentmethod.php"); ?>
                                </div>


                            </div>
                        </div>

                    </div><!-- /column-right -->
                    <div id="column-left">
                    <?php include("leftside.php"); ?>
                    <?php include("include/bidpackage.php"); ?>
                                    <img src="include/addons/icons/quibids-1.0/credit-cards.gif" alt="" />
                                </div><!-- /column-left -->


                            </div> <!--end container-->

            <?php include("$BASE_DIR/include/$template/footer.php"); ?>
        </div> <!--end main-->
    

