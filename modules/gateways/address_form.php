
 <?php
 $shipping_d = db_fetch_object(db_query("select * from registration where id = '$_SESSION[userid]'"));
 ?>
 
  <p style="font-size:18px;">Confirm your shipping address :</p>
 
 <p>
    <label class="label"><?php echo FIRST_NAME; ?>:</label>
    <input name="firstname" id="firstname" type="text" size="20" class="crdtextbox" value="<?php echo $shipping_d->firstname; ?>" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo LAST_NAME; ?>:</label>
    <input name="lastname" id="lastname" type="text" size="20" class="crdtextbox" value="<?php echo $shipping_d->lastname; ?>" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo ENTER_ADDRESS; ?>:</label>
    <input name="delivery_addressline1" id="delivery_addressline1" type="text" size="20" class="crdtextbox" value="<?php if(empty($shipping_d->delivery_addressline1)){ echo $shipping_d->addressline1; }else{ echo $shipping_d->delivery_addressline1; }; ?>" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo ADDRESS_LINE; ?> 2:</label>
    <input name="delivery_addressline2" id="delivery_addressline2" type="text" size="20" class="crdtextbox" value="<?php if(empty($shipping_d->delivery_addressline2)){ echo $shipping_d->addressline2; }else{ echo $shipping_d->delivery_addressline2; } ?>" />
</p>

<p>
    <label class="label"><?php echo CITY; ?>:</label>
    <input name="delivery_city" id="delivery_city" type="text" size="20" class="crdtextbox" value="<?php if(empty($shipping_d->delivery_city)){ echo $shipping_d->city; }else{ echo $shipping_d->delivery_city; } ?>" />
    <span>*</span>
</p>
<p>
    <label class="label"><?php echo STATE; ?>:</label>
    <select name="delivery_state" id="delivery_state" class="gothicey">
					      <option value=''></option>
					      <?php
					      $states = db_query("select * from usstates order by stname asc");
					      while($row_st = db_fetch_array($states)){
					      ?>
					      <option title="<?php echo $row_st['country'];?>" value="<?php echo $row_st['stcode'];?>" <?php 
						if(!empty($shipping_d->delivery_state)){
						  if($shipping_d->delivery_state == $row_st['stcode'] | $shipping_d->delivery_state == $row_st['stname']){ echo 'selected'; }
						  }else{
						   if($shipping_d->state == $row_st['stcode'] | $shipping_d->state == $row_st['stname']){ echo 'selected'; }
						  
						  }
						  ?>><?php echo $row_st['stname'];?></option>
					      <?php } ?>
    </select>
    <span>*</span>
</p>
<p>
    <label class="label"><?php echo COUNTRY; ?>:</label>
    <select name="delivery_country" id="delivery_country" class="gothicey">
        <?php
        $qry = db_query("select * from countries");
	  while($row_s = db_fetch_array($qry)){
	 ?>
        <option title="<?php echo $row_s['iso'];?>" value='<?php echo $row_s['iso'];?>' <?php 
						if(!empty($shipping_d->delivery_country)){
						  if($shipping_d->delivery_country == $row_s['iso'] | $shipping_d->delivery_country == $row_st['printable_name'] | $shipping_d->delivery_country == $row_st['countryId']){ echo 'selected'; }
						  }else{
						   if($shipping_d->country == $row_st['iso'] | $shipping_d->country == $row_st['printable_name'] | $shipping_d->country == $row_st['countryId']){ echo 'selected'; }
						  
						  }
						  ?>><?php echo $row_s['printable_name']; ?></option>
        <?php } ?>
    </select>
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo POSTAL_CODE; ?>:</label>
    <input name="delivery_postcode" id="delivery_postcode" type="text" size="8" class="crdtextbox" value="<?php if(empty($shipping_d->delivery_postcode)){ echo $shipping_d->postcode; }else{ echo $shipping_d->delivery_postcode; } ?>" />
    <span>*</span>
</p>
 
<script>

	 
	  
          $('#delivery_country').change(function(){
           var iso = $('#delivery_country>option:selected').attr('title');
            
            if($('#dalivery_state>option:selected').attr('title') != iso){
		  
		      $('#delivery_state>option:selected').removeAttr('selected');
		   
		   }
		    $('#delivery_state option').each(function(){
		    
			if($(this).attr('title') != $('#delivery_country').val()){
			    $(this).css('display', 'none');
			
			}else{
			    $(this).css('display', 'block');
			
			}
            
		    });
            
            });
</script>