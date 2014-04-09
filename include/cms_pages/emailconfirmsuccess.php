<?php
if(empty($dont_show_left)){
$dont_show_left = array();
}
//Uncomment items below to remove them from ALL PAGES for ALL TEMPLATES SO LONG AS THEY ARE 100% USING THE NORMAL FRAMEWORK...IF NOT THEN LETS FIX THAT FIRST
//Skinny column
//$dont_show_left[] = 'testimonials';
//$dont_show_left[] = 'last_winner';
//$dont_show_left[] = 'right_social';
//$dont_show_left[] = 'coupon_menu';
//$dont_show_left[] = 'bidpack_menu';
//$dont_show_left[] = 'user_menu';
//$dont_show_left[] = 'help_menu';
$dont_show_left[] = 'faq_menu';
//$dont_show_left[] = 'top_menu';
//$dont_show_left[] = 'search_box';
//$dont_show_left[] = 'category_menu';

?>
<style>
    .rounded_corner {
    
    margin-left:20px!important;
    }

</style>
<div id="main">
  <?php  include("header.php"); ?>
     <div id="container">
        <?php  include("include/topmenu.php"); ?>
        <div class="tab-area">
        <div id="column-right">
            <?php  include("include/searchbox.php"); ?>
            <div id="title-category-content">
                <?php  include("include/categorymenu.php"); ?>
                <p class="bid-title"><strong><?php echo $SITE_NM; ?> - <?php echo COMMUNITY; ?></strong></p>
            </div><!-- /title-category-content -->
            
            
           
			 <div id="registerBox" class="content">
					<h2><span><?php echo EMAIL_CONFIRMATION; ?></span></h2>
				    <div class="rounded_corner">                
					
					<div class="content">
					    <p>
						<h2 style="border:none;"><?php echo CONGRATULATIONS; ?></h2><br />
						<div class="clear"></div>
						
						<p><?php echo YOUR_EMAIL_VERIFICATION_IS_CONFIRMED_SUCCESSFULLY;?>, <?php echo PLEASE; ?> <a href="myaccount.php"><strong><?php echo CLICK_HERE; ?></strong></a> <?php echo TO_CONTINUE; ?></p>
					    </p>
					</div>        	
				    </div>
                
			</div><!-- /column-right -->	
		</div>
		<div id="column-left">
            <?php  include("leftside.php"); ?>
        </div><!-- /column-left -->
        </div>
    </div><!-- /container -->
  
  <?php  include("footer.php"); ?>
