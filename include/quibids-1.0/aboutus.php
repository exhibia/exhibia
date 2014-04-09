

	<div id="pagewidth">
	
	<?php include_once('include/' . $template . '/header.php'); ?>


            <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <!-- ============= Auction Listing =============  -->

                    <div id="auction-listing">
                        <div id="live-auctions">
                            <h2 id="about-head"><?php echo ABOUT_US; ?></h2>
                            <div id="faq-wrap">
                                <div id="contact-support">
                                    <div id="faq-top"></div>
                                    <h2><?php echo ABOUT_US; ?></h2>
                                    

                                    <?php
                                    $rssel = db_query("select content from static_pages where id=2");

                                    echo (db_num_rows($rssel) > 0 ? stripslashes(db_result($rssel, 0)) : "");

                                    db_free_result($rssel);
                                    ?>


                                    <div id="faqs-end"></div>
                                </div>
                            </div>
                             <div id="column-left">
                    <?php include("leftstatic.php"); ?>
                    
                </div><!-- /column-left -->
                                    <!-- ============= End Left Navigation =============  -->

                                    <div class="clear"></div>
                                    <div id="faqs-end-bg"> </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="wrap-end"></div>
                </div>

        <?php include $BASE_DIR . '/include/' .$template . '/footer.php' ?>
 