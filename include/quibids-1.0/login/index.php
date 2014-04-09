   <div class="rounded_corner">
                        <div id="register-now-box">
                            <div style="margin-left: 50px; margin-top: 20px;">
                                <div class="title"><?php echo NEW_TO; ?>
<?= $SITE_NM; ?>
                            </div>
                            <br />
                            <div class="title1"><?php echo REGISTER_NOW; ?></div>
                            <br />
                            <div>
<?= $SITE_NM; ?>
                                - <?php echo HOME_OF_THE_MOST_EXCITING_AUCTIONS_ON_THE_INTERNET; ?> </div>
                            <br />
                            <ul>
                                <li><?php echo NEW_BRAND_NAME_PRODUCTS_AND_AMAZING_PRICES; ?></li>
<?php if ($objregmsg["reg_message"] != "") { ?>
                                <li>
<?= $objregmsg["reg_message"]; ?>
                                </li>
                                <?php } ?>
<?php /* ?><li><?=$Currency;?>20 voucher, redeemable from your first auction win</li><?php */ ?>
                                <li><?php echo FREE_REGISTRATION; ?></li>
                            </ul>
                            <br />
                            <div style="margin-top: 25px; padding-left: 70px;">
                                <button type="submit" name="register" onclick="window.location.href='registration.php'"><?php echo REGISTER; ?></button>
                            </div>
                        </div>
                    </div>
                    <div id="already-registered">
                        <form name="f1" method="post" action="password.php">
                            <div style="margin-left: 20px; margin-top: 20px;">
                                <div class="title1"><?php echo HAVE_YOU_ALREADY_REGISTERED; ?></div>
                                <br />
                                <div class="title"><?php echo PLEASE_ENTER_YOUR_LOGIN_DATA_HERE; ?></div>
                                <div style="margin-top:15px; font-size:12px; margin-left: 20px;">
                                    <p>
                                        <label><?php echo USERNAME; ?>:</label>
                                        <input type="text" name="username" id="username" class="logintextboxclas" />
                                    </p>
                                    <br />
                                    <p>
                                        <label><?php echo PASSWORD; ?>:</label>
                                        <input type="password" name="password" id="password" class="logintextboxclas" />
                                    </p>
                                    <br />
                                    <p>
				      <?php include("login-buttons.php"); ?>
                                    </p>
                                    <br />
                                    <div><a href="forgotpassword.php"><?php echo FORGOTTEN; ?></a> <?php echo USERNAME_OR_PASSWORD; ?></div>
                                    <?
                                    if ($_GET["err"] == 1) {
                                    ?>
                                        <br />
                                        <div class="error"><?php echo INVALID_USERNAME_PASSWORD; ?>.</div>
                                    <?
                                    } elseif ($_GET['err'] == 2) {
                                    ?>
                                        <br />
                                        <div class="error"><?php echo YOUR_ACCOUNT_IS_SUSPENDED_BY; ?>
<?= $SITE_NM; ?>.
                                    </div>
                                    <?
                                    } elseif ($_GET['err'] == 3) {
                                    ?>
                                        <br />
                                        <div class="error"><?php echo YOUR_ACCOUNT_IS_DELETED_BY; ?>
<?= $SITE_NM; ?>.
                                    </div>
                                    <?
                                    } elseif ($_GET['err'] == 4) {
                                    ?>
                                        <br />
                                        <div class="error"><?php echo PLEASE_ENTER_USERNAME_AND_PASSWORD; ?></div>
                                    <?
                                    } elseif ($_GET['err'] == 5) {
                                    ?>
                                        <br />
                                        <div class="error"><?php echo PLEASE_ENTER_PASSWORD; ?></div>
                                    <?
                                    }
                                    ?>
                                </div>
                            </div>
                            <input type="hidden" name="fid" value="<?php echo $fid; ?>" />
                            <input type="hidden" name="tid" value="<?php echo $tid; ?>" />
                        </form>
                    </div> 