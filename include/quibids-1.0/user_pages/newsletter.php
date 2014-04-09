
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
            <!-- ============= End Header =============  -->

              <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <!-- ============= MyQuibids nav =============  -->
                    <ul id="myqb-nav">
                        <li ><a href="myaccount.php" class="active"><span><?php echo 'MY ACCOUNT'; ?></span></a></li>
                    </ul>
                    <!-- ============= End MyQuibids nav =============  -->
                    <!-- ============= MyQuibids wrap =============  -->
                    <div id="myqb-wrap">
                        <div id="myqb">

                            <h1><?php echo NEW_LETTERS; ?></h1>
                            <div style="width: 550px;">

                                <?
                                if ($_GET["msg"] != "") {
                                    if ($_GET["msg"] == 1) {
                                ?>

                                        <div>
                                            <div class="normal_text"><?php echo THANK_YOU_FOR_SUBSCRIBING_TO_OUR_NEWSLETTER; ?></div><br />
                                            <div class="normal_text"><?php echo PLEASE_TAKE_A_LOOK; ?> <a href="index.php" class="darkblue-12-link"><?php echo HERE; ?></a> <?php echo TO_FIND_INCREDIBLE_BARGAINS; ?></div><br />
                                            <div class="normal_text"><?php echo HAVE_FUN_AND_GOOD_LUCK; ?></div><br />
                                            <div class="normal_text"><?php echo YOUR_THE; ?> <?=$SITE_NM; ?> - <?php echo TEAM; ?></div>
                                            <div class="clear" style="height: 20px;">&nbsp;</div>
                                        </div>

                                <?
                                    } elseif ($_GET["msg"] == 2) {
                                ?>
                                        <div>
                                            <div class="normal_text"><?php echo YOU_HAVE_UNSUBSCRIBED_FROM_OUR_NEWSLETTER; ?></div><br />
                                            <div class="normal_text"><a href="index.php" class="darkblue-12-link"><?php echo HERE_YOU_CAN_SEE_OUR_ALL_LIVE_AUCTIONS; ?></a></div><br />
                                            <div class="normal_text"><?php echo YOUR; ?> <?php $SITE_NM; ?> - <?php echo TEAM; ?></div>
                                            <div class="clear" style="height: 20px;">&nbsp;</div>
                                        </div>
                                <?
                                    }
                                } else {
                                ?>
                                    <div>
                                        <ul>
                                        <?php if ($msg == 3) {
                                        ?>

                                            <li><?php echo PLEASE_ENTER_EMAILADDRESS_TO_SUBSCRIBE; ?></li>
                                        <?
                                        } elseif ($msg == 4) {
                                        ?>

                                            <li><?php echo PLEASE_ENTER_EMAILADDRESS_TO_UNSUBSCRIBE; ?></li>
                                        <?
                                        } elseif ($msg == 5) {
                                        ?>
                                            <li><?php echo PLEASE_CHECK_YOUR_EMAIL_ADDRESS_AGAIN; ?></li>
                                        <?
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <br />
                                <div>
                                    <p><h2><?php echo WANT_US_TO_LET_YOU_KNOW_ABOUT_NEW_AUCTIONS_SPECIAL_OFFERS; ?></h2></p>

                                    <p><?php echo SUBSCRIBE_TO_NEWSLETTER; ?>:</p>

                                    <p><?php echo YOUR_EMAIL; ?> : </p>

                                    <form name="newsletter" action="" method="post" onsubmit="return Check();">

                                        <p>
                                            <input type="text" name="subemail" size="50" maxlength="100" />
                                            <input name="subscribe" value="<?php echo SUBSCRIBE; ?>" class="buttonr" type="submit"/>
                                        </p>

                                        <input type="hidden" name="subscribesubmit" value="subscribesubmit" />

                                    </form>
                                </div>
                                <br />
                                <div>
                                    <form name="newsletter1" action="" method="post">

                                        <p><h2><?php echo DONT_WANT_TO_HEAR_ABOUT_OUR_GREAT_DEALS_ANY_MORE; ?></h2></p>

                                        <p><?php echo UNSUBSCRIBE_TO_NEWSLETTER; ?> :</p>

                                        <p><?php echo YOUR_EMAIL; ?> : </p>

                                        <p>
                                            <input type="text" name="unsubemail" size="50" maxlength="100" />
                                            <input name="subscribe" value="<?php echo UNSUBSCRIBE; ?>" class="buttonr" type="submit"/>
                                        </p>

                                        <input type="hidden" name="unsubscribesubmit" value="unsubscribesubmit" />
                                    </form>
                                </div>
                                <?
                                    }
                                ?>

                                </div>
                                <!-- ============= /Recently Won Auctions =============  -->


                            </div>
                            <!-- ============= Left Navigation =============  -->

                        <?php include $BASE_DIR . '/include/' . $template . '/mybid_nav.php'; ?>

                                    <!-- ============= End Left Navigation =============  -->
                                    <div class="clear"></div>
                                    <div id="myqb-end"></div>
                                </div>
                                <!-- ============= End MyQuibids wrap =============  -->
                            </div>
                        </div>
                        <div id="wrap-end"></div>
                    </div> <!--end pagewidth-->

        <?php include $BASE_DIR . '/include/' . $template . '/footer.php' ?>
  
