
        <div id="main">
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div id="column-left">
                    <!-- last winner -->
                    <?php include("include/lastwinner.php"); ?>
                    <?php include("include/bidpackage.php"); ?>
                    <img src="include/addons/icons/quibids-1.0/credit-cards.gif" alt="" />
                </div><!-- /column-left-->

                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo NEWS; ?></strong></p>
                    </div><!-- /title-category-content -->
                    <div class="rounded_corner">
                        <div class="content">
                            <h2><?=$objsel["news_title"];?></h2>
                            <br/>
                            <p>
                                <?=$objsel["news_long_content"];?>
                            </p>
                        </div>
                    </div>
                </div><!-- /column-right -->
            </div><!-- /container -->
            <?php include("$BASE_DIR/include/$template/footer.php"); ?>
        </div><!-- /main -->
    

