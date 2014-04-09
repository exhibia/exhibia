  <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div class="tab-area">
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo NEW_LETTERS; ?></strong></p>
                    </div><!-- /title-category-content -->
                    <div class="rounded_corner">
                        <div class="content">
                            <?php
                            if($_GET["msg"]!="") {
                                if($_GET["msg"]==1) {
                                    ?>

                            <div style="padding-left: 25pt;">
                                <div class="normal_text"><?php echo THANK_YOU_FOR_SUBSCRIBING_TO_OUR_NEWSLETTER; ?></div><br />
                                <div class="normal_text"><?php echo PLEASE_TAKE_A_LOOK;?> <a href="index.php" class="darkblue-12-link"><?php echo HERE;?></a> <?php echo TO_FIND_INCREDIBLE_BARGAINS; ?></div><br />
                                <div class="normal_text"><?php echo HAVE_FUN_AND_GOOD_LUCK;?></div><br />
                                <div class="normal_text"><?php echo YOUR_THE;?> <?=$SITE_NM;?> - <?php echo TEAM;?></div>
                                <div class="clear" style="height: 20px;">&nbsp;</div>
                            </div>

                                    <?php
                                }elseif($_GET["msg"]==2) {
                                    ?>
                            <div style="padding-left: 25pt;">
                                <div class="normal_text"><?php echo YOU_HAVE_UNSUBSCRIBED_FROM_OUR_NEWSLETTER; ?></div><br />
                                <div class="normal_text"><a href="index.php" class="darkblue-12-link"><?php echo HERE_YOU_CAN_SEE_OUR_ALL_LIVE_AUCTIONS;?></a></div><br />
                                <div class="normal_text"><?php echo YOUR;?> <?php $SITE_NM;?> - <?php echo TEAM; ?></div>
                                <div class="clear" style="height: 20px;">&nbsp;</div>
                            </div>
                                    <?php
                                }
                            }else {
                                ?>
                            <div style="padding-left: 25pt;">
                                <ul class="error">
                                        <?php if($msg==3) {
                                            ?>

                                    <li><?php echo PLEASE_ENTER_EMAILADDRESS_TO_SUBSCRIBE;?></li>
                                            <?
                                        } elseif($msg==4) {
                                            ?>

                                    <li><?php echo PLEASE_ENTER_EMAILADDRESS_TO_UNSUBSCRIBE;?></li>
                                            <?php
                                        }elseif($msg==5) {
                                            ?>
                                    <li><?php echo PLEASE_CHECK_YOUR_EMAIL_ADDRESS_AGAIN;?></li>
                                            <?php
                                        }
                                        ?>
                                </ul>
                            </div>
                            <br />
                            <div style="padding-left: 25pt;">
                                <p><h2><?php echo WANT_US_TO_LET_YOU_KNOW_ABOUT_NEW_AUCTIONS_SPECIAL_OFFERS; ?></h2></p><br />

                                <p><?php echo SUBSCRIBE_TO_NEWSLETTER; ?>:</p><br />

                                <p><?php echo YOUR_EMAIL;?> : </p><br />

                                <form name="newsletter" action="" method="post" onsubmit="return Check();">

                                    <p>
                                        <input type="text" name="subemail" class="logintextboxclas" size="50" maxlength="100" />
                                        <button class="button77" type="submit" value="Subscribe" name="subscribe"><?php echo SUBSCRIBE; ?></button>
                                    </p>

                                    <input type="hidden" name="subscribesubmit" value="subscribesubmit" />

                                </form>
                            </div>
                            <br />
                            <div style="padding-left: 25pt;">
                                <form name="newsletter1" action="" method="post">

                                    <p><h2><?php echo DONT_WANT_TO_HEAR_ABOUT_OUR_GREAT_DEALS_ANY_MORE; ?></h2></p><br />

                                    <p><?php echo UNSUBSCRIBE_TO_NEWSLETTER; ?> :</p><br />

                                    <p><?php echo YOUR_EMAIL; ?> : </p><br />

                                    <p>
                                        <input type="text" name="unsubemail" class="logintextboxclas" size="50" maxlength="100" />
                                        <button class="button77" type="submit" value="Unsubscribe" name="unsubscribe"><?php echo UNSUBSCRIBE; ?></button>
                                    </p>

                                    <input type="hidden" name="unsubscribesubmit" value="unsubscribesubmit" />
                                </form>
                            </div>
                                <?
                            }
                            ?>
                        </div>
                    </div><!-- /content -->
                </div><!-- /column-right -->
                <div id="column-left">
                    <?php include("leftside.php"); ?>
                   
                </div><!-- /column-left -->
                
                </div>
            </div><!-- /container -->

            <?php include("footer.php"); ?>
         
