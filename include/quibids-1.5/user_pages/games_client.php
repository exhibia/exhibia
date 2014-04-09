
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

                            <!-- ============= Recently Won Auctions =============  -->
                               <?php
                                
                     include($BASE_DIR . "/include/addons/games-client/index.php");
                                
                                
                                
                                ?>


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

