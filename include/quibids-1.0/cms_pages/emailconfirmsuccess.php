       <div id="main" class="wrapper">

            	<?php include_once('include/' . $template . '/header.php'); ?>

            <div id="container">

	
                
        
            <div id="column-left">
				<!-- last winner -->
            	<?php include("leftside.php"); ?>
			</div><!-- /column-left-->
            
            <div id="column-right">
            
                    <div id="title-category-content">

			<?php  include("include/addons/category_menu/quibids-2.0/index.php"); ?>
                        <p class="bid-title"><strong><?php echo $SITE_NM; ?> - <?php echo CONFIRM; ?></strong></p>

                    </div><!-- /title-category-content -->
            	<div id="registerBox" class="content">
					
                    <div class="rounded_corner">                
                        
                        <div class="content">
                            <p>
                                <h2 style="border:none;"><?php echo CONGRATULATIONS; ?></h2><br />
                                <p><?php echo YOUR_EMAIL_VERIFICATION_IS_CONFIRMED_SUCCESSFULLY;?>, <?php echo PLEASE; ?> <a href="myaccount.php"><strong><?php echo CLICK_HERE; ?></strong></a> <?php echo TO_CONTINUE; ?></p>
                            </p>
                        </div>        	
                    </div>
                </div>
			</div><!-- /column-right -->	
		</div><!-- /container -->

	
				
			  
		<?php include($BASE_DIR . '/include/quibids-2.0/footer.php'); ?>
</div><!-- /container -->
      