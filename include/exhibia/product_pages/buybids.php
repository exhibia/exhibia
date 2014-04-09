<style>


#couponinfo {
  margin-left: -25px;
  position: relative;
  right: 170px;
}
#column-right {
  left: -80px!important;
  position: relative;
}
.content {
  float: left;
  margin: 0 10px 0 0;
  padding: 0;
  width: 745px!important;
}
#buybids-box div.bid-box {
  background: none repeat scroll 0 0 #FFFFFF;
  border: 1px solid #ADD5E5;
  border-radius: 6px;
  float: left;
  height: 156px;
  margin: 2px;
  padding: 6px;
  width: 345px;
}
.bid-box{
margin: 10px 5px 5px 5px;
}
</style>
	<div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                
                
		                       <div class="tab-area">          
                            
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><em><?php echo $SITE_NM; ?> - <?php echo BUY_BIDS; ?></em>
                            <?php
                            if (!($_POST["buybids"] != "" or $_GET["pkg"] != "")) {
                            ?>
                                <small><?php echo PLEASE_CHOOSE_WHICH_BIDPACK; ?></small>
                            <?php } ?>
                        </p>
                    </div><!-- /title-category-content -->
		    <div id="buybids-box" class="content">
                    <?php
                            if ($_POST["buybids"] != "" or $_GET["pkg"] != "") {
                                $id = $_GET["pkg"];
                                $qrysel = "select * from bidpack where id=$id";
                                
                                $ressel = db_query($qrysel);
                                $obj = db_fetch_object($ressel);
                               
                                $clssize = "";
                                if ($obj->bid_size <= 24)
                                    $clssize = "xs";
                                else if ($obj->bid_size > 24 && $obj->bid_size <= 57)
                                    $clssize = "s";
                                else if ($obj->bid_size > 57 && $obj->bid_size <= 118)
                                    $clssize = "m";
                                else if ($obj->bid_size > 118 && $obj->bid_size <= 295)
                                    $clssize = "l";
                                else if ($obj->bid_size > 295 && $obj->bid_size <= 605)
                                    $clssize = "xl";
                                else if ($obj->bid_size > 605 && $obj->bid_size <= 1250)
                                    $clssize = "xxl";
                                else if ($obj->bid_size > 1250 && $obj->bid_size <= 1900)
                                    $clssize = "u";
                                   
                    ?>
                                

                                    <div class="bid-box" >
                                        <div style="min-width:150px;min-height:150px;float:left;background:url('<?php echo $SITE_URL;?>uploads/products/thumbs/thumb_<?php echo $obj->bidpack_banner;?>') left top no-repeat;background-size: 150px 150px;">
                              
                                <input id="price_for_ajax" value="<?php echo $obj->bid_price; ?>" type="hidden" />
                              
                            </div><!-- /bix-pack xs -->
                            <div class="pack-description">
                                <h3><?php echo stripslashes($obj->bidpack_name); ?></h3>
                                <ul>
                                    <li>- <?php echo $obj->bid_size; ?> <?php echo BIDS; ?></li>
                                    <li>- <?php echo $obj->freebids; ?> <?php echo FREE_BIDS; ?></li>
                                    <li>- <?php echo $Currency; ?><?php echo $obj->bid_price; ?> <?php echo USD_ONLY; ?></li>
                                </ul>

                            </div><!-- /pack-description -->
                        </div><!-- /bid-box -->
                        <div class="buytipinfo">
                            <h4><?php echo BUY_A_BIDPACK; ?></h4>
                            <br/>
                            <?php echo YOU_HAVE_CHOOSEN; ?> <br/><?php echo $obj->bidpack_name . "&nbsp;(" . "{$obj->bid_size} Bids + {$obj->freebids}" . "Free Bids / " . $Currency . $obj->bid_price . ")"; ?> . <br><?php echo AFTER_PAYMENT_THE_BIDS_WILL_BE_BOOKED_TO_YOUR_ACCOUNT; ?>.
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

                             <div class="clear"></div>

                            <table id="buybidBox" style="float:left;display:inline;margin-left:30px;">
			      <tr>
				<td valign="top" height="100%">
                                 <h4><?php echo CHOOSE_PAYMENT_METHOD; ?>:</h4>
                                 <form name="payment" action="payment.php" method="post">
				
				<?php
				
				foreach($gateways as $gateway){
				    if(is_dir("modules/gateways/$gateway[name]")){
				?>
				
				    <p id="<?php echo $gateway['name'];?>_select" class="unselected">
					<input id="<?php echo $gateway['name'];?>_method" checked="checked" type="radio" name="paymentmethod" value="<?php echo $gateway['name'];?>" onclick="OpenDetails(this.value)" />
					<label for="<?php echo $gateway['name'];?>_method"><img style="vertical-align:middle;width:100px;height:auto;" src="<?php echo $SITE_URL;?>/modules/gateways/<?php echo $gateway['name'];?>/logo.gif" /></label>
				    </p>
							  
		                 <?php } 
				
				
				    }
				    
				  ?>
                             
                              
                            </form>
                           </td>
                           <td valign="top" height="100%">
                           
                              <?php
				foreach($gateways as $gateway){
				    if(is_dir("modules/gateways/$gateway[name]") & file_exists("modules/gateways/$gateway[name]/form_front.php")){
				?>
				
					<div id="<?php echo $gateway['name']; ?>" <?php if( count($gateways) >= 2){ ?> style="display:none;" <?php } ?> class="payment_form">
		  
					    <form action="payment.php" method="post" name="f2" id="checkoutform">
		      
					  
								  <?php
								  include("modules/gateways/$gateway[name]/form_front.php");
								  ?>
						    <input type="hidden" name="paymentpage" value="<?php echo $gateway['name']; ?>"/>
						    <input type="hidden" name="payfor" value="<?php echo PAYFOR_BUYBID; ?>"/>
						    <div id="couponcode_html_1"></div>
						    <input type="hidden" name="bidpackid" value="<?php echo base64_encode($id); ?>" />
						    <input type="hidden" name="bidpacksize" value="<?php echo $obj->bid_size; ?>" />
						    <input id="fund_id" type="hidden" value="<?php echo $_REQUEST['fund_id'];?>" name="fund_id">
						    <p align="center" class="button">
							<button value="BUY BIDS" name="mygate" type="submit"><?php echo BUY_BID; ?></button>
						  </p>
					    </form>
				      </div>
				    <?php
			     
					  }
				
				
				    }
				    
				  ?>
			      </td>
			    </tr>
			 </table>
                    
                            </div>
                        </div>
                      
                    <?php } else {
 ?>
			     

                                    <div id="buybids-box" class="content" style="width:745px!important;">
                                        <p><?php echo YOU_HAVE_CURRENTLY_SELECTED; ?> : <strong><span id="bidpackname"></span></strong></p>
                        <?php
                                    $i = 1;
                                    $a = 1;
                                    while ($obj = db_fetch_array($rssel)) {
                                        $bname = $obj["bidpack_name"];

                                        $clssize = "";
                                        if ($obj["bid_size"] <= 24)
                                            $clssize = "xs";
                                        else if ($obj["bid_size"] > 24 && $obj["bid_size"] <= 57)
                                            $clssize = "s";
                                        else if ($obj["bid_size"] > 57 && $obj["bid_size"] <= 118)
                                            $clssize = "m";
                                        else if ($obj["bid_size"] > 118 && $obj["bid_size"] <= 295)
                                            $clssize = "l";
                                        else if ($obj["bid_size"] > 295 && $obj["bid_size"] <= 605)
                                            $clssize = "xl";
                                        else if ($obj["bid_size"] > 605 && $obj["bid_size"] <= 1250)
                                            $clssize = "xxl";
                                        else if ($obj["bid_size"] > 1250 && $obj["bid_size"] <= 1900)
                                            $clssize = "u";
                        ?>
                                        <div class="bid-box" >
                                            <div class="bix-pack <?php echo $clssize; ?>" style="background-image: url(<?php echo $SITE_URL; ?>uploads/products/<?php echo urlencode($obj['bidpack_banner']); ?>);border-radius:10px;margin-left:5px;">
                                                <h4><?php echo BID_PACK; ?></h4>
                                                <p><?php echo $obj["bid_size"]; ?> <?php echo BIDS; ?></p>
                                                <small><?php echo $Currency; ?><?php echo $obj["bid_price"]; ?></small>
                                            </div><!-- /bix-pack xs -->
                                            <div class="pack-description">
                                                <h3><?php echo stripslashes($obj["bidpack_name"]); ?></h3>
                                                <ul>
                                                    <li>- <?php echo $obj["bid_size"] ?> <?php echo BIDS; ?></li>
                                                    <li>- <?php echo $obj['freebids']; ?> <?php echo FREE_BIDS; ?></li>
                                                    <li>- <?php echo $Currency; ?><?php echo $obj["bid_price"]; ?> <?php echo USD_ONLY; ?></li>
                                                </ul>
                                                <input type="hidden" name="pkg" value="<?php echo $obj["id"]; ?>" />
                                                <input type="hidden" value="<?php echo $obj["bidpack_name"]; ?>" name="bidpackname<?php echo $obj["id"] ?>" id="bidpackname<?php echo $obj["id"] ?>" />
                                                <button type="submit" onclick="javascript: window.location.href='buybids.php?pkg=<?php echo $obj["id"] ?>'" style="cursor: pointer" ><?php echo BUY_BIDS; ?></button>
                                            </div><!-- /pack-description -->
                                        </div><!-- /bid-box -->
                        <?php
                                        $i++;
                                    }
                        ?>
                        
                                </div><!-- /content -->
                                 
                    <?php
                                }
                                
                    ?>
			     
                            </div><!-- /column-right -->
                            <?php
                            if(empty($_REQUEST['pkg'])){
                            ?>
                           </div><!-- Fix for broken tag on opening page -->
                           <?php } ?>
			 <div id="column-left">
			  <?php include("leftside.php"); ?>
					  
                                
                            </div><!-- /column-left -->

</div>
                        </div> <!--end container-->

<?php include("footer.php"); ?>
        </div> <!--end main--> 
