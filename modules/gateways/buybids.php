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
			<div id="buybidBox">
				
				<form name="payment" action="payment.php" method="post" style="width:350px;background:transparent;">
					
					  <?php
					
					foreach($gateways as $gateway){
					    if(is_dir("modules/gateways/$gateway[name]")){
					?>
					
					    <p id="<?php echo $gateway['name'];?>_select" style="height:50px;width:460px;position:relative;" class="<?php if($gateway['name'] != 'paypal'){ echo 'unselected';  }else { echo 'highlight_pbox '; } ?>">
						<input id="<?php echo $gateway['name'];?>_method" class="payment_radios" type="radio" name="paymentmethod" value="<?php echo $gateway['name'];?>" onclick="OpenDetails(this.value)" />
						<label for="<?php echo $gateway['name'];?>_method"><img style="vertical-align:middle;width:100px;height:auto;<?php if($gateway['name'] == 'paypal'){ echo 'margin-top:10px;'; } ?>" src="<?php echo $SITE_URL;?>/modules/gateways/<?php echo $gateway['name'];?>/logo.gif" /></label>
					    </p>
						<div class="clear"></div>		  
					<?php } 
					
					
					    }
					?> 
				  
				
                            </form>
                            
                             
                                                       
				
                              <?php
                              
				foreach($gateways as $gateway){
				    if(is_dir("modules/gateways/$gateway[name]") & file_exists("modules/gateways/$gateway[name]/form_front.php")){
				?>
				
					<div id="<?php echo $gateway['name']; ?>" <?php if( count($gateways) >= 2 & $gateway['name'] != 'paypal'){ ?> style="display:none;" <?php } ?> class="payment_form">
		  
					    <form action="payment.php" method="post" name="f2" id="checkoutform">
					     <div class="payment_gateway_wrapper">
		      
							    <?php
							    
							    include("modules/gateways/$gateway[name]/form_front.php");
							    ?>
						    <input type="hidden" name="paymentpage" value="<?php echo $gateway['name']; ?>"/>
						    <input type="hidden" name="payfor" value="<?php echo PAYFOR_BUYBID; ?>"/>
						    <div id="couponcode_html_1"></div>
						    <input type="hidden" name="bidpackid" value="<?php echo base64_encode($id); ?>" />
						    <input type="hidden" name="bidpacksize" value="<?php echo $obj->bid_size; ?>" />
						    
						   
							<button value="BUY BIDS" name="mygate" type="submit"><?php echo BUY_BID; ?></button>
						 
						  
						  </div>
					    </form>
				      </div>
				    <?php
			     
					  }
				
				
				    }
				    
				  ?>
			</div>
			
			
			<script>
			$('.payment_radios:first-child').prop('checked', true);
			OpenDetails($('.payment_radios:first-child').val());
			
			</script>