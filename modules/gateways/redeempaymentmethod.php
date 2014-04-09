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
		$payGateway = new PayGateway(null);
		$gateways = $payGateway->get_em_all(1);
?>
	      <h4><?php echo CHOOSE_PAYMENT_METHOD; ?>:</h4>
                            <form name="payment" action="payment.php" method="post">
                                <?php
				
				foreach($gateways as $gateway){//Warning to developers this gateway method is specific to this template and may not be incorporated yet into other templates
				    if(is_dir("modules/gateways/$gateway[name]")){
				?>
				
				    <p id="<?php echo $gateway['name'];?>_select" class="unselected">
					<input id="<?php echo $gateway['name'];?>_method" checked="checked" type="radio" name="paymentmethod" value="<?php echo $gateway['name'];?>" onclick="OpenDetails(this.value)" />
					<label for="<?php echo $gateway['name'];?>_method"><img style="vertical-align:middle;width:100px;height:auto;" src="<?php echo $SITE_URL;?>/modules/gateways/<?php echo $gateway['name'];?>/logo.gif" /></label>
				    </p>
							  
		                 <?php } 
				
				
				    }
				    
				  ?>

                                <input type="hidden" name="paymentpage" value="paypal"/>
                                <input type="hidden" name="payfor" value="<?php echo PAYFOR_WONAUCTION; ?>"/>
                                <input type="hidden" name="winid" value="<?= $_REQUEST["winid"]; ?>" />
                                <input type="hidden" name="voucher" value="<?= $_REQUEST["voucher"]; ?>" />
                                <input type="hidden" name="novoucher" value="<?= $_REQUEST["novoucher"]; ?>" />
                            </form>


                              <?php
				foreach($gateways as $gateway){
				    if(is_dir($BASE_DIR . "/modules/gateways/$gateway[name]") & file_exists($BASE_DIR . "/modules/gateways/$gateway[name]/form_front.php")){
				?>
				
					<div id="<?php echo $gateway['name']; ?>" <?php if( count($gateways) >= 2){ ?> style="display:none;" <?php } ?> class="payment_form">
		  
					<form action="payment.php" method="post" name="form_<?php echo $p;?>" title="<?php echo $p;?>" id="form_<?php echo $p;?>" >
                                              
                                                
                                                 
                                               
						<?php
						include($BASE_DIR . "/modules/gateways/address_form.php");
						include($BASE_DIR . "/modules/gateways/$gateway[name]/form_front.php");

						?>
						<input type="hidden" name="paymentmethod" value="<?php echo $gateway['name'];?>"/>
						<label class="label">&nbsp;&nbsp;</label>
						<input type="hidden" name="payfor" value="<?php echo PAYFOR_WONAUCTION; ?>"/>
						<input type="hidden" name="winid" value="<?php echo $_REQUEST["winid"]; ?>" />
						<input type="hidden" name="voucher" value="<?php echo $_REQUEST["voucher"]; ?>" />
						<input type="hidden" name="novoucher" value="<?php echo $_REQUEST["novoucher"]; ?>" />
						<input value="<?php echo PAY_NOW; ?>" class="bid-button-link" title="<?php echo $p;?>" name="<?php echo $gateway['name']; ?>" type="image" src="img/buttons/btn_buitnow.png" />
					  </form>
					</div>
				    <?php } 


				    }
				    ?>   
