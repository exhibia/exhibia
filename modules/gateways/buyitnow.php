<?php
if(!empty($_GET['errors'])){
?>
<div id="payment_errors">
<?php echo $_GET['errors']; ?>


</div>
<script>
$('#payment_errors').dialog();
</script>
<?php
}
?>
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
                                 
                             </form>

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
                                                     <input type="hidden" name="paymentpage" value="<?php echo $gateway['name']; ?>"/>
                                                     <input type="hidden" name="payfor" value="<?php echo PAYFOR_BUYITNOW; ?>"/>
                                                     <input type="hidden" name="auctionId" value="<?= base64_encode($id); ?>" />
                                                     <input value="<?php echo BUY_PRODUCT; ?>" class="bid-button-link" title="<?php echo $p;?>" name="<?php echo $gateway['name']; ?>" type="image" src="img/buttons/btn_buitnow.png" />
                                                 
					      </form>
                                </div>
                            
			      <?php
					}
					
					$p++;
				
				}
				?>
                                     
