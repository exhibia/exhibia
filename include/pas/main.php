<?php
if(empty($dont_show)){
$dont_show = array();
}
//Uncomment items below to remove them from THIS page for THIS template ONLY

//Skinny column column right


$dont_show[] = 'testimonials';
//$dont_show[] = 'last_wiinner';
//$dont_show[] = 'right_social';
//$dont_show[] = 'coupon_menu';
//$dont_show[] = 'bidpack_menu';
//$dont_show[] = 'user_menu';
//$dont_show[] = 'help_menu';
//$dont_show[] = 'faq_menu';
//$dont_show[] = 'top_menu';
//$dont_show[] = 'search_box';
//$dont_show[] = 'category_menu';

//Wide column column left

//$dont_show[] = 'auction_boxes';
//$dont_show[] = 'search_box';
$dont_show[] = 'steps_box';
//$dont_show[] = 'slider';


?>
 

	<div id="main">
	<?php include("header.php"); ?>
	
            <div id="container">
                 <?php include($BASE_DIR . "/include/topmenu.php"); ?>
                 
                 
		<?php foreach($page_areas['container'] as $key => $value){
		
			  include($BASE_DIR . '/page_areas/container/' . $value . ".php"); 
		      if($_SESSION['admin'] >= 1){	//temporary rule to fix a broken tag when logged in to design suite	      
		      ?>
	
	   
		  <?php
		  
		  }
		  }
		?>
	    </div><!-- /container -->
<?php
if($_SESSION['admin'] >= 1){	//temporary rule to fix a broken tag when logged in to design suite	      
?>

	
	 
<?php } ?>	    
		  <?php include("include/footer.php"); ?>    
            
	</div>
            
            <div id="bidder_count" style="display:none;">4</div> 
