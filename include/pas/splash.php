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
                 <?php include("include/topmenu.php"); ?>
<?php
		
		     db_query("CREATE TABLE IF NOT EXISTS `email_leads` (
		      `id` int(11) NOT NULL auto_increment,
		      `firstname` varchar(150) NULL default '',
		      `lastname` varchar(150) NULL default '',
		      `email` varchar(150) NOT NULL default '0',
		      `points_to_give` varchar(150) NOT NULL default '0',
		      `type_to_give` varchar(150) NOT NULL default '0',
		      PRIMARY KEY  (`id`)
		    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
		    $error = '';
		    if(!empty($_REQUEST['preregister'])){
		    
			if(empty($_REQUEST['firstname'])){
			  $error .= 'Please supply  a first name';
			}
			if(empty($_REQUEST['lastname'])){
			  $error .= 'Please supply  a last name';
			}
		if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
			    $error .= 'Please supply a valid email address';
			}
		    
		    }else{
		
		    if(!empty($error)){
		      echo '<ul>' . $error . '</ul>';
		    
		    
		    }else{
		    
			  preregister($_REQUEST, $points_to_give, $from_where);
		    
		    
		    
		    
		    }
		?>

			<FORM action="splash.php" method="GET" enctype="multipart/form-data" target="_self" id="splash_form" class="splash_form login_form">
				<fieldset>

					<p>
						<label for="firstname">
							First Name
						</label>
						<INPUT type="text" name="firstname" value="Firstname" tabindex="1" id="firstname" />
					</p>
					<p>
						<label for="firstname">
						</label>
						<INPUT type="text" name="firstname" value="First name" tabindex="1" id="firstname" />
					</p>
					<p>
						<label for="lastname">
							Last Name
						</label>
						<INPUT type="text" name="lastname" value="Last name" tabindex="1" id="lastname" />
					</p>
					<p>
						<label for="email">
							Email Address
						</label>
						<INPUT type="text" name="email" value="email" tabindex="1" id="email" />
					</p>
					<p>
						<label for="preregister">
						</label>
						<INPUT type="submit" name="preregister" value="Pre Register" tabindex="1" id="preregister" />
					</p>

				</fieldset>
   
 			</FORM>					






		<?php } ?>
	    </div><!-- /container -->
<?php
if($_SESSION['admin'] >= 1){	//temporary rule to fix a broken tag when logged in to design suite	      
?>

	
	 
<?php } ?>	    
		  <?php include("include/footer.php"); ?>    
            
	</div>
            
            <div id="bidder_count" style="display:none;">4</div> 
