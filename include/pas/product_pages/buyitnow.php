 
        <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><em><?= $SITE_NM; ?> - <?php echo BUY_PRODUCT_NOW; ?></em>

                        </p>
                    </div><!-- /title-category-content -->

                    <?
                        $id = $_GET["auctionId"];
                        $aucdb = new Auction(null);

                        $ressel = $aucdb->selectByAuctionId($id);
                        $total = db_num_rows($ressel);


                        if ($total > 0) {
                            $obj = db_fetch_object($ressel);
                            $userdb = new Registration(null);
                            $userquery = $userdb->selectById($uid);
                            $user = db_fetch_object($userquery);

                            $pname=$obj->bidpack?($obj->bidpack_name ." ({$obj->bid_size} Bids and {$obj->freebids} Freebids) " ):$obj->name;
                            $picture=$obj->bidpack?$obj->bidpack_banner:$obj->picture1;


                            if ($obj->allowbuynow == true) {
                                $buynowprice = $aucdb->getBuynowPrice($uid, $id);
                                
                    ?>
                                <div id="buyproduct-box" class="content">
                                    <div class="productimage">
                                        <a href="<?php echo SEOSupport::getProductUrl($pname, $obj->auctionID, $obj->uniqueauction==true?'n':'l'); ?>">
                                            <img src="<?php echo $UploadImagePath;?>products/<?php echo $picture;?>" alt="" width="200px" height="157px" border="0"/>
                            </a>
                        </div><!-- /bid-image -->
                        <div class="productinfo">
                            <h5><?php echo BUY_PRODUCT_NOW; ?></h5>
                            <?php include($BASE_DIR . "/modules/gateways/price_breakdown.php"); ?>
                             <p>
                                 <strong><?php echo AFTER_PAYMENT_THE_PRODUCT_WE_WILL_SEND_IT; ?>.</strong>
                             </p>
                         <input id="price_for_ajax" class="text" type="hidden" value="<?php echo number_format($buynowprice['total'] + $taxamount, 2); ?>" />
                          <?php
				  if(db_num_rows(db_query("select * from sitesetting where name = 'allow_bn_coupon' and value = 1"))>=1){
                
			    ?> 
			    
			    <div id="buybids-box" class="content">
			    <div class="bid-box">
                            <div class="buytipinfo">
                                 <p>
                                     <h5><?php echo ENTER_A_COUPON_CODE; ?></h5>
                                     <div style="margin-top:4px;vertical-align: middle;">
                                         <input type="text" id="couponcode" />
                                         <button value="APPLY COUPON " name="applycoupon" type="button" id="applycoupon"><?php echo APPLY_COUPON; ?></button>
                                     </div>
                                     <div id="couponinfo"></div>
                                     <div class="error"><?php echo $_GET['msg'] == '1' ? "(" . INCORRECT_COUPON_CODE . ")" : "" ?></div>
                                 </p>
                             </div>
			    </div>
			    </div>
                            <?php } ?>

                         </div>

                         <div class="clear"></div>

                         <div id="buybidBox">
			  <div style="float:left;">
                             <h4><?php echo CHOOSE_PAYMENT_METHOD; ?>:</h4>
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
			  <div style="float:right;">
                            <?php
                          $p = 1;
				foreach($gateways as $gateway){
				    if(is_dir("modules/gateways/$gateway[name]")){
				?>
					<div id="<?php echo $gateway['name']; ?>" <?php if( count($gateways) >= 2){ ?> style="display:none;" <?php } ?> class="payment_form">
                                             <form action="payment.php" method="post" name="form_<?php echo $p;?>" title="<?php echo $p;?>" id="form_<?php echo $p;?>" >
                                              
                                                
                                                 
                                               
					      <?php
					      include("modules/gateways/address_form.php");
					    
					      include("modules/gateways/$gateway[name]/form_front.php");
					      
					      ?>
					    
					       <div id="couponcode_html_<?php echo $p;?>"></div>
                                                     <input type="hidden" name="paymentpage" value="<?php echo $gateway['name']; ?>"/>
                                                     <input type="hidden" name="payfor" value="<?php echo PAYFOR_BUYITNOW; ?>"/>
                                                     <input type="hidden" name="auctionId" value="<?= base64_encode($id); ?>" />
                                                     <input value="<?php echo BUY_PRODUCT; ?>" class="bid-button-link" title="<?php echo $p;?>" name="<?php echo $gateway['name']; ?>" type="image" src="img/buttons/btn_buitnow.png" />
                                                 
					      </form>
					</div>
                            
			      <?php
					}
					
					$p++;
				
				}
				?>
                                    
			      </div>
                             </div>
                         </div>
                         <div class="clear"></div>
                    <?php } else {
                    ?>
                                     <div id="buybids-box" class="content">
                                         <p><?php echo THE_PRODUCT_DONT_ALLOW_TO_BUY_IT_NOW; ?></p>
                                     </div><!-- /content -->
                    <?
                                 }
                             } else {
                    ?>

                                 <div id="buybids-box" class="content">
                                     <p><?php echo NOW_PRODUCT_TO_SELECT_TO_BUY ?></p>
                                 </div><!-- /content -->
                    <?
                             }
                    ?>
                         </div><!-- /column-right -->
                         <div id="column-left">
			    <?php include("leftside.php"); ?>
                   
                         </div><!-- /column-left -->


                     </div> <!--end container-->

            <?php include("include/footer.php"); ?>
        </div> <!--end main-->