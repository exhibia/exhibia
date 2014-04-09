
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->

              <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <!-- ============= MyQuibids nav =============  -->
                    <ul id="myqb-nav">
                        <li ><a href="myaccount.php" class="active"><span><?php echo MY_ACCOUNT; ?></span></a></li>
                    </ul>
                    <!-- ============= End MyQuibids nav =============  -->
                    <!-- ============= MyQuibids wrap =============  -->
                    <div id="myqb-wrap">
                        <div id="myqb">

                            <!-- ============= Recently Won Auctions =============  -->
                            <h1><?php echo REFER_A_FRIEND; ?></h1>
                            <div class="clear"></div>
                            
                                <div style="width: 550px;">
                                    <form name="affiliate" method="post" action="" onSubmit="return Check()">
                                        <?php if ($_GET["sc"] == "1") {
                                        ?>
                                            <div class="greenfont" style="margin-left: 100px;"><?php echo EMAIL_SENT_SUCCESSFULLY; ?></div>
                                            <div style="height:10px;">&nbsp;</div>
                                        <?php } ?>

                                        <p><b><?php echo YOUR_AFFILIATE_URL; ?> : </b>&nbsp;&nbsp; <strong><?=$SITE_URL; ?>registration.php?ref=<?=$uid; ?></strong></p>
                                        <br />
                                        <p><b><?php echo YOUR_AFFILIATE_CODE; ?> : &nbsp;&nbsp;<?=$uid; ?></b></p>
                                        <br />
                                        <p><?php echo ENTER_EMAIL_ADDRESS_TO_INVITE; ?> :</p>
                                        <p>
                                            <textarea name="emailaddresses" cols="50" rows="5" class="logintextboxclas"></textarea>
                                        </p>
                                        <br />
                                        <p style="text-align:center;">
                                            <input name="sendem" value="<?php echo SEND; ?>" class="buttonr" type="submit"/>
                                        </p>

                                        <input type="hidden" name="send" value="send" />

                                    </form>
                                </div>
                           
                            <!-- ============= /Recently Won Auctions =============  -->


                        </div>
                        <!-- ============= Left Navigation =============  -->

                        <?php include 'include/mybid_nav.php'; ?>

                                        <!-- ============= End Left Navigation =============  -->
                                        <div class="clear"></div>
                                        <div id="myqb-end"></div>
                                    </div>
                                    <!-- ============= End MyQuibids wrap =============  -->
                                </div>
                            </div>
                            <div id="wrap-end"></div>
                        </div> <!--end pagewidth-->

        <?php include("$BASE_DIR/include/$template/footer.php") ?>
    

