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
<?php include_once('include/' . $template . '/header.php'); ?>
		  <div class="clear"></div>
               
        <div id="main">

           
		<div id="container">
         
                
                    
<!--custom_page-->	<h2>Welcome to <?php cho $SITE_NM;?></h2><p>Snapbids 101 is an information portal built by Snapbids to educate users of how our auction system works and most importantly—how to have the best chances of winning! Since Snapbids has launched, we've received a variety of questions that we feel would benefit you, so we didn't just limit them to our FAQ section.</p><p>Unlike other auction websites, our goal is to make our auction model as transparent as possible and to help you, the user, have the best chances of taking home awesome products! We encourage you to browse and explore more about our company and how to best participate in our auctions. Snap Away!</p><p><br></p><h2>How Does GUNSBID&nbsp;Work?</h2><p><img data-cke-saved-src="http://pennyauctionsoftdemo.com/snapbids/img/snapbids-101-mainimage.png" src="http://pennyauctionsoftdemo.com/snapbids/img/snapbids-101-mainimage.png"></p><p>* If you lose, your bids can be counted towards a discounted purchase price on the item</p><!--custom_page-->

                <?php
              if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag >= 1")) >= 1){
              
              ?>
		      <h2 onclick="javascript: add_blank_page('<?php echo basename($_SERVER['PHP_SELF']);?>');">Edit Page</h2>
              
              
              <?php
              }
              ?>
                </div>
              

        </div>
	  
		<?php include($BASE_DIR . '/include/' . $template . '/footer.php'); ?>
</div><!-- /container -->