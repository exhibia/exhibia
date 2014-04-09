
        <div id="main">

            	<?php if(empty($header)){ include_once($BASE_DIR . '/include/' . $template . '/header.php'); } ?>

            <div id="container">

                <?php if(empty($nav_menu)) { include_once($BASE_DIR . "/include/topmenu.php"); } ?>
	 <div class="tab-area">
                <div id="column-right">

                    <?php include_once($BASE_DIR . "/include/searchbox.php"); ?>

                    <div id="title-category-content">

                        <?php include_once($BASE_DIR . "/include/categorymenu.php"); ?>
                                                <p class="bid-title"><strong><?=$SITE_NM; ?> - <?php echo SELECT_MY_AVATAR; ?></strong></p>
                                            </div><!-- /title-category-content -->
                                            <div class="rounded_corner">
                                                <div class="content">
                                                       <?php
                                
							  include($BASE_DIR . "/include/addons/games-client/index.php");
							?>

                                                    </div><!-- /content -->
                                                </div><!-- /column-right -->
                                                <div id="column-left">
                    <?php include("leftside.php"); ?>
                    <?php include("include/bidpackage.php"); ?>
                                       
                                    </div><!-- /column-left -->
                                    </div>
                                </div><!-- /container -->

            <?php include("footer.php"); ?> 