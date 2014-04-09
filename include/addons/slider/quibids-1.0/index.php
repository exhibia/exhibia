<?php
//To turn off html content change this to no
$enable_html_slider_content = 'yes';

if($enable_html_slider_content == 'yes'){
?>

<script type="text/javascript" src="<?php echo $SITE_URL; ?>js/coin-slider.min.js"></script>

<div id="feature">
    <div id="slider">
<!-- slider 1 -->

	<a href="registration.php">
	  
<?php echo SLIDER1;?>

	</a>

<!-- slider 2 -->

	<a href="registration.php">
	  
<?php echo SLIDER2;?>

	</a>

<!-- slider 3 -->

	<a href="<?php echo $SITE_URL;?>wonauctions.php">
	
<?php echo SLIDER3;?>
  
	</a>
	
<!-- slider 4 -->

	<a href="<?php echo $SITE_URL;?>aboutus.php">

<?php echo SLIDER4;?>

	 </a>
	 
<!-- slider 5 -->

	<a href="<?php echo $SITE_URL;?>contact.php">

<?php echo SLIDER5;?>

	</a>

	</div><!--slider-->


	    <div id="slider-nav">
		  <ul class="tabs">
		      <li class="active" id="t0" time="8000" class=""> <a href="#howItWorks"><img src="img/how.png"><?php echo HOW_IT_WORKS;?></a></li>
		      <li class="" id="t1" time="9000"><a href="#audited"><img src="img/bbb.png"><?php echo HONEST_BUSINESS;?></a></li>
		      
		         <li class="" id="t2" time="6000"><a href="#winnersDaily"><img src="img/icons/coin.gif" ><?php echo WINNERS;?></a></li>
		      <li class="" id="t3" time="7000"><a href="#badges"><img src="img/badges.png"><?php echo FREE_POINTS;?></a></li>
		      <li class="" id="t4" time="9000"><a href="#support"><img src="img/support.png"><?php echo SUPPORT;?></a></li>

		  </ul><!--tabs-->
	    </div><!--slider-nav-->
	<div class="bottom"></div>

<script>Carousel = new Class_Carousel();</script>

   	  	        </div><!--fleft-->
				</div><!--fright--> 
<?php } ?>