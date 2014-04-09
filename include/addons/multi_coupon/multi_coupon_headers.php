	<style>
	.coupon {
	border:1px dashed black;
	border-radius: 4px;
	padding:10px 10px 10px 10px;
	color:black;
	
	}
	#couponinfo {
	margin-left:-25px;
	position:relative;
	right:-150px;
	}

	</style>
	
	<script type="text/javascript">
	var code = "coupon : ''";
	function add_multi_coupon_boxes(){
		 //   alert('You may now apply multiple coupons to this  purchase');
		    
		    var index = 1;

		    $('.paymentmethod_list form').each(

			function(){
			
			   // if($(this).attr('name') != 'payment'){
			   if(!document.getElementById('couponcode_html_' + index)){
				$(this).append('<div id="couponcode_html_' + index + ' class="coupon_code_ajax"></div>');
			  
			      index++;
			    //}
			    }
			
			
			}
		    );
	  }
	  
	      $(document).ready(function(){
	        <?php if(basename($_SERVER['PHP_SELF']) == 'buybids.php'){
                 ?>
	     
                
                 var coup_codes='';
                 add_multi_coupon_boxes();
                 
                  $("#couponcode").change(function(){
                    var val=$(this).val();
                    $("#couponcode1").val(val);
                    $("#couponcode2").val(val);
                    $("#couponcode3").val(val);
                    $("#couponcode4").val(val);
                    $("#couponcode5").val(val);
                    $("#couponcode6").val(val);
                    $('#couponcode7').val(val);
                    $('#couponcode8').val(val);
                    $('#couponcode9').val(val);
                    $('#couponcode10').val(val);
                });

                $("#applycoupon").click(function(){
                    var code=$("#couponcode").val();
                    if(code.length<=0){
                        alert('<?php echo ENTER_THE_COUPON_CODE_PLEASE; ?>');
                        return;
                    }
                   });
                   
                 
                 
               
                 
                 
                  
                 
                
                    
               
	      
	    $('#applycoupon').click(function(){
                 $(".couponcode_list").each(function(){
                    
                    coup_codes += $(this).val() + ',';
                    
                    });
                    $.ajax({
                        type:"get",
                        url:"getcouponinfo.php?price=" + $('#price_for_ajax').val()<?php
                    if(db_num_rows(db_query("select * from sitesetting where name = 'multiple_coupon' and value = 1"))>= 1){
                    ?>+"&coup_codes=" + coup_codes<?php } ?> + "&couponcode=" + $('#couponcode').val() ,
                        dataType:"json",
                        cache: false,
                       
                        success:function(data){
                           
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
				  $("#couponcode_html_1").html('');
				    $("#couponcode_html_2").html('');
				    $("#couponcode_html_3").html('');
				    $("#couponcode_html_4").html('');
				    $("#couponcode_html_5").html('');
				    $("#couponcode_html_6").html('');
				    $('#couponcode_html_7').html('');
				    $('#couponcode_html_8').html('');
				    $('#couponcode_html_9').html('');
				    $('#couponcode_html_10').html('');
				    
				   var coupon_class = 'solo_coupon';
			     }else{
			     
			      var html='<p class="coupon solo" id="go_with_it"><strong><?php echo TITLE; ?>:</strong>'+data.data.title+'&nbsp;&nbsp;<strong><?php echo DISCOUNT; ?>:</strong>'+data.data.discount + data.data.operand +'&nbsp;<?php echo OFF; ?>&nbsp;&nbsp;<strong><?php echo FREE_BIDS; ?>:</strong>'+data.data.freebids;
			     
				   var coupon_class = 'couponcode_list';
			     
			     }
			    

                               
                                html += '<p style="color:blue;font-size:9px;>#' + data.data.couponid + '</p></p>';
			      
                              $("#couponinfo").append(html);
                              $("#couponinfo").show();
			      
			      $("#couponcode_html_1").append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_1['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      $("#couponcode_html_2").append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_2['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      $("#couponcode_html_3").append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_3['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      $("#couponcode_html_4").append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_4['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      $("#couponcode_html_5").append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_5['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      $("#couponcode_html_6").append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_6['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      $('#couponcode_html_7').append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_7['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      $('#couponcode_html_8').append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_8['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      $('#couponcode_html_9').append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_9['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			      $('#couponcode_html_10').append('<input class="' + coupon_class + '" type="hidden" name="couponcode[]" id="couponcode_10['+ data.data.couponid  +']" value="'+ data.data.uniqueid + '"/>');
			    
                    
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
              
                });
          
         
          
          <?php    } ?>
         
  });
        </script>
