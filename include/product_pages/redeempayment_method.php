        <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><em><?= $SITE_NM; ?> - <?php echo REDEMPTION_PAYMENT; ?></em>

                        </p>
                    </div><!-- /title-category-content -->


                    <div id="buyproduct-box" class="content">
                        <div class="productinfo1">
                            <h5><?php echo REDEMPTION_DETAILS; ?>:</h5>
                            <p>
                                <strong><?= stripslashes($objsel["name"]); ?>:&nbsp;</strong><?= $objsel["redem_points"]; ?>&nbsp;<?php echo POINTS; ?><br/>

                                <strong><?php echo SHIPPING_CHARGE; ?>:&nbsp;</strong><?= $Currency . $objsel["shippingcharge"]; ?>
                            </p>

                            <?php if ($objsel["shippingcharge"] <= 0) {
                            ?>
                                <p>
                                    <strong><?php echo AFTER_CLICKING_ON_CONFIRM_BUTTON_POINTS_WILL_BE_AUTOMATICALLY_DEBITED_FROM_YOUR_ACCOUNT; ?></strong>
                                </p>
                                <p>
                                    <form name="payment" action="payment.php" method="post">
<!--                                        <button style="cursor: pointer" class="buttonmake" onclick="window.location.href='<?php echo $SITE_URL; ?>payment.php?redemid=<?= $_GET["pu"]; ?>&payfor=<?php echo PAYFOR_REDEMPTION; ?>'"><?php echo SUBMIT; ?></button>-->
                                        <input type="hidden" name="payfor" value="<?php echo PAYFOR_REDEMPTION; ?>"/>
                                        <input type="hidden" name="redemid" value="<?php echo $_GET["pu"]; ?>" />
                                        <button style="cursor: pointer" class="buttonmake" type="submit"><?php echo SUBMIT; ?></button>
                                    </form>
                                </p>
                            <?php } ?>

                        </div>

                        <div class="clear"></div>

                        <div id="buybidBox">

                            <h4><?php echo CHOOSE_PAYMENT_METHOD; ?>:</h4>
                            <form name="payment" action="payment.php" method="post">
			      <?php
				$p = 1;
				foreach($gateways as $gateway){
				    if(is_dir("modules/gateways/$gateway[name]")){
				?>
				
				    <p id="<?php echo $gateway['name'];?>_select" class="unselected">
					<input id="<?php echo $gateway['name'];?>_method" type="radio" name="paymentmethod" value="<?php echo $gateway['name'];?>" onclick="OpenDetails(this.value)" />
					<label for="<?php echo $gateway['name'];?>_method"><img style="vertical-align:middle;width:100px;height:auto;" src="<?php echo $SITE_URL;?>/modules/gateways/<?php echo $gateway['name'];?>/logo.gif" /></label>
				    </p>
							  
		                 <?php } 
				
				?>
				
				  <?php
				  
				  $p++;
				    }
				    
				  ?>
                                <input type="hidden" name="paymentpage" value="paypal"/>
                                <input type="hidden" name="payfor" value="<?php echo PAYFOR_REDEMPTION; ?>"/>
                                <input type="hidden" name="redemid" value="<?php echo $_GET["pu"]; ?>" />
                            </form>

                                    <div id="creditdetail" style="display:none;" class="creditform">
                                       
                            <?php
                          $p = 1;
				foreach($gateways as $gateway){
				    if(is_dir("modules/gateways/$gateway[name]")){
				?>
				      <div id="<?php echo $gateway['name']; ?>" <?php if( count($gateways) >= 2){ ?> style="display:none;" <?php } ?> class="payment_form">
                                             <form action="payment.php" method="post" name="form_<?php echo $p;?>" title="<?php echo $p;?>" id="form_<?php echo $p;?>" >
                                              
                                                
                                                 
                                               
					      <?php
					      include("modules/gateways/address_form.php");
					    
					      include("modules/gateways/$gateway[name]/form_front.php");
					      
					      ?>
					    
					       <div id="couponcode_html_<?php echo $p;?>"></div>
                          
                                        <h4><?php echo PAYMENT_CCAVENUE; ?>:</h4>
                                        <p style="text-align:center;">
                                            <form method="POST" action="payment.php" style="text-align:center;padding:10px;">
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <input type="hidden" name="paymentpage" value="ccavenue"/>
                                                <input type="hidden" name="payfor" value="<?php echo PAYFOR_REDEMPTION; ?>"/>
                                                <input type="hidden" name="redemid" value="<?php echo $_GET["pu"]; ?>" />

                                                <p align="center">
                                                    <button value="BUY BIDS" name="paymentasia" type="submit"><?php echo MAKE_PAYMENT; ?></button>
                                                </p>
                                            </form>
                                        </p>
                                <?php } 
                                
                                }
                                ?>
                                </div>


                            </div>
                        </div>

                    </div><!-- /column-right -->
                    <div id="column-left">
                    <?php include("leftside.php"); ?>
                   


                            </div> <!--end container-->

            <?php include("footer.php"); ?>
        </div> <!--end main--> 
