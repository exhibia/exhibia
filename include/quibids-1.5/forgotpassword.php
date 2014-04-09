
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->
            <div id="wrapper" class="clearfix">
                <div id="maincol">

                    <!-- ============= Ending Auctions =============  -->

                    <div id="live-auctions">
                        <div id="live-auctions-head">
                            <h3><?php echo FORGET_PASSWORD; ?></h3>
                        </div>

                        <div style="min-height:300px;padding:20px;">



                            <?
                            if ($_POST["email"] != "" && $total > 0 && $obj->account_status != '0') {
                            ?>
                                <p style="margin-left: 25pt;">
                                    <p><?php echo AN_EMAIL_WAS_SENT_TO; ?> : <?=$email; ?></p>
                                    <br />
                                    <p><a href="index.php"><?php echo HOME; ?></a></p>
                                </p>
                            <?
                            } else {
                            ?>
                                <form name="forgot" method="post" action="forgotpassword.php" onsubmit="return check();">								<br />
                                    <br />
                                <?php if ($msg == 1) {
                                ?>
                                    <p style="margin-left: 25pt;" class="redfont"><?php echo SORRY_WE_DIDNT_FIND_YOUR_EMAIL_ADDRESS_IN_OUR_SYSTEM; ?></p>
                                    <br />
                                <?php } elseif ($msg == 2) {
                                ?>
                                    <p style="margin-left: 25pt;" class="redfont"><?php echo THIS_ACCOUNT_IS_NOT_VERIFIED_YET_PLEASE_VERIFY_FIRST; ?></p>
                                    <br />
                                <?php } ?>
                                <div style="margin-left: 25pt;">
                                    <p class="normal_text"><B><?php echo YOU_HAVE_FORGOTTEN_YOUR_LOGIN_DATA; ?></B></p>
                                    <br />
                                    <p class="normal_text"><?php echo NO_PROBLEM_JUST_ENTER_YOUR_EMAIL_AND_WE_WILL_SEND_THE_INFORMATION_TO_YOUR_EMAIL_ACCOUNT; ?></p>
                                    <br />
                                    <p class="normal_text"><b><?php echo YOUR_EMAIL; ?> : </b></p>
                                    <br />                                    
                                    <p>
                                        <input type="text" name="email" size="50" class="logintextboxclas" />
                                        <br />
                                        <br />
                                        <button class="button77"><?php echo SUBMIT; ?></button>
                                        <input type="hidden" name="submit" value="SUBMIT" />
                                        <br />
                                    </p>
                                </div>
                                <br />       
                                <br /> 
                            </form>
                            <?
                            }
                            ?>





                        </div>

                        <div id="live-auctions-end"></div>
                    </div>

                    <!-- ============= End Ending Auctions =============  -->
                    <div class="clear"></div>

                </div>
            </div>
            <div id="wrap-end">

            </div>
        </div>

        <?php include("$BASE_DIR/include/$template/footer.php") ?>
    
