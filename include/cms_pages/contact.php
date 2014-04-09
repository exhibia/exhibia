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
	<div id="main">
	<?php
	include("header.php");
	?>
	<div id="container">
	<?php include("include/topmenu.php"); ?>
	<div class="tab-area">
	<div id="column-right">
	<?php include("include/searchbox.php"); ?>
	<div id="title-category-content">
	<?php include("include/categorymenu.php"); ?>
	<p class="bid-title"><strong><?php echo CONTACT_US; ?> - <?php echo FILL_OUT_THE_FORM_BELOW; ?></strong></p>
	</div><!-- /title-category-content -->
	<div class="rounded_corner">
	<div class="content">
	<h2><?php echo CONTACT_US; ?></h2>
      <?php 
	 $rssel = db_query("select content from static_pages where page='" . basename(str_replace(".php", "", $_SERVER['PHP_SELF'])) ."'");

	 $rssel = db_query($qrysel);
	 $obj = db_fetch_object($rssel);
	 ?>
	 <?=$obj->content;?>
	<?php include("gbcf_form.php"); ?>
	</div>
	</div>
	</div>
	<div id="column-left">
	<?php include("leftstatic.php"); ?>
	
	</div><!-- /column-left -->
	</div>
	</div>
	<?php include("footer.php");?>
	</div> 
