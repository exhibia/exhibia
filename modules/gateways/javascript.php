 
	
	      
	   $(document).ready(function(){ 
		$("form").submit(function(e){
		
		
		    var formid = '#form_' + $(this).attr('title');
		    if($(formid + ' #firstname').val() == "")
		    {
			showAlertBox("<?php echo PLEASE_ENTER_YOUR_FIRST_NAME; ?>");
			$(formid + ' #firstname').focus();
			e.preventDefault();  return false;
		    }
		   	 if($(formid + ' #lastname').val() == "")
		    {
			showAlertBox("<?php echo PLEASE_ENTER_YOUR_LAST_NAME; ?>");
			$(formid + ' #lastname').focus();
			e.preventDefault();  return false;
		    }
			
		    if($(formid + ' #delivery_addressline1').val()=="")
		    {
			showAlertBox("<?php echo PLEASE_ENTER_YOUR_ADDRESS; ?>");
			$(formid + ' #delivery_addressline1').focus();
			e.preventDefault();  return false;
		    }
		    if($(formid + ' #delivery_city').val()=="")
		    {
			showAlertBox("<?php echo PLEASE_ENTER_YOUR_CITY; ?>");
			$(formid + ' #delivery_city').focus();
			e.preventDefault();  return false;
		    }
		    if($(formid + ' #delivery_postcode').val()=="")
		    {
			showAlertBox("<?php echo PLEASE_ENTER_YOUR_ZIPCODE; ?>");
			$(formid + ' #delivery_postcode').focus();
			e.preventDefault();  return false;
		    }
		    if($(formid + ' #delivery_country').val() == ''){
			showAlertBox("<?php echo PLEASE_ENTER_YOUR_COUNTRY; ?>");
			$(formid + ' #delivery_country').focus();
			e.preventDefault();  return false;
		    
		    }else{
		    
			if($(formid + ' #delivery_country').val() == 'US' & $( formid + ' #delivery_state').val() == ''){
			    showAlertBox("<?php echo PLEASE_ENTER_YOUR_STATE; ?>");
			    $(formid + ' #delivery_state').focus();
			    e.preventDefault();  return false;
			
			
			}
			else if($(formid + ' #delivery_country').val() == 'CA' & $(formid + ' #delivery_state').val() == ''){
			    showAlertBox("<?php echo PLEASE_ENTER_YOUR_STATE; ?>");
			    $(formid + ' #delivery_state').focus();
			    e.preventDefault();  return false;
			
			
			}
		    
		    }
		    if($(formid + ' #firstName').length > 0){
			  if($(formid + ' #firstName').val()=="")
			  {
			      showAlertBox("<?php echo PLEASE_ENTER_YOUR_FIRST_NAME; ?>");
			      $(formid + ' #firstName').focus();
			      e.preventDefault();  return false;
			  }
			  if($(formid + ' #c_name').val()=="")
			  {
			      showAlertBox("<?php echo PLEASE_ENTER_YOUR_CARD_NAME; ?>");
			      $(formid + ' #c_name').focus();
			      e.preventDefault();  return false;
			  }

			  if (ccCardNumber(	$(formid + ' #c_no').val()) == false) {
			      showAlertBox("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>")
			      $(formid + ' #c_no').focus();
			      e.preventDefault();  return false;
			  }

			  if ($(formid + ' #c_cvv_no').val().length < 3) {
			      showAlertBox("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
			      $(formid + ' #c_cvv_no').focus();
			      e.preventDefault();  return false;
			  }
			      
				    
				      if(ccCardNumber($(formid + ' #creditCardNumber').val())==false){
					  showAlertBox("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>");
					  $(formid + ' #creditCardNumber').focus();
					  e.preventDefault();  return false;
				      }
				      if($(formid + ' #cvv2Number').val().length<3){
					  showAlertBox('<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>');
					  $(formid + ' #cvv2Number').focus();
					  e.preventDefault();  return false;
				      }
				      e.preventDefault();  return false;
				      
				      
			      
		    }
		
                
		    });
            });
            
$('.choose_payment').click(function(event){
  prompt($(this).val());
  
});
            function ccCardNumber(cardNumber) {
                var cardTotal=0;
                var dnum=0;
                var test=0;
                if (cardNumber.length < 13) { return (false); }
                else
                {
                    for ( i = cardNumber.length; i >= 1 ;  i--)	{
                        test=test+1;
                        num = cardNumber.charAt(i-1);
                        if ((test % 2) != 0) cardTotal=cardTotal+parseInt(num)
                        else {
                            dnum=parseInt(num)*2;
                            if (dnum >= 10) cardTotal=cardTotal+1+dnum-10
                            else cardTotal=cardTotal+dnum;
                        }
                    }
                    if ((cardTotal % 10) != 0){ return (false); }else{ return(true); }
                }
            }
