
        <div id="pagewidth">
        
        
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->
           
	    <div id="wrapper" >            
                   
                            <?php include("$BASE_DIR/include/addons/slider/$template/index.php"); ?>
		<div id="maincol">                     
<!-- ============= Steps =============  -->
                    <div id="steps">
                        <div id="bid-win">
                            <div class="bid-win-text">
                                <span><?php echo BID_NOW; ?></span><br/>
                                <div><?php echo EXCITING_PRODUCTS; ?></div>
                            </div>                           

                            <a href="registration.php" id="register_btn">
                                <?php echo REGISTER; ?>
                            </a>
                        </div>
                        <ul>
                            <li id="step1">
			      
			      <p id="step1-p1"></p>
                                <h4 id="step1-p2"></h4>
                                <span id="step1-span"><?php echo BID_PRICE;?></span>
                            </li>
                            <li id="step2">
			      <p id="step2-p1"></p>
                                <h4 id="step2-p2"></h4>
                                <span id="step2-span"><?php echo PICK_A_PRODUCT;?></span>
                            </li>
                            <li id="step3">
			      <p id="step3-p1"></p>
                                <h4 id="step3-p2"></h4>
                                <span id="step3-span"><?php echo IF_LAST;?></span>
                            </li>
                        </ul>
                    </div>
                    <!-- ============= End Steps =============  -->


                    <!-- ============= Ending Auctions =============  -->
                    <div id="ending-auct">
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
                            </div>
                            <!-- ============= End Live Auctions =============  -->
                        </div>
                    </div>
                    <div id="wrap-end">

                    </div>
                </div>

        <?php include("$BASE_DIR/include/$template/footer.php"); ?>
        <script type="text/javascript">
            <!--
           // swfobject.registerObject("FlashID1");
            //-->
        </script>
        <span id="usedflash" style="display:none;"></span>
    
