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

.payment_form form p {
  height: 30px;
  width: 450px;
  clear: both;

}
.paymentmethod_list p {
  height: 75px;
  width: 430px;
  border: 1px solid #fff;
  border-radius: 8px;
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


</style>

        <div id="pagewidth">
            <!-- ============= Header =============  -->
             <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->

            <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <!-- ============= Registration =============  -->
                    <div id="bidpack-wrap">
                       

                        <h2><?php echo BUY_PRODUCT_NOW; ?></h2>
                        <!-- ============= Ready Start Winning =============  -->

                        <?php
                        $id = $_GET["auctionId"];
                        $aucdb = new Auction(null);

                        $ressel = $aucdb->selectByAuctionId($id);
                        $total = db_num_rows($ressel);


                        if ($total > 0) {
                        $obj = db_fetch_object($ressel);
                                $userdb = new Registration(null);
                                $userquery = $userdb->selectById($uid);
                                $user = db_fetch_object($userquery);

                                $price = $obj->bidpack ? $obj->bidpack_price : $obj->price;
                                $pname = $obj->bidpack ? ($obj->bidpack_name . " ({$obj->bid_size} Bids and {$obj->freebids} Freebids) " ) : $obj->name;
                                $picture = $obj->bidpack ? $obj->bidpack_banner : $obj->picture1;
                                $short_desc = $obj->bidpack ? ($obj->bid_size . ' ' . AVAILABLE_BIDS . ' + ' . $obj->freebids . " " . FREE_BIDS) : $obj->short_desc;

                                if ($obj->allowbuynow == true) {
                                    $buynowprice = $aucdb->getBuynowPrice($uid, $id);
                        ?>
                               <div id="buyproduct-box" class="content">
                                    <div class="productimage">
                                        <a href="<?php echo SEOSupport::getProductUrl($pname, $obj->auctionID, $obj->uniqueauction==true?'n':'l'); ?>">
                                            <img src="<?php echo $UploadImagePath;?>products/<?php echo $picture;?>" alt="" width="200px" height="157px" border="0"/>
					</a>
				    </div><!-- /bid-image -->
				  
                     
                            
                            <?php include($BASE_DIR . "/modules/gateways/price_breakdown.php"); ?>
                             <p>
                                 <strong><?php echo AFTER_PAYMENT_THE_PRODUCT_WE_WILL_SEND_IT; ?>.</strong>
                             </p>
                         <input id="price_for_ajax" class="text" type="hidden" value="<?php echo number_format($buynowprice['total'] + $taxamount, 2); ?>" />
                          <?php
				  if(db_num_rows(db_query("select * from sitesetting where name = 'allow_bn_coupon' and value = 1"))>=1){
				   }
			    ?> 
			    
			  
                                    <!-- ============= End Ready Start Winning =============  -->
			      <div class="clear"></div>
                                    <div id="payment-form-wrap" style="float:left;">

                                      
                                        <div id="payment-form">

                                            <div>
                                                
                                                <img style="float:right;" src="img/payment-method-list-image.png"/>
                                                <div class="clear"></div>
                                            </div>

                                            <div class="paymentmethod_list">

                                               <form name="payment" action="payment.php" method="post">
					      <?php
						  $p = 1;
						  foreach($gateways as $gateway){
						      if(is_dir("modules/gateways/$gateway[name]")){
						  ?>
						  
						      <p id="<?php echo $gateway['name'];?>_select" class="unselected">
							  <input id="<?php echo $gateway['name'];?>_method" type="radio" name="paymentmethod" value="<?php echo $gateway['name'];?>" onclick="OpenDetails(this.value)" />
							  <label for="<?php echo $gateway['name'];?>_method"><img style="vertical-align:middle;width:100px;height:auto;" src="<?php echo $SITE_URL;?>/modules/gateways/<?php echo $gateway['name'];?>/logo.gif" /></label>
						      </p>
									    
						  <?php } 
						  
						  ?>
						  
						    <?php
						    
						    $p++;
						      }
						      
						    ?>
						  
					      </form>

                                            </div>
					    </div>
					 
					   </div>
                                            <div id="payment-info2" style="float:right;">
                                                <?php
						  $p = 1;
							foreach($gateways as $gateway){
							    if(is_dir("modules/gateways/$gateway[name]")){
							?>
							    <div id="<?php echo $gateway['name']; ?>" <?php if( count($gateways) >= 2){ ?> style="display:none;" <?php } ?> class="payment_form">
								    <form action="payment.php" method="post" name="form_<?php echo $p;?>" title="<?php echo $p;?>" id="form_<?php echo $p;?>" class="checkoutform">
								      
									
									
								      
								      <?php
								      include("modules/gateways/address_form.php");
								    
								      include("modules/gateways/$gateway[name]/form_front.php");
								      
								      ?>
								    
								      <div id="couponcode_html_<?php echo $p;?>"></div>
									    <input type="hidden" name="paymentpage" value="<?php echo $gateway['name']; ?>"/>
									    <input type="hidden" name="payfor" value="<?php echo PAYFOR_BUYITNOW; ?>"/>
									    <input type="hidden" name="auctionId" value="<?= base64_encode($id); ?>" />
									    <!-- <input value="<?php echo BUY_PRODUCT; ?>" class="bid-button-link" title="<?php echo $p;?>" name="<?php echo $gateway['name']; ?>" type="image" src="include/<?php echo $template;?>/img/buttons/btn_buitnow.png" />-->
									    
							      <br />       
							      <p align="right" style="float:right;" >
								      <button value="<?php echo BUY_PRODUCT; ?>" name="mygate" type="submit"><?php echo BUY_PRODUCT; ?></button>
								</p>
								      </form>
							</div>
						    
						      <?php
								}
								
								$p++;
							
							}
							?>


                                            </div>


                                        </div>

                                    
                                    <div class="clear"></div>
                        <?php
                        
                        } else {
                        ?>
                                        <div style="min-height:300px;padding:20px;">
                                            <p>
                                <?php echo THE_PRODUCT_DONT_ALLOW_TO_BUY_IT_NOW; ?>
                                    </p>

                                </div>
                        <?php
                                    }
                                } else {
                        ?>

                                    <div style="min-height:300px;padding:20px;">

                                        <p>
                                <?php echo NOW_PRODUCT_TO_SELECT_TO_BUY ?>
                                </p>

                            </div>
                        <?php }
                        
                        
                        
                        ?>

                                <div class="clear"></div>
                              
                            </div>
                            <!-- ============= End Registration =============  -->
                        </div>
                    </div>
                    <div id="wrap-end"></div>
                </div> <!--end pagewidth-->
</div>
                                   
        <?php include("$BASE_DIR/include/$template/footer.php"); ?>
    </body>
</html>
