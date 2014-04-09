       <div id="main" class="wrapper">
            	<?php include_once('include/' . $template . '/header.php'); ?>

            <div id="container">


      
	<div id="column-right">
	<div id="title-category-content">
	
			<?php  include("include/addons/category_menu/quibids-2.0/index.php"); ?>
	<p class="bid-title"><strong><?php echo CNEWS; ?></strong></p>
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
                
                 <div id="column-left">
                    <!-- last winner -->
                    <?php include("leftside.php"); ?>
                </div><!-- /column-left-->
             </div>
            </div><!-- /container -->

		<?php include($BASE_DIR . '/include/quibids-2.0/footer.php'); ?>
</div><!-- /container -->