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
                            <form name="payment" action="payment.php" method="post" style="float:left;width:300px;">
                                <?php
				$p = 0;
				foreach($gateways as $gateway){//Warning to developers this gateway method is specific to this template and may not be incorporated yet into other templates
				    if(is_dir("modules/gateways/$gateway[name]")){
				?>
				
				    <p id="<?php echo $gateway['name'];?>_select" class="unselected">
					<input id="<?php echo $gateway['name'];?>_method" <?php if($p==0){?> checked="checked" <?php } ?> class="choose_payment paymentmethod_list" type="radio" name="paymentmethod<?php echo $gateway['name']; ?>" value="<?php echo $gateway['name'];?>"  />
					<label for="<?php echo $gateway['name'];?>_method"><img style="vertical-align:middle;width:100px;height:auto;" src="<?php echo $SITE_URL;?>/modules/gateways/<?php echo $gateway['name'];?>/logo.gif" /></label>
				    </p>
					<div class="clear"></div>		  
		                 <?php } 
				$p++;
				
				    }
				    
				  ?>

                            </form>

			  </div>
			  <div id="position_ccc" style="float:right;">
                              <?php
                              $p=0;
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
				    $p++;

				    }
				    ?>   
			 <script>
			    $('.paymentmethod_list').click(function(){
				  $('.paymentmethod_list').parent().removeClass('highlight');
				  $('.payment_form').css('display', 'none');
				  $('.paymentmethod_list').prop('checked', false);
				  $(this).prop('checked', true);
				  $('#' + $(this).val()).css('display', 'block');
				  $(this).parent().addClass('highlight');
			    });
			</script>
		</div>