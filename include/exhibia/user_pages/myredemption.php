    <div id="pagewidth">
            <!-- ============= Header =============  -->
           <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
            <!-- ============= End Header =============  -->
	<div id="wrapper" class="clearfix">
                <div id="maincol">
                    <div id="auction-listing">
                        <div id="myaccount-head">
                            <h2><?php echo getUserName($_SESSION["userid"]); ?>, <?php echo WELCOME_BACK;?></h2>
                        </div>
                        <div id="live-auctions">
                            <div id="help-left">
                                <?php include $BASE_DIR . '/include/' . $template . '/mybid_nav.php'; ?>
                            </div>

                            <!-- ============= End Left Navigation =============  -->
                            <div id="myqb-wrap">
                                <div id="myqb" style="width:750px;">
                                
                                  <h1><?php echo MY_REDEMPTIONS; ?></h1>
                                    <p>
                                        <?php echo WELCOME_CONTENT;?> 
                                    </p>

                                    <div id="myqb-auctions">
                                        <div id="myqb-auctions-head">
                                            <div id="thumbheader">&nbsp;</div>
                                            <div id="product_title"><?php echo PRODUCTS; ?></div>
                                            <div id="price_title"><?php echo PRICE_BIDDER; ?></div>
                                            <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
                                        </div>                                       

                                        <div id="myqb-auction-body">
                <?php
				if($total>0)
				{		 
					$i = 1;
					while($obj = db_fetch_array($ressel))
					{
						
			  	?>		
                    <div class="bid-box">
                        <div class="bid-image">
                            <a href="<?php echo SEOSupport::getRedeemUrl($obj["name"], $obj["id"]); ?>">
                                <img src="<?=$UploadImagePath;?>products/thumbs_small/thumbsmall_<?=$obj["picture1"];?>" alt="" width="118" height="100" border="0"/>
                            </a>
                            
                        </div><!-- /bid-image -->
                        <div class="bid-content">
                            <h2><a href="<?php echo SEOSupport::getRedeemUrl($obj["name"], $obj["id"]); ?>"><?=stripslashes($obj["name"]);?></a></h2>
                            <p>
                            	<?=choose_short_desc(stripslashes($obj["short_desc"]),110);?>
                                <a href="<?php echo SEOSupport::getRedeemUrl($obj["name"], $obj["id"]); ?>" class="blackmore">More</a>
                            </p>
                                                    
                        </div><!-- /bid-content -->
                        <div class="bid-countdown">
                        	<p>
                            	<strong><?php echo REDEMPTION_POINTS; ?>:</strong><?=$obj["redem_points"];?>
                            </p>
                            <p>
                            	<strong><?php echo EXPIRATION_DATE; ?>:</strong><?=arrangedate($obj["redem_enddate"]);?>
                            </p>    
                        </div><!-- /bid-countdown -->
                    </div><!-- /bid-box -->
                    <?php } ?>
                
                    <!-- start page number-->
                    
                    <div class="clear">&nbsp;</div>
                    <?php if($totalpage>1){ ?>
                    <div class="pagenumber" align="right">
                        <ul>
                        <?php
                        if($PageNo>1)
                        {
                              $PrevPageNo = $PageNo-1;
                        
                        ?>
                          <li><a href="redemption.php?pgno=<?=$PrevPageNo; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                        <?php 
                        }
                        ?>
                        
                        <?php
                        if($PageNo<$totalpage)
                        {
                         $NextPageNo = 	$PageNo + 1;
                        ?>
                          <li><a id="next" href="redemption.php?pgno=<?=$NextPageNo;?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                        <?php
                           }
                        ?>
                        </ul>
                    </div>		
                    <?php } ?><!--page number-->                    
                
                <?php }else{?>
                <div class="bid-box">
                <div class="clear" style="height: 20px;">&nbsp;</div>
                <div align="center"><?php echo YOU_DONOT_HAVE_ANY_REDEMPTIONS_IN_YOUR_ACCOUNT_YET; ?>.</div>
                <div class="clear" style="height: 20px;">&nbsp;</div>
                </div>
                <?php	}	?>   
						</div>
						
					    </div>
                                        </div>

                                    </div>                                  
                                    <!-- ============= /Recently Won Auctions =============  -->

                                    <!-- ============= End FAQs =============  -->
                                </div>
                            </div>
                            <div class="clear"></div>

                        </div>
                        <div id="myaccount-end-bg"></div>
                    </div>
                </div>
            </div>
        </div>
 <?php include $BASE_DIR . '/include/' . $template . '/footer.php' ?>