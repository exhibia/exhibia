<?php
include_once("../config/connect.php");
include_once("../functions/functions.php");

include_once '../common/dbmysql.php';
include_once '../data/paygateway.php';

include_once '../common/constvariable.php';

$payGateway = new PayGateway(null);




$gateways = $payGateway->get_em_all(1);
  
  
header("content-type: text/javascript");
$_SESSION['id'] = md5($_SERVER['REMOTE_ADDR']);
?>

	    function prompt_user_action(productID){
	    
		$.get('content.php?module=cart&action=edit_in_cart&prid=' + productID, function(result){
		    $('#dialog').html('<div id="prompt_scroll">' + result + '</div>');
		    $('#dialog').dialog({title:'<span style="color:#fff;">Edit Entry</span>', width:400, height:450, modal:true,
		    
		    show: function(){ 
		    
		    
				  $("#prompt_scroll").mCustomScrollbar({
            
				      scrollButtons:{
						enable:true
					}
				});
			    
			    }
		    
		    
		    });
			
		    
		    });
		    
		
	    }
	    function details(productID){
	    
		$('#dialog').html( document.getElementById('product_tooltip_' + productID ).innerHTML);
		 $('#dialog').dialog({modal:true, width:400, height:450, title: 'Product Details' });
	    
	    }
                
function show_links(productID){

    $('#add_links_' + productID).css('display', 'block');



}
function hide_links(productID){

    $('#add_links_' + productID).css('display', 'none');



}



function zipcode(product_id){
    
    
	
	
	
		$.getJSON('content.php?module=cart&action=tax_and_ship&prid=' + product_id + '&zipcode='+ $('#zipcode').val(), function(data){
		
		    $('.shipping').html(data.shipping);
		  
		  
		  //$('.taxes').html(data.tax);
		
		    $('.taxes-price').html('<?php  echo $Currency;?>' + data.tax);
		 //   $('.shipping_method').html(data.shipping_method);
		    $('.total-price').html('<?php  echo $Currency;?>' + data.price);
		});
	     
	
    
}


    function _delete_login_fields(_field, _default, _current) { try{if (_default == _current) { _field.value=''; }}catch(p){} }
 

    function onBeforeUnloadAction() {
        $.ajax({
            type: "GET",
            url: "<?php echo $SITE_URL;?>updatelogin.php",
            success: function(responseData){
            }
        });

    }

 function checkout_now(){
 
    $('#cartBox').css('display', 'none');
    $.get('content.php?module=cart&action=checkout', function(result){
    
	$('#column-middle').html(result);
    
    });
 
}

    function search_store(){
//    prompt(document.getElementById('search').value);
    window.location.href = '<?php echo $SITE_URL;?>?search='+document.getElementById('search').value;
    
    
    }
  
    window.onbeforeunload = function(f) {
        if (!f) f = window.event;
        if (typeof f.pageX == "number") { X = f.pageX; Y = f.pageY; } else { X = f.clientX; Y = f.clientY; };
        if((X<0) || (Y<0)) { return onBeforeUnloadAction(); }
    }

    function UpdateLoginLogout() {
        $.ajax({
            type: "GET",
	      url: "<?php echo $SITE_URL;?>updatelogin.php",
            success: function(responseData){
            }
        });
    }
    
    function show_details_box(id){
    	   
	    
	    
	if(id == 'shipping-box'){
	
	    $.get('shippingdata.php?id=' + $('#product_id').val(), function(response){
	    
		$('#shipping-box').html(response);
		
		  $('#' + id + '-box').mCustomScrollbar({
            
			  scrollButtons:{
						enable:true
					}
		  });
	    });
	
	}else if(id == 'ratings-box'){
	
	    $.get('ratings.php?id=' + $('#product_id').val(), function(response){
	    
		$('#ratings-box').html(response);
		
		  $('#' + id + '-box').mCustomScrollbar({
            
			scrollButtons:{
						enable:true
					}
		    });
	    });	
	
	}
	
	$('.product-top-button').css('background-color', 'blue');
	    $('.product-top-button').css('color', 'white');
	
	 
	    $('.top-info-area').css('display', 'none');
	    $('#' + id + '-box').css('display', 'block');
	    
	    $('#' + id + '-box').show();
	    
	    
	
	
	$('#' + id + '-button').css('background-color', 'white');
	$('#' + id + '-button').css('color', 'blue');
	 

    }
    
    function PAS_parseScript(_source) {
		var source = _source;
		var scripts = new Array();
		
		while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
			var s = source.indexOf("<script");
			var s_e = source.indexOf(">", s);
			var e = source.indexOf("</script", s);
			var e_e = source.indexOf(">", e);
			
			// Add to scripts array
			scripts.push(source.substring(s_e+1, e));
			// Strip from source
			source = source.substring(0, s) + source.substring(e_e+1);
		}
		
		// Loop through every script collected and eval it
		for(var i=0; i<scripts.length; i++) {
			try {
				eval(scripts[i]);
			}catch(ex) {}
				
		      }
		
		
		// Return the cleaned source
		return source;

    }
    function make_payment(formID){
    
	var data = $('#'+formID).serialize();
	
	ajax_PAS('payment.php?' + data, 'post', 'column-middle');
    
    
    
    }
    function ajax_PAS(url, method, id){
	if(method  == 'get'){
	$('#' + id).css('display', 'block');
	      $.get(url  + '&ajax=true', function(data){
	      
		// PAS_parseScript(data);
		  $('#' + id).html(data);
		 
			      if(id == 'cart'){
			      $("#cart_ul").mCustomScrollbar({
			    
			    scrollButtons:{
								enable:true
							}
			    });
	      
	   
			}
	      
	      });
	      
	      
	}else{
	
	      $.post(url, function(data){
	      
	      
		   document.getElementById(id).innerHTML = data;
		
	      
	      });	
	
	
	}
    
    
    }
        function create_moodal(data){
   
   
	    $('#dialog').html(data);
		    $( "#dialog" ).dialog({
		    modal: true,
		    autoOpen: true
		    
		   });
   
	    $('#dialog').dialog('open');
   
   
   }
   
   
    function add_to_wishlist(product_id){

    var product_data = '';
      if($('#qty').val()){
	 product_data += '&qty=' + $('#qty').val();
      
      }else{
      
	  product_data += '&qty=1';
      
      }
      
      if($('#product_form')){
      
	product_data += $('#product_form').serialize();
      }
       
	$.getJSON('content.php?module=cart&folder=wishlist&action=add_to_cart&pid=' + product_id + product_data, function(data){
	
	      if(data.added == 'true'){
	
		ajax_PAS('content.php?module=cart', 'get', 'cart');
		  create_moodal(data.html);
		}else{
	    
		    create_moodal(data.html);
		    
		    

		
		}
	    
	});
	
    }  
   function add_to_cart_and_checkout(product_id){
   
      add_to_cart(product_id);
      checkout_now();
   
   }
   function add_to_cart(product_id){

    var product_data = '';
      if($('#qty').val()){
	 product_data += '&qty=' + $('#qty').val();
      
      }else{
      
	  product_data += '&qty=1';
      
      }
      
      if($('#product_form')){
      
	product_data += $('#product_form').serialize();
      }
       
	$.getJSON('content.php?module=cart&action=add_to_cart&pid=' + product_id + product_data, function(data){
	
	      if(data.added == 'true'){
	
		ajax_PAS('content.php?module=cart', 'get', 'cart');
		create_moodal(data.html);
	      
		}else{
	    
		    create_moodal(data.html);
		    
		    

		
		}
	    
	});
	
    }
    
    ajax_PAS('content.php?module=cart', 'get', 'cart');
    <?php if(empty($_SESSION['zipcode'])){ ?>
       jQuery(window).ready(function(){
        
	  
            initiate_geolocation();
        });
        
          <?php } ?>
     function initiate_geolocation() {
        if (navigator.geolocation)
        {

    
            navigator.geolocation.getCurrentPosition(handle_geolocation_query, handle_errors);
        }
        else
        {
            yqlgeo.get('visitor', normalize_yql_response);
        }
    }
    function handle_errors(error)
    {
        switch(error.code)
        {
            case error.PERMISSION_DENIED: 
            //alert("user did not share geolocation data");
            break;
            case error.POSITION_UNAVAILABLE: 
           // alert("could not detect current position");
            break;
            case error.TIMEOUT: alert("retrieving position timedout");
            break;
            default: alert("unknown error");
            break;
        }
    }
    function normalize_yql_response(response)
    {
        if (response.error)
        {
            var error = { code : 0 };
            handle_error(error);
            return;
        }
        var position = {
            coords :
            {
                latitude: response.place.centroid.latitude,
                longitude: response.place.centroid.longitude
            },
            address :
            {
                city: response.place.locality2.content,
                region: response.place.admin1.content,
                country: response.place.country.content
            }
        };
        handle_geolocation_query(position);
    }
    
    
        function handle_geolocation_query(position){
	    $.get('session.php?lat=' + position.coords.latitude + '&lon=' + position.coords.longitude, function(data){
	    
	    
	    });
            $.getJSON('geolocate.php?lat=' + position.coords.latitude + '&lon=' + position.coords.longitude, function(data){
		
		$('.zipcode').val(data.zipcode);
		
		/*\$('.shipping-price').html(data.shipping);
		$('.taxes').html(data.taxes);
		$('.shipping_method').html(data.shipping_method);*/
            
            });
                
        }
        
        
        function login(container, form){
    	    $('#dialog').html('One Moment Please!');
	    $('#dialog').dialog();    
        
            $.post('content.php?module=login&' + $('#' + form).serialize(), function(data){
            
            PAS_parseScript(data);
		$('#' + container).html(data);
		
		$('#dialog').close();
            
	      }); 
            }
        
         function register(){
	    $('#dialog').html('One Moment Please!');
	    $('#dialog').dialog();
            $.post('content.php?module=register&',  $('#registration-form').serialize(), function(data){
		$('#column-middle').html(data);
		$('#dialog').close();
            })         
        
        
        }
        
          function register2(){
        
	    $('#dialog').html('One Moment Please!');
	    $('#dialog').dialog();
            $.post('content.php?module=register2&',  $('#registration-form').serialize(), function(data){
		$('#column-middle').html(data);
		$('#dialog').close();
            
            });          
        
        
        }       
        

         
           
           

            function check()
            {
                if(document.f2.c_name.value=="" & document.getElementById('creditCardNumber'))
                {
                    alert("<?php echo PLEASE_ENTER_YOUR_CARD_NAME; ?>");
                    document.f2.c_name.focus();
                    return false;
                }

                if (ccCardNumber(document.f2.c_no.value) == false & document.getElementById('creditCardNumber')) {
                    alert("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>")
                    document.f2.c_no.focus();
                    return false;
                }

                if (document.f2.c_cvv_no.value.length < 3 & document.getElementById('creditCardNumber')) {
                    alert("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
                    document.f2.c_cvv_no.focus();
                    return false;
                }
            }

            function ccCardNumber(cardNumber) {
                var cardTotal=0;
                var dnum=0;
                var test=0;
                if (cardNumber.length < 13 & document.getElementById('creditCardNumber')) { return (false); }
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

            $(document).ready(function(){

                $("#checkoutform").submit(function(){

                    if(ccCardNumber($("#creditCardNumber").val())==false & document.getElementById('creditCardNumber')){
                        alert("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>");
                        $("#creditCardNumber").focus();
                        return false;
                    }
                    if($("#cvv2Number").val().length<3 & document.getElementById('cvv2Number')){
                        alert("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
                        $("#cvv2Number").focus();
                        return false;
                    }
                    return true;
                    
                    
               
                });
              });  
              
              
              function remove_from_cart(row, divId){
              
		    $.get('content.php?module=cart&action=delete&delete=' + row, function(result){
		    
		    
			  $('#' + divId).html(result);
			      if(divId == 'cart'){
              
              
				$('#cart_ul').mCustomScrollbar({
            
				      scrollButtons:{
						enable:true
					}
				  });
              
              
			  }
			  
		});
            
              
              
              
              }
              
              function select_all_items(classId, initiator){
              
		if($(initiator).attr('checked') ){
		      $(classId).attr('checked', true);
		  }else{
		  
		      $(classId).attr('checked', false);
		  }
              
              
              }
              
              function remove_selected(productID, divId){
              
              
              
              
              
              }
              
              function update_quantities(productId, divId){
              
		  
              
              }
              function ucfirst (str) {
		// http://kevin.vanzonneveld.net
		// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
		// +   bugfixed by: Onno Marsman
		// +   improved by: Brett Zamir (http://brett-zamir.me)
		// *     example 1: ucfirst('kevin van zonneveld');
		// *     returns 1: 'Kevin van zonneveld'
		str += '';
		var f = str.charAt(0).toUpperCase();
		return f + str.substr(1);
	      }

              function change_quantity(productID){
              
		  if(!isNaN(document.getElementById('quantity[' + productID + ']').value) & document.getElementById('quantity[' + productID + ']').value != ''){
		  
		      
		 	$.getJSON('content.php?module=cart&action=update_quantities&prid=' + productID + '&qty=' + document.getElementById('quantity[' + productID + ']').value , function(result){
		 	
			      if(parseInt(result.quantity) <= 0){
			      
				  document.getElementById('cart_item[' + productID + ']').style.display = 'none';
			      
			      }else{
			     
				  $.each(result.amounts, function(i, item){
				  
				     var value = item
				     var element = i;
				  
				     
				      
					$('#values_' + productID + '_' + i).html(ucfirst(i) + ": " + item);
					
				  
				  });
				   
			      
			      }
			      $('#dialog').html(result.message);
			      $('#dialog').dialog();
			      
			   
		 	
		 	});
		  
		  
		  }
               $.get('content.php?module=cart&action=total', function(response){
			    
				$('#cart_total_end').html(response);
			    
			    
			    });
              
              
              }
              
            function delete_product(productID){
            
            
		 	$.getJSON('content.php?module=cart&action=update_quantities&prid=' + productID + '&qty=0' , function(result){
		 	
			      if(parseInt(result.quantity) <= 0){
			      
				  document.getElementById('cart_item[' + productID + ']').style.display = 'none';
			      
			      }
			      $('#dialog').html(result.message);
			      $('#dialog').dialog();
		 	
		 	});
		 $.get('content.php?module=cart&action=total', function(response){
			    
				$('#cart_total_end').html(response);
			    
			    
			    });
            
            }
            function ShowMainTitle(div_id)
            {
                var obj1 = document.getElementById('GetGlobalID');
                //var obj = document.getElementById('');
                if(obj1.innerHTML=="")
                {
                    obj1.innerHTML=div_id;
                    var obj = document.getElementById('subtitle_'+div_id);
                    if(navigator.appName!="Microsoft Internet Explorer")
                    {
                        obj.style.display = 'block';
                    }
                    else
                    {
                        obj.style.display = 'block';
                    }
                }
                else
                {
                    var obj2 = document.getElementById('subtitle_'+obj1.innerHTML);
                    obj2.style.display = 'none';
                    obj1.innerHTML=div_id;
                    var obj3 = document.getElementById('subtitle_'+div_id);
                    if(navigator.appName!="Microsoft Internet Explorer")
                    {
                        obj3.style.display = 'block';
                    }
                    else
                    {
                        obj3.style.display = 'block';
                    }
                }
            }
            function ShowAnsTitle(ans_id)
            {
                var obj4 = document.getElementById('GetGlobalAnsID');
                //var obj = document.getElementById('');
                if(obj4.innerHTML=="")
                {
                    obj4.innerHTML=ans_id;
                    var obj5 = document.getElementById('answer_'+ans_id);
                    if(navigator.appName!="Microsoft Internet Explorer")
                    {
                        obj5.style.display = 'block';
                    }
                    else
                    {
                        obj5.style.display = 'block';
                    }
                }
                else
                {
                    var obj6 = document.getElementById('answer_'+obj4.innerHTML);
                    obj6.style.display = 'none';
                    obj4.innerHTML=ans_id;
                    var obj7 = document.getElementById('answer_'+ans_id);
                    if(navigator.appName!="Microsoft Internet Explorer")
                    {
                        obj7.style.display = 'block';
                    }
                    else
                    {
                        obj7.style.display = 'block';
                    }
                }
            }
            
            
            
            function applycoupon(){
            
               
                  $("#couponcode").change(function(){
                    var val=$(this).val();
                    
                    
                    <?php 
                    $g = 1;
                    foreach($gateways as $gateway){
		      ?>
			$("#couponcode<?php echo $g;?>").val(val);
		      <?php
			$g++;
                    }
                    ?>
                });
                   var code=$("#couponcode").val();
                    if(code.length<=0){
                        alert('<?php echo ENTER_THE_COUPON_CODE_PLEASE; ?>');
                        return;
                    }
                    
                    var coup_codes='';
                    
                    $(".couponcode_list").each(function(){
                    
                    coup_codes += $(this).val() + ',';
                    
                    });
             
                    
                    $.ajax({
                        type:"get",
                        url:"content.php?module=coupon&price=" + $('#price_for_ajax').val()<?php
                    if(db_num_rows(db_query("select * from sitesetting where name = 'multiple_coupon' and value = 1"))>= 1){
                    ?>+"&coup_codes=" + coup_codes<?php } ?>,
                        dataType:"json",
                        cache: false,
                        data:{couponcode:code},
                        success:function(data){
                           
                      
                      if(!isNaN(data.data.discount)){

                         
                         savings_percent = parseFloat(data.data.discount).toFixed(2) / 100;
                         
                         
			    if($('#cart_discount').html() === ''){
			      cur_total = $('#cart_total_end').html();
			      cart_total_end = cur_total - (cur_total * savings_percent);
			      $('#cart_total_end').html(cart_total_end);
                        
				    $('.p_sub_total').each( function(){
				    
					cur_p_total = $(this).html();
					new_p_total = cur_p_total - (cur_p_total * savings_percent);
					$(this).html(parseFloat(new_p_total).toFixed(2));
				    
				    });
                        
                        
                        
			    }
                                     $('#cart_discount').html(savings_percent);
                                     
				      $('.cartSavings.info').html(savings_percent + '%');
				      $('.cartSavings.info').css('color', 'red');           
                       
                       }
                      <?php      
                            if(db_num_rows(db_query("select * from sitesetting where name = 'multiple_coupon' and value = 1"))>= 1){
                       ?>
                        if(data.msg=='ok'){
			    $('.error').remove();
			    $('.solo_coupon').remove();
			  
			  
			  var html='<span class="solo_coupon"><p class="coupon" id="go_with_it"><strong><?php echo TITLE; ?>:</strong>'+data.data.title+'&nbsp;&nbsp;<strong><?php echo DISCOUNT; ?>:</strong>'+data.data.discount + data.data.operand +'&nbsp;<?php echo OFF; ?>&nbsp;&nbsp;<strong><?php echo FREE_BIDS; ?>:</strong>'+data.data.freebids + '</span>';
			  
			  
			  if(data.data.combinable != 'true' && data.data.combinable != 'yes'){
			   
                                
			      html += '<p class="error" style="color:red">This Coupon May Not Be Combined With Any Other Offers!</p>';
			      $("#couponinfo").html('');
			      
			      
			        <?php 
				$g = 1;
				foreach($gateways as $gateway){
				  ?>
				    $("#couponcode_html_<?php echo $g;?>").append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_1['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      
				  <?php
				    $g++;
				}
				?>
				  
				    
				   var coupon_class = 'solo_coupon';
			     }else{
			     
			      var html='<p class="coupon solo" id="go_with_it"><strong><?php echo TITLE; ?>:</strong>'+data.data.title+'&nbsp;&nbsp;<strong><?php echo DISCOUNT; ?>:</strong>'+data.data.discount + data.data.operand +'&nbsp;<?php echo OFF; ?>&nbsp;&nbsp;<strong><?php echo FREE_BIDS; ?>:</strong>'+data.data.freebids;
			     
				   var coupon_class = 'couponcode_list';
			     
			     }
			    

                               
                                html += '<p style="color:blue;font-size:9px;>#' + data.data.couponid + '</p></p>';
			      
                              $("#couponinfo").append(html);
                              $("#couponinfo").show();
			        <?php 
				    $g = 1;
				    foreach($gateways as $gateway){
				      ?>
					$("#couponcode_html_<?php echo $g;?>").append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_1['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
				      <?php
					$g++;
				    }
				    ?>
			 
			    
                    
                           }else{
                           $('.error').remove();
                           if(document.getElementById('go_with_it')){
                                $("#couponinfo").append('<span class="error">'+data.msg+'</span><br />');
                                
                                }else{
                                
                                 $("#couponinfo").html('<span class="error">'+data.msg+'</span><br />');
                                
                                }
                                $("#couponinfo").show();
                            }
                            
                     <?php }else{
                     
                     ?>
                     
                             if(data.msg=='ok'){
                             
                             
                                var html='<p class="coupon"><strong><?php echo TITLE; ?>:</strong>'+data.data.title+'&nbsp;&nbsp;<strong><?php echo DISCOUNT; ?>:</strong>'+data.data.discount+'%&nbsp;<?php echo OFF; ?>&nbsp;&nbsp;<strong><?php echo FREE_BIDS; ?>:</strong>'+data.data.freebids + '</p>';

                                $("#couponinfo").html(html);
                                $("#couponinfo").show();
                             
                             
                             
                             }else{
                                $("#couponinfo").html('<span class="error">'+data.msg+'</span>');
                                $("#couponinfo").show();
                            }
                     
                     
                     
			<?php    } ?>
			 
                        }
                    
                        

                    });
                    
                    
                  }
                  
                  
                  
function changeimage(id) {
    var idnew = 1;
    for (idnew=1; idnew<=4; idnew++) {
        if ( idnew==id ) {
            document.getElementById('mainimage'+idnew).style.display='block';
        } else {
            document.getElementById('mainimage'+idnew).style.display='none';
        }
    }
}

function hidedisplayzoom(div_id) {
    document.getElementById(div_id).style.display = 'block';
    if ( document.getElementById('zoomimagename').innerHTML!="" && document.getElementById('zoomimagename').innerHTML!=div_id ) {
        document.getElementById(document.getElementById('zoomimagename').innerHTML).style.display	= 'none';
    }
    document.getElementById('zoomimagename').innerHTML = div_id;
}

function closezoomimage(div_id) {
    document.getElementById(div_id).style.display='none';
}



$(document).ready( function(){


		    
		    
});