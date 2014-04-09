
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->
            <div id="wrapper" class="clearfix">
                <div id="maincol">

                    <!-- ============= Ending Auctions =============  -->

                    <div id="live-auctions">
                        <div id="live-auctions-head">
                            <h3><?php echo EMAIL_CONFIRMATION; ?></h3>
                        </div>

                        <div style="min-height:300px;padding:20px;">

                            <p>
                                <h2 style="border:none;"><?php echo CONGRATULATIONS; ?></h2><br />
                                <p><?php echo YOUR_EMAIL_VERIFICATION_IS_CONFIRMED_SUCCESSFULLY; ?>, <?php echo PLEASE; ?> <a href="myaccount.php"><strong><?php echo CLICK_HERE; ?></strong></a> <?php echo TO_CONTINUE; ?></p>
                            </p>

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

    
