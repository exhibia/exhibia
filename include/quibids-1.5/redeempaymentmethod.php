
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->

            <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <!-- ============= Registration =============  -->
                    <div id="bidpack-wrap">
                        <div style="float: right; right: 20px; top: 5px; position: relative; font-size: 14px; font-weight: bold;">

                        </div>

                        <h2><?php echo REDEMPTION_PAYMENT; ?></h2>
                        <!-- ============= Ready Start Winning =============  -->


                        <div id="bid-pack-wrap">
                            <h3><?=stripslashes($objsel["name"]); ?></h3>


                            <div id="bid-packs">

                                <p>
                                    <?php echo $objsel['short_desc']; ?>
                                </p>
                                <div style="text-align:center;">
                                    <img src="<?php echo $UploadImagePath; ?>products/<?php echo $objsel['picture1']; ?>" alt="" width="280" height="250" />
                                </div>

                            </div>
                            <br/>


                            <div id="payment-method" style="text-align:left;">
                                <h3><?php echo PAYMENT_INFORMATION; ?></h3>

                                <table width="430">
                                    <tbody>
                                        <tr>
                                            <td align="left"><strong><?php echo PRODUCT_NAME; ?></strong></td>

                                            <td width="70" align="right"><strong><?php echo POINTS ?></strong></td>
                                            <td width="70" align="right"><strong><?php echo BUY_PRICE ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><hr style="color: silver;"/></td>
                                        </tr>
                                        <tr>
                                            <td align="left"><?=stripslashes($objsel["name"]); ?></td>
                                            <td align="right"><?=$objsel["redem_points"]; ?></td>
                                            <td align="right"><?php echo $Currency; ?><span id="info_cost"><?php echo number_format($objsel["shippingcharge"], 2); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td id="coupon_title"></td>
                                            <td id="coupon_bids" align="center"></td>
                                            <td id="coupon_cost" align="right"></td>
                                        </tr>
                                        <tr>
                                            <td><br/></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" align="right">
                                                <input type="hidden" id="pkg_id" value=""/>
                                                <strong><u><?php echo TOTAL_PACKAGE_COST; ?>:</u> <?php echo $Currency; ?><span><?php echo number_format($buynowprice, 2); ?></span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php if ($objsel["shippingcharge"] <= 0) {
                                ?><div class="wraps"></div>
                                        <p>
                                    <?php echo AFTER_CLICKING_ON_CONFIRM_BUTTON_POINTS_WILL_BE_AUTOMATICALLY_DEBITED_FROM_YOUR_ACCOUNT; ?>>
                                    </p>
                                    <p>
                                        <button style="cursor: pointer" class="button" onclick="window.location.href='redeemcheckout.php?rid=<?=$_GET["pu"]; ?>'"><?php echo SUBMIT; ?></button>
                                </p>
                                <?php } ?>

                            </div>

                        </div>
                        <!-- ============= End Ready Start Winning =============  -->

                        <div id="payment-form-wrap">

                            <div id="payment-form-top"></div>
                            <div id="payment-form">


                                <h3><?php echo PAYMENT_METHODS; ?></h3>

                                <div class="paymentmethod_list">

                                    <form name="payment" action="redeempayment.php" method="post">
                                        <?php if ($mbinfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input id="mb_method" checked="checked" type="radio" name="paymentmethod" value="moneybooker" onclick="OpenDetails(this.value)" />
                                                <label for="mb_method"><img style="vertical-align:middle" src="css/quibids-1.5/moneybooker.jpg"/></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($paypalInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input id="paypal_method" checked="checked" type="radio" name="paymentmethod" value="paypal" onclick="OpenDetails(this.value)" />
                                                <label for="paypal_method"><img style="vertical-align:middle" src="css/quibids-1.5/paylogo_ppl.gif" /></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($paypalProInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="credit_method" name="paymentmethod" value="creditcard" onclick="OpenDetails(this.value)" />
                                                <label for="credit_method"><img style="vertical-align:middle" src="css/quibids-1.5/credit.png" /></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($authnetInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="auth_method" name="paymentmethod" value="authorize" onclick="OpenDetails(this.value)" />
                                                <label for="auth_method"><img style="vertical-align:middle" src="css/quibids-1.5/authorize_logo.gif" /></label>
                                            </p>
                                        <?php } ?>
                                        <?php if ($googleCheckoutInfo->isEnabled() == true) {
 ?>
                                            <p>
                                                <input type="radio" id="google_method" name="paymentmethod" value="google" onclick="OpenDetails(this.value)" />
                                                <label for="google_method"><img style="vertical-align:middle" src="css/quibids-1.5/google_checkout_logo.gif" /></label>
                                            </p>
<?php } ?>

                                        <?php if ($payflowLinkInfo->isEnabled() == true) { ?>
                                            <p>
                                                <input type="radio" id="payflowlink_method" name="paymentmethod" value="payflowlink" onclick="OpenDetails(this.value)" />
                                                <label for="payflowlink_method"><img style="vertical-align:middle" src="css/quibids-1.5/pp_logo_payflow.gif" /></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($paymentasiaInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="paymentasia_method" name="paymentmethod" value="paymentasia" onclick="OpenDetails(this.value)" />
                                                <label for="paymentasia_method"><img style="vertical-align:middle" src="css/quibids-1.5/paymentasia_logo.jpg" /></label>
                                            </p>
                                        <?php } ?>

                                        <?php if ($ccavenueInfo->isEnabled() == true) {
                                        ?>
                                            <p>
                                                <input type="radio" id="ccavenue_method" name="paymentmethod" value="ccavenue" onclick="OpenDetails(this.value)" />
                                                <label for="ccavenue_method"><img style="vertical-align:middle" src="css/quibids-1.5/ccavenue.jpg" /></label>
                                            </p>
                                        <?php } ?>

                                        <p id="buybidbut" align="right">
                                            <?php if ($paypalInfo->isEnabled() == true) {
                                            ?>
                                                <button value="BUY BIDS" name="cnfbuybids" class="button" type="submit"><?php echo PAYMENT; ?></button>
                                            <?php } ?>
                                        </p>
                                        <input type="hidden" name="redid" value="<?=$_GET["pu"]; ?>" />
                                    </form>

                                </div>

                                <div id="payment-info">
                                    <div id="creditdetail" style="display:none;">
                                        <?php if ($paypalProInfo->isEnabled() == true || $authnetInfo->isEnabled() == true) {
                                        ?>
                                                <h4><?php echo FILL_YOUR_CREDIT_CARD_DETAILS; ?> :</h4>
                                                <form action="redeemcheckout.php" method="post" name="f2" id="checkoutform">

                                            <?php include 'paymentform/creditcard.php'; ?>

                                                <input type="hidden" name="pay_method" id="pay_method" value="paypalcredit"></input>
                                                <input type="hidden" name="redid" value="<?=$_GET["pu"]; ?>" />

                                            <div class="wraps">
                                                <input name="submitbutton" id="submitbutton" value="<?php echo PAYMENT ?>" class="button" type="submit"/>
                                                <div class="clear"></div>
                                            </div>

                                        </form>
                                        <?php } ?>
                                    </div>


                                    <div id="google" class="wraps" style="display:none;">
                                        <?php if ($googleCheckoutInfo->isEnabled() == true) {
                                        ?>
                                            <h4><?php echo PAYMENT_GOOGLE_CHECKOUT; ?>:</h4>

                                            <form method="POST" action="googlepayment.php" style="text-align:center;padding:10px;">
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <input type="hidden" name="payfor" value="redeem"/>
                                                <input type="hidden" name="id" value="<?=$_GET["pu"]; ?>" />
                                                <input name="Checkout" alt="Checkout" src="css/quibids-1.5/google_checkout_logo.gif?merchant_id=&amp;w=180&amp;h=46&amp;style=trans&amp;variant=text&amp;loc=en_US" type="image" />
                                            </form>

                                        <?php } ?>
                                    </div>

                                    <div id="payflowlink" class="wraps" style="display:none;">
                                        <?php if ($payflowLinkInfo->isEnabled() == true) {
                                        ?>
                                            <h4><?php echo PAYMENT_VIA_PAYFLOWLINK; ?>:</h4>


                                            <form method="POST" action="payflowlinkpayment.php" style="text-align:center;padding:10px;">
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <input type="hidden" name="payfor" value="redeem"/>
                                                <input type="hidden" name="id" value="<?=$_GET["pu"]; ?>" />
                                                <p style="margin:0 auto;">
                                                    <button value="BUY BIDS" class="button" name="payflow" type="submit"><?php echo PAYMENT; ?></button>
                                                </p>
                                            </form>

                                        <?php } ?>
                                    </div>

                                    <div id="paymentasia" class="wraps" style="display:none;">
                                        <?php if ($paymentasiaInfo->isEnabled() == true) {
                                        ?>

                                            <h4><?php echo PAYMENT_VIA_PAYMENTASIA; ?>:</h4>

                                            <form method="POST" action="paymentasiapayment.php" style="text-align:center;padding:10px;">
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <input type="hidden" name="payfor" value="redeem"/>
                                                <input type="hidden" name="id" value="<?=$_GET["pu"]; ?>" />
                                                <button value="BUY BIDS" class="button" name="paymentasia" type="submit"><?php echo PAYMENT; ?></button>
                                            </form>

                                        <?php } ?>
                                    </div>

                                    <div id="ccavenue" class="wraps" style="display:none;">
                                        <?php if ($ccavenueInfo->isEnabled() == true) {
                                        ?>

                                            <h4><?php echo PAYMENT_CCAVENUE; ?>:</h4>

                                            <form method="POST" action="paymentccavenue.php" style="text-align:center;padding:10px;">
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <input type="hidden" name="payfor" value="redeem"/>
                                                <input type="hidden" name="id" value="<?php echo $_GET["pu"]; ?>" />
                                                <button value="BUY BIDS" class="button" name="ccavenue" type="submit"><?php echo PAYMENT; ?></button>

                                            </form>

                                        <?php } ?>
                                    </div>


                                </div>


                            </div>
                            <div id="login-form-end"></div>
                        </div>



                        <div class="clear"></div>
                        <div id="login-register-end"></div>
                    </div>
                    <!-- ============= End Registration =============  -->
                </div>
            </div>
            <div id="wrap-end"></div>
        </div> <!--end pagewidth-->

        <?php include("$BASE_DIR/include/$template/footer.php") ?>
    

