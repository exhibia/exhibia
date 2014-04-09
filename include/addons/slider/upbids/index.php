<?php
//To turn off html content change this to no
$enable_html_slider_content = 'no';
//To turn off auction content change this to no
$enable_auction_slider_content = 'yes';

$uid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : 0;
$changeimage = "home";
$pagename = "index";
if (!isset($_SESSION["ipid"]) && !isset($_SESSION["login_logout"])) {

    $_SESSION["ipid"] = date("Y-m-d G:i:s");

    $_SESSION["ipaddress"] = $_SERVER['REMOTE_ADDR'];



    $qryipins = "Insert into login_logout (ipaddress,load_time) values('" . $_SESSION["ipaddress"] . "', '" . $_SESSION["ipid"] . "')";

    db_query($qryipins) or die(db_error());
}

?>

      
    <?php if (Sitesetting::enableFlashBanner() == true) {
    
 
        
?>
<script src="<?php echo $SITE_URL;?>js/jquery.jshowoff.min.js" type="text/javascript"></script>     
<!-- PROM BANNERS -->
   
            <div id="slider_box">
            
            <div class="jshowoff" >
		  <div class="wrapper">
     
            
                <?php
         $imgpath = dir($BASE_DIR . '/include/addons/slider/' . $template . '/img/' . $entry );
        $a = 0;
        while (false !== ($entry = $imgpath->read())) 
		{
		
            if (is_file($imgpath->path . '/' . $entry)) {
                if (preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $entry)) {
                
                $a++;
                    echo '<div class="images"><img src="' . $SITE_URL . '/include/addons/slider/' . $template . '/img/' . $entry . '" /></div>';
                    
                }
            }
        }
         if($enable_html_slider_content == 'yes'){
         $res_sliders = db_query("select distinct(constant), value from languages where constant like 'SLIDER%' AND value != '' order by value desc");
 
	    while ($auc = db_fetch_array($res_sliders)) {
		  $a++;
  
		  echo "<div id=\"$auc[constant]\" title=\"$a\" >" . replaceText($auc['value']) . "</div>";
  
	      }
	   }
                if($enable_auction_slider_content == 'yes'){
                if ($co == '') {
                    $qryaucflash = "select a.auctionID, adt.auc_due_price, short_desc,price,adt.auc_due_time, p.name, p.picture1, p.productID from auction a " .
                            "left join products p on a.productID=p.productID left join auc_due_table adt on a.auctionID=adt.auction_id " .
                            "where adt.auc_due_time!=0 and a.auc_status='2' and a.seatauction != 1 and a.uniqueauction='0' order by adt.auc_due_time limit 0,4";
                } else {
                    $qryaucflash = "select a.auctionID, adt.auc_due_price, short_desc,price,adt.auc_due_time, p.name, p.picture1, p.productID from auction a " .
                            "left join products p on a.productID=p.productID left join auc_due_table adt on a.auctionID=adt.auction_id " .
                            "where a.auctionID not in (" . $co . ") and a.seatauction != 1 and adt.auc_due_time!=0 and a.auc_status='2' and a.uniqueauction='0' order by adt.auc_due_time limit 0,4";
                }

                $resflash = db_query($qryaucflash);
                if (db_num_rows($resflash)) {
                    while ($auc = db_fetch_array($resflash)) {
                        if ($co == '')
                            $co.=$auc["auctionID"];
                        else
                            $co.="," . $auc["auctionID"];
if(!empty($auc['price'])){
                        $retailpercent = round($auc['auc_due_price'] * 100 / $auc['price'], 2);
}else{

$retailpercent = 0;
}
                ?>
                        
                            <!--      First Slider Content          -->

                            <div class="sliderLeft auction-item" title="<?php echo $auc["auctionID"]; ?>" id="auction_<?php echo $auc["auctionID"]; ?>" onclick="<?php echo $auc["auc_due_price"]; ?>">
                                 <?php if ($auc['uniqueauction'] == false) {
                            ?>

                                <a href="<?php echo SEOSupport::getProductUrl($auc["name"], $auc["auctionID"], 'n'); ?>">
                                    <img src="<?php echo $UploadImagePath; ?>products/<?php echo $auc["picture1"]; ?>" alt="" width="240" border="0" />
                                </a>
                            <?php } else {
                            ?>
                                <a href="<?php echo SEOSupport::getProductUrl($auc["name"], $auc["auctionID"], 'l'); ?>">
                                    <img src="<?php echo $UploadImagePath; ?>products/<?php echo $auc["picture1"]; ?>" alt="" width="240" border="0" />
                                </a>

                            <?php } ?>
                                
                            </div>
                            <div class="sliderRight">                                
                                <h2><?php echo htmlentities($auc['name']); ?></h2>
                                <p><?php echo htmlentities($auc['short_desc']) ?>
                                </p>

                                <div class="bigbannerinfo">
                                    <span style="">
                                        <span class="auctionprice"><?php echo AUCTION_PRICE; ?>:</span>

                                    </span><br />
                                </div>

                                <div class="bannerprice">
                                    <span class="pricedetail">
                                        <span id="currencysymbol_<?php echo $auc["auctionID"]; ?>"></span>
                                        <span id="price_index_page_<?php echo $auc["auctionID"]; ?>">---</span>
                                    </span><br />
                                </div>
                                <div class="clear"></div>
                                <div class="timer01">
                                    <span class="timerbig" id="counter_index_page_<?php echo $auc["auctionID"]; ?>">
                                        <script language='javascript' type='text/javascript'>
                                            document.getElementById('counter_index_page_<?php echo $auc["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $auc["auc_due_time"]; ?>');
                                        </script>
                                    </span>
                                </div>
                                <div class="">
                            <?php if ($uid == 0) {
                            ?>
                                <a id="image_main_<?php echo $auc["auctionID"]; ?>" class="buynow01" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>');" onmouseover="$(this).text('<?php echo LOGIN; ?>');"><?php echo PLACE_BID; ?></a>

                            <?php } else {
                            ?>
                                <a id="image_main_<?php echo $auc["auctionID"]; ?>" class="buynow02 bid-button-link" name="getbid.php?prid=<?php echo $auc["productID"]; ?>&aid=<?php echo $auc["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

                            <?php } ?>
                        </div>
                        <div class="clear"></div>
                        
                        <div class="retailvalue">
                            <span id="product_bidder_<?php echo $auc["auctionID"]; ?>">---</span><br/>
                            <?php echo RETAIL_VALUE; ?>: <?php echo $Currency; ?><span id="value_index_page_<?php echo $auc["auctionID"]; ?>"><?php echo $auc['price']; ?></span>
                        </div>
                        <div class="dpercent"><span id="off_retail_percent_<?php echo $auc["auctionID"]; ?>"><?php echo $retailpercent . '%'; ?></span> <?php echo OFF_RETAIL; ?></div>
                    </div>
               

                <?php
                        }
                    }
                    db_free_result($resflash);
                    
                  }
                ?>

            
            </div>
        </div>
    </div>
    <div id="smallbannerstatic">
        <a href="registration.php">
            <img src="img/sign.jpg" width="290" height="138" border="0" id="Image1" onmouseover="MM_swapImage('Image1','','img/sign2.jpg',1)" onmouseout="MM_swapImgRestore()" />
        </a>
    </div>
    <div id="smallbanner">
        <div class="scrollable">

            <!-- root element for the items -->

            <div class="items">
            <?php
            if($enable_html_slider_content == 'yes'){
                    $qr = "select a.fixedpriceauction, a.auc_fixed_price, a.offauction, a.auc_final_price, p.price, a.auctionID, p.picture1, r.username, p.name, a.use_free, a.buy_user,p.short_desc " .
                            "from auction a left join products p on a.productID=p.productID left join registration r on a.buy_user=r.id " .
                            "where a.auc_status=3 and auc_final_price > 0 and buy_user!='0' order by a.auc_final_end_date desc limit 0, 4";

                    $rswinner = db_query($qr);
                    while ($objwinner = db_fetch_array($rswinner)) {
                        if ($objwinner['fixedpriceauction'] == 1) {
                            $fprice1 = $objwinner['auc_fixed_price'];
                        } elseif ($objwinner['offauction'] == 1) {
                            $fprice1 = "0.00";
                        } else {
                            $fprice1 = $objwinner['auc_final_price'];
                        }
            ?>
                        <div>
                            <div class="smleft">
                                <img src="<?php echo $UploadImagePath; ?>products/<?php echo $objwinner["picture1"]; ?>" width="103" height="99" />
                            </div>
                            <div class="smright">
                                <span class="smheader"><?php echo htmlentities($objwinner['name']); ?></span><br />
                    <?php echo choose_short_desc(htmlentities($objwinner['short_desc']), 90); ?>.<br />
                        <br />
                        <a href="registration.php"><?php echo SIGN_UP_HOW_TO_SAVE_UP; ?> <?php echo round(($fprice1 * 100 / $objwinner['price'])*10)/10; ?>%</a>
                    </div>
                </div>
            <?php
                    }
                    db_free_result($rswinner);
                    
                    }
            ?>


        </div>
    </div>

	    </div>
	  
   	      
	
    <div class="clear"></div>
        <script type="text/javascript">
        
        
    $(document).ready(function() {
    $('#right_slider ul li').each(function(){
    
	$(this).click(function(){
	
	
	    window.location.href = $(this).attr('title');
	
	});
    
    
    });
    // OnloadPageSlider();
       $('.jshowoff').jshowoff({
        cssClass: 'thumbFeatures',
        effect:'fade',
        controls: true,
        hoverPause : false,
        links:true,
         <?php
        if(in_array('design_suite', $addons)){
        ?>
      pause:false
        <?php
        }
        ?>
        
        });
      
    });

    </script>
   
    <?php } else {
    
	  
    ?>
        <img src="img/banner-home.jpg" alt="" />
    <?php } ?>
    
   

<div class="shadow" style="display: block; clear: both; height: 35px"> </div>

    
   
