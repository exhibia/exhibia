 <h4><p></p><p class="middle"><?php echo FILL_YOUR_CREDIT_CARD_DETAILS; ?> :</p><p></p></h4>
  <?php
 $cc_info = db_fetch_array(db_query("select * from registration where id = '$_SESSION[userid]'"));
  $cc_array = array(VISA, MASTERCARD, DISCOVER, AMERICAN_EXPRESS);
 ?>
<p style="font-size:18px;">Confirm your credit card information :</p>
<p>
    <label class="label"><?php echo CARD_TYPE; ?>:</label>
    <select name="creditCardType" id="creditCardType" class="gothicey" style="width:260px;">
        <?php
	foreach($cc_array as $key => $value){ ?>
	<option value="<?php echo ucwords(strtolower($value));?>" <?php if($cc_info['creditCardType'] == $value){ echo 'selected'; } ?> ><?php echo ucwords(strtolower($value));?></option>
					      
	<?php } ?>
    </select>
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo FIRST_NAME_ON_CARD; ?>:</label>
    <input name="firstName" id="firstName" value="<?php echo $cc_info['firstname']; ?>" type="text" size="20" class="crdtextbox" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo LAST_NAME_ON_CARD; ?>:</label>
    <input name="lastName" id="lastName" value="<?php echo $cc_info['lastname']; ?>" type="text" size="20" class="crdtextbox" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo ENTER_ADDRESS; ?>:</label>
    <input name="address1" id="addressline1" value="<?php echo $cc_info['addressline1']; ?>" type="text" size="20" class="crdtextbox" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo ADDRESS_LINE; ?> 2:</label>
    <input name="address2" id="addressline2" value="<?php echo $cc_info['addressline2']; ?>" type="text" size="20" class="crdtextbox" />
</p>

<p>
    <label class="label"><?php echo CITY; ?>:</label>
    <input name="city" id="city" type="text" size="20" class="crdtextbox" value="<?php echo $cc_info['city']; ?>" />
    <span>*</span>
</p>
<p>
    <label class="label"><?php echo STATE; ?>:</label>
    <select name="state" id="state" class="gothicey">
					      <option value=''></option>
					      <?php
					      $states = db_query("select * from usstates order by stname asc");
					      while($row_st = db_fetch_array($states)){
					      ?>
					      <option title="<?php echo $row_st['country'];?>" value="<?php echo $row_st['stcode'];?>" <?php if($cc_info['state'] == $row_st['stname'] | $cc_info['creditCardstate'] == $row_st['stname']){ echo 'selected'; } ?>><?php echo $row_st['stname'];?></option>
					      <?php } ?>
    </select>
    <span>*</span>
</p>
<p>
    <label class="label"><?php echo COUNTRY; ?>:</label>
    <select name="country" id="country" class="gothicey"  value="<?php echo $cc_info['country']; ?>">
        <?php
        $qry = db_query("select * from countries");
	  while($row_s = db_fetch_array($qry)){
	 ?>
        <option title="<?php echo $row_s['iso'];?>" value='<?php echo $row_s['countryId'];?>' <?php if($cc_info['country'] == $row_s['countryId']){ echo "selected"; } ?>><?php echo $row_s['printable_name']; ?></option>
        <?php } ?>
    </select>
    <span>*</span>
</p>
<p>
    <label class="label"><?php echo POSTAL_CODE; ?>:</label>
    <input name="zip" id="zip" type="text" value="<?php echo $cc_info['postcode']; ?>" size="8" class="crdtextbox" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo CARD_NUMBER; ?>:</label>
    <input name="creditCardNumber" id="creditCardNumber" value="<?php echo $cc_info['creditCardNumber']; ?>" type="text" class="crdtextbox" size="20" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo CVV2_SECURITY_CODE; ?>:</label>
    <input name="cvv2Number" id="cvv2Number" type="text" class="crdtextbox" size="3" maxlength="3" style="width: 60px;" />
    <span>*</span>
</p>
<div class="clear"></div>
<p>
    <label class="label"><?php echo EXPIRY_DATE; ?>:</label>
    <span>
     <select name="expDateYear" id="expDateYear" class="gothicey"> 
    
	<?php for ($i = 2009; $i <= 2025; $i++) { ?>
            <option value="<?php echo $i; ?>" <?php if($cc_info['expDateYear'] == $i){ echo 'selected'; }?>><?php echo $i; ?></option>
        <?php
        }
        ?>
    </select>
    <select name="expDateMonth" id="expDateMonth" class="gothicey"><?php for ($i = 1; $i <= 12; $i++) { ?>
        <option value="<?php echo $i; ?>" <?php if($cc_info['expDateMonth'] == $i){ echo 'selected'; }?>><?php echo $i; ?></option>
        <?php
    }
        ?>
    </select>

   
    </span>
    <span>*</span>
</p>
<script>
      
            $('#country').change( function(){
            var iso = $('#country>option:selected').attr('title');
            
            if($('#state>option:selected').attr('title') != iso){
		  
		      $('#state>option:selected').removeAttr('selected');
		   
		   }
		    $('#state option').each(function(){
		    
		    
		   
			if($(this).attr('title') != iso){
			    $(this).css('display', 'none');
			
			}else{
			    $(this).css('display', 'block');
			
			}
            
		    });
            
            });
</script>