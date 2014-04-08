<?php
//5.4 versions of php seem to report strict warnings even when disabled the below supresses them
//error_reporting(0);
ini_set('error_reporting', 1);
include("config/connect.php");
include("session.php");
include("functions.php");
include_once 'data/auction.php';
include_once 'data/registration.php';
include_once 'data/paygateway.php';

include_once 'common/seosupport.php';
include_once 'common/constvariable.php';
include_once 'data/paymenthelper.php';


$uid = $_SESSION["userid"];

if ($_POST["paymentmethod"] != "") {
    $paymentmethod = $_POST["paymentmethod"];
    if ($paymentmethod == "paypal") {
        header("location: buybidspayment.php?bpid=" . $_POST["auctionId"]);
        exit;
    } elseif ($paymentmethod == "creditcard") {
        header("location: checkout.php?bpid=" . $_POST["auctionId"]);
        exit;
    }
}

if ($_GET["auctionId"] == "") {
    header("location:index.php");
    exit;
}
$payGateway = new PayGateway(null);
$gateways = $payGateway->get_em_all(1);

$payment = new PaymentHelper();
?>
<?php
if(empty($dont_show_left)){
$dont_show_left = array();
}
//Uncomment items below to remove them from ALL PAGES for ALL TEMPLATES SO LONG AS THEY ARE 100% USING THE NORMAL FRAMEWORK...IF NOT THEN LETS FIX THAT FIRST
//Skinny column
//$dont_show_left[] = 'testimonials';
//$dont_show_left[] = 'last_winner';
//$dont_show_left[] = 'right_social';
//$dont_show_left[] = 'coupon_menu';
//$dont_show_left[] = 'bidpack_menu';
//$dont_show_left[] = 'user_menu';
//$dont_show_left[] = 'help_menu';
//$dont_show_left[] = 'faq_menu';
//$dont_show_left[] = 'top_menu';
//$dont_show_left[] = 'search_box';
//$dont_show_left[] = 'category_menu';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<?php include("page_headers.php"); ?>
	<style>
	.coupon {
	border:1px dashed black;
	border-radius: 4px;
	padding:10px 10px 10px 10px;
	
	}
	#couponinfo {
	margin-left:-25px;
	}
	</style>
   
        <script type="text/javascript">
            function setname(name)
            {
                var temp = document.getElementById('bidpackname'+name).value;
                document.getElementById('bidpackname').innerHTML = temp;
            }

           function checkout(formid){
           
	     
	   
		if(document.formid.firstname.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_YOUR_FIRST_NAME; ?>");
                    document.formid.firstname.focus();
                    return 'false';
                }
                if(document.formid.delivery_addressline1.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_YOUR_ADDRESS; ?>");
                    document.formid.delivery_addressline1.focus();
                    return 'false';
                }
                 if(document.formid.delivery_city.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_YOUR_CITY; ?>");
                    document.formid.delivery_city.focus();
                    return 'false';
                }
                 if(document.formid.delivery_postcode.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_YOUR_ZIPCODE; ?>");
                    document.formid.delivery_postcode.focus();
                    return 'false';
                }
                 if($('#delivery_country').val() == ''){
		    alert("<?php echo PLEASE_ENTER_YOUR_COUNTRY; ?>");
                    document.formid.delivery_country.focus();
                    return 'false';
                 
                 }else{
                 
		    if($('#delivery_country').val() == 'US' & $('#delivery_state').val() == ''){
		    alert("<?php echo PLEASE_ENTER_YOUR_STATE; ?>");
                    document.formid.delivery_state.focus();
                    return 'false';
		    
		    
		    }
		     if($('#delivery_country').val() == 'CA' & $('#delivery_state').val() == ''){
		    alert("<?php echo PLEASE_ENTER_YOUR_STATE; ?>");
                    document.formid.delivery_state.focus();
                    return 'false';
		    
		    
		    }
                 
                 }
                if(document.formid.firstName.length > 0){
		      if(document.formid.firstName.value=="")
		      {
			  alert("<?php echo PLEASE_ENTER_YOUR_FIRST_NAME; ?>");
			  document.formid.firstName.focus();
			  return 'false';
		      }
		      if(document.formid.c_name.value=="")
		      {
			  alert("<?php echo PLEASE_ENTER_YOUR_CARD_NAME; ?>");
			  document.formid.c_name.focus();
			  return 'false';
		      }

		      if (ccCardNumber(document.formid.c_no.value) == false) {
			  alert("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>")
			  document.formid.c_no.focus();
			  return 'false';
		      }

		      if (document.formid.c_cvv_no.value.length < 3) {
			  alert("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
			  document.formid.c_cvv_no.focus();
			  return 'false';
		      }
			   
				
				  if(ccCardNumber($("#creditCardNumber").val())==false){
				      alert("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>");
				      $("#creditCardNumber").focus();
				      return 'false';
				  }
				  if($("#cvv2Number").val().length<3){
				      alert("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
				      $("#cvv2Number").focus();
				      return 'false';
				  }
				  return 'false';
				  
				  
			   
                }
                return 'false';
              }
	    <?php include('modules/gateways/javascript.php'); ?>
            $(document).ready(function(){

               
                
                
                
                <?php
                if(db_num_rows(db_query("select * from sitesetting where name = 'allow_bn_coupon' and value = 1"))>=1){
                
                ?>
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
                    <?php
                    if(db_num_rows(db_query("select * from sitesetting where name = 'multiple_coupon' and value = 1"))>= 1){
                    ?>
                    var coup_codes='';
                    
                    $(".couponcode_list").each(function(){
                    
                    coup_codes += $(this).val() + ',';
                    
                    });
                    <?php
                    }
                    ?>
                    
                    
                    $.ajax({
                        type:"get",
                        url:"getcouponinfo.php?price=" + $('#price_for_ajax').val()<?php
                    if(db_num_rows(db_query("select * from sitesetting where name = 'multiple_coupon' and value = 1"))>= 1){
                    ?>+"&coup_codes=" + coup_codes<?php } ?>,
                        dataType:"json",
                        cache: false,
                        data:{couponcode:code},
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
                
                <?php } ?>
            });


	    function OpenDetails(id){
		$('.payment_form form').removeClass('checkoutform');
		$('.payment_form').css('display', 'none');
		$('#' + id).css('display', 'block');
		$('#' + id + ' form').addClass('checkoutform');
	    
	    }
        </script>
             
    </head>

    <body class="single">
         <?php
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	
	      if(file_exists("include/$template/product_pages/" . basename($_SERVER['PHP_SELF']))){
		include("include/$template/product_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include("include/product_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
	  ?>
    <?php
    if(!empty($_REQUEST['errors'])){
    ?>
    <div id="payment_errors" style="display:none;">
    <?php
    echo $errors;
    ?>
    </div>
    <script>
	$('#payment_errors').dialog({ modal: true });
    </script>
    <?php
    }
    ?>
    </body>
</html>
