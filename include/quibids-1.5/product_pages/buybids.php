<style>
#buyproduct-box {
  padding: 0 10px;
  width: 980px;
}
.productimage {
  text-align: center;
  width: 480px;
}
.payment_form form {
  margin: 0;
  padding: 0;
  width: 450px;
}
.payment_form form p label {
float:left;

}
.payment_gateway_wrapper > button {
  clear: both;
  float: right;
  margin: 30px 0;
}
.payment_form form p {
  height: 30px;
  width: 450px;
  clear: both;

}
.paymentmethod_list p {
  border: 1px solid #FFFFFF;
  border-radius: 8px;
  height: 75px !important;
  width: 430px !important;
}
.paymentmethod_list p label {
  color: #696969;
display: inline-block;
float: right;
font-size: 0.93em;
margin: 20px 40px 0 0;
text-align: right;
vertical-align: middle;
width: 135px;
}
.payment_form form p input[type="text"], .payment_form form p select {
border-radius:6px;
border:1px solid lightblue;
float: right;

margin: 0px 0 0 20px;
width:220px;
background-color:#fff;
}
#payment-info2 {
float: right;
margin: 0 30px 0 -30px;
}
#payment-form label {
  color: #696969;
  display: inline-block;
  font-size: 0.93em;
  margin: 20px 10px 15px 0;
  text-align: right;
  vertical-align: middle;
  width: 135px;
}
#payment-form input {
  border: 1px solid #BFBFBF;
  margin-bottom: 15px;
  padding: 2px;
  vertical-align: middle;
  width: 212px;
  margin: 30px;
}
#bidpack-wrap {
  background: url("css/quibids-1.0/login-register-bg.gif") repeat scroll 0 0 rgba(0, 0, 0, 0);
  height: auto !important;
  margin-left: 8px;
  min-height: 1400px !important;
  width: 980px;
}

</style>
        <div id="pagewidth">
            <!-- ============= Header =============  -->
             <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->

            <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <!-- ============= Registration =============  -->
                    <div id="bidpack-wrap">
                        <div style="float: right; right: 20px; top: 5px; position: relative; font-size: 14px; font-weight: bold;">
                            
                            <table><tbody><tr><td align="right">
                                            <script type="text/javascript" src="flash/getseal_002"></script><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" id="s_s" width="100" align="" height="72">
                                                <param name="movie" value="https://seal.verisign.com/getseal?at=1&amp;&amp;sealid=2&amp;dn=WWW.QUIBIDS.COM&amp;aff=VeriSignCACenter&amp;lang=en"/>
                                                <param name="loop" value="false"/>
                                                <param name="menu" value="false"/>
                                                <param name="quality" value="best"/>
                                                <param name="wmode" value="transparent"/>
                                                <param name="allowScriptAccess" value="always"/>
                                                <embed src="flash/getseal" loop="false" menu="false" quality="best" wmode="transparent" swliveconnect="FALSE" name="s_s" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer" allowscriptaccess="always" width="100" align="" height="72"/>
                                            </object>
                                        </td>
                                        <td width="5">&nbsp;</td>
                                        <td>
                                            <img src="img/lock.png"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                           
                        </div>

                        <h2><?php echo BUY_BID; ?></h2>
                        <!-- ============= Ready Start Winning =============  -->                       

                        <div id="bid-pack-wrap">
			  <h3><?php echo CHOOSE_A_BID_PACK;?></h3>
 
			    <h3><?php echo YOU_HAVE_CHOSEN;?>: <span id="bidpackname"></span></h3> 
                            <div id="bid-packs" style="float:left;">
                                <?php
                                $i = 0;
                                while ($obj = db_fetch_array($rssel)) {
                                    $path = '';
                                    if ($obj['bid_size'] <= 24)
                                        $clssize = "bg-box-xs.gif";
                                    else if ($obj['bid_size'] > 24 && $obj['bid_size'] <= 57)
                                        $clssize = "bg-box-s.gif";
                                    else if ($obj['bid_size'] > 57 && $obj['bid_size'] <= 118)
                                        $clssize = "bg-box-m.gif";
                                    else if ($obj['bid_size'] > 118 && $obj['bid_size'] <= 295)
                                        $clssize = "bg-box-l.gif";
                                    else if ($obj['bid_size'] > 295 && $obj['bid_size'] <= 605)
                                        $clssize = "bg-box-xl.gif";
                                    else if ($obj['bid_size'] > 605 && $obj['bid_size'] <= 1250)
                                        $clssize = "bg-box-xxl.gif";
                                    else if ($obj['bid_size'] > 1250 && $obj['bid_size'] <= 1900)
                                        $clssize = "bg-box-u.gif";
                                ?>
                                    <label class="pkg_ <?php echo $i == 0 ? 'active' : ''; ?>" id="pkg_<?php echo $i; ?>">
                                       <input type="radio" value="<?php echo $obj['id']; ?>"  onclick="javascript: setname(<?php echo $i;?>); set_bidpack_snapbids('pkg_<?php echo $i; ?>');$('.bidpacks').prop('checked', false);$(this).prop('checked', true);" class="bidpacks" />
                                             <span style="background-image: url(uploads/products/<?php echo $obj['bidpack_banner'];?>);background-size:110px 130px;">
                                            <strong><?php echo $obj['bidpack_name']; ?> </strong>
						<?php echo $obj["bid_size"]; ?>&nbsp;<?php echo BIDS; ?>&nbsp;<?php echo FOR1 . ' ' . USD . $obj['bid_price']; ?>
					    </span>
                                           
                                              
                                               
                                               <input type="hidden" id="bidpackname<?php echo $i; ?>" value="<?php echo $obj['bidpack_name'] ?>" />
                                               <input type="hidden" id="pkg_name_<?php echo $i; ?>" class="pkg_name" value="<?php echo $obj['bidpack_name'] ?>"/>
                                                <input type="hidden" id="pkg_size_<?php echo $i; ?>" class="pkg_size" value="<?php echo $obj['bid_size'] ?>"/>
                                                <input type="hidden" id="pkg_free_<?php echo $i; ?>" value="<?php echo $obj['freebids'] ?>"/>
                                                <input type="hidden" id="pkg_price_<?php echo $i; ?>" value="<?php echo $obj['bid_price'] ?>"/>
                                                <input type="hidden" id="pkg_base64id_<?php echo $i; ?>" class="pkg_base64id" value="<?php echo base64_encode($obj['id']); ?>"/>
                                           </label>

                                <?php $i++;
                                    } ?>
                                </div>
                                <br/><div class="wraps"></div>
                                <div id="bid-packs" style="padding-left:25px;">
                                    <strong><?php echo ENTER_A_COUPON_CODE; ?></strong>
                                    <div style="margin-top:4px;vertical-align: middle;">
                                        <input type="text" id="couponcode" />
                                        <button value="APPLY COUPON " name="applycoupon" class="button" style="border:none;" type="button" id="applycoupon">
                                        <?php echo APPLY_COUPON; ?>
                                    </button>
                                </div>
                                <div id="couponinfo"></div>
                                <div class="error"><?php echo $_GET['msg'] == '1' ? "(" . INCORRECT_COUPON_CODE . ")" : "" ?></div>
                            </div>
                        </div>
                        <!-- ============= End Ready Start Winning =============  -->
			
				
                             <div  style="float:right;">
                                <div id="payment-form-wrap">

                                      
                                        <div id="payment-form">

                                            <div>
                                                
                                                <img style="float:right;" src="img/payment-method-list-image.png"/>
                                                <div class="clear"></div>
                                            </div>

                                        <div class="paymentmethod_list">
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
				    </div>
				  </div>
				</div>
			      
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
					  <input type="hidden" name="payfor"  value="<?php echo PAYFOR_BUYBID; ?>"/>
					  <div id="couponcode_html_1"></div>
					  <input type="hidden" name="bidpackid" class="bidpackid" value="<?php echo base64_encode($i); ?>" />
					  <input type="hidden" name="bidpacksize" class="bidpacksize" value="<?php echo $obj->bid_size; ?>" />
					  
					  <p align="center" >
					      <button value="BUY BIDS" name="mygate" type="submit"><?php echo BUY_BIDS; ?></button>
					</p>
						    
						   
						  
						  </div>
					    </form>
				      </div>
				    <?php
			     
					  }
				
				
				    }
				    
				  ?>
                          
                           </div>
                      
                        
                        <!-- ============= End Registration =============  -->
                   </div>
               
                <div id="wrap-end"></div>
            </div> <!--end pagewidth-->
 </div>
         <?php include("$BASE_DIR/include/$template/footer.php"); ?>

