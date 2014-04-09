
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->
            <div id="wrapper" class="clearfix">
                <div id="maincol">

                    <!-- ============= Ending Auctions =============  -->
                    
                        <div id="live-auctions">
                            <div id="live-auctions-head">
                                <h3><?php echo NEWS; ?></h3>
                            </div>

                            <div style="min-height:300px;padding:20px;">
                                <h4><?=$objsel["news_title"];?></h4>

                                <p>
                                    <?=$objsel["news_long_content"];?>
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

    

