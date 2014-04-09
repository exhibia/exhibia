<?php
//To turn off html content change this to no
$enable_html_slider_content = 'no';
//To turn off auction content change this to no
$enable_auction_slider_content = 'no';

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
<div id="banner-area">

    <?php if (Sitesetting::enableFlashBanner() == true) {
    
 
        
?>
   <script src="<?php echo $SITE_URL;?>js/jquery.jshowoff.min.js" type="text/javascript"></script>     

<!-- PROM BANNERS -->
    
            <div id="slider_box" class="jshowoff" >
        
     
            
            
            <?php
        $imgpath = dir($BASE_DIR . '/include/addons/slider/' .$template . '/img');
        $a = 0;
        while (false !== ($entry = $imgpath->read())) 
		{
		
            if (is_file($imgpath->path . '/' . $entry)) {
                if (preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $entry)) {
                
                $a++;
                    echo '<div class="images"><img src="' . $SITE_URL . 'include/addons/slider/' . $template . '/img/' . $entry . '" /></div>';
                    
                }
            }
        }
        
              if($enable_html_slider_content == 'yes'){
         $res_sliders = db_query("select distinct(constant), value from languages where constant like 'SLIDER%' AND value != '' order by value desc");
 
	    while ($auc = db_fetch_array($res_sliders)) {
		  $a++;
		$auc['value'] = replaceText($auc['value']);
		  echo "<div id=\"$auc[constant]\" title=\"$a\" >" . $auc['value'] . "</div>";
  
	      }
	   }
		?>

               
                <?php
                if($enable_auction_slider_content == 'yes'){
                if ($co == '') {
                    $qryaucflash = "select a.auctionID, adt.auc_due_price, short_desc,price,adt.auc_due_time, p.name, p.picture1, p.productID from auction a " .
                            "left join products p on a.productID=p.productID left join auc_due_table adt on a.auctionID=adt.auction_id " .
                            "where a.auc_status='3' and a.uniqueauction='0' limit 0,4";
                } else {
                    $qryaucflash = "select a.auctionID,  adt.auc_due_price, short_desc,price,adt.auc_due_time, p.name, p.picture1, p.productID from auction a " .
                            "left join products p on a.productID=p.productID left join auc_due_table adt on a.auctionID=adt.auction_id " .
                            "where a.auctionID not in (" . $co . ")  and a.auc_status='3' and a.uniqueauction='0' limit 0,4";
                }

                $resflash = db_query($qryaucflash);
                if (db_num_rows($resflash)) {
         
                    while ($auc = db_fetch_array($resflash)) {
                    $a++;
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
		 <div title="<?php echo $a;?>" style="background-color:#fff;" class="dynamic_slider">
                            <div class="sliderLeft auction-item" title="<?php echo $auc["auctionID"]; ?>" id="auction_<?php echo $auc["auctionID"]; ?>" onclick="<?php echo $auc["auc_due_price"]; ?>">
                                 <?php if ($auc['uniqueauction'] == false) {
                            ?>

                                <a href="<?php echo SEOSupport::getProductUrl($auc["name"], $auc["auctionID"], 'n'); ?>" target="_top">
                                    <img class="prod_image" src="<?php echo $UploadImagePath; ?>products/<?php echo $auc["picture1"]; ?>" alt="" border="0" />
                                </a>
                            <?php } else {
                            ?>
                                <a href="<?php echo SEOSupport::getProductUrl($auc["name"], $auc["auctionID"], 'l'); ?>" target="_top">
                                    <img class="prod_image" src="<?php echo $UploadImagePath; ?>products/<?php echo $auc["picture1"]; ?>" alt="" border="0" />
                                </a>

                            <?php } ?>
                                
                            
                           
				<span class="sliderRight">                                
				    <h2><?php echo htmlentities($auc['name']); ?></h2>
				    <p><?php echo $auc['short_desc']; ?></p>
				    
					  <span class="bigbannerinfo">
					     
						  <span class="auctionprice"><?php echo AUCTION_PRICE; ?>:</span>

					      
					  </span>

					  <span class="bannerprice">
					      <span class="pricedetail">
						  <span id="currencysymbol_<?php echo $auc["auctionID"]; ?>"></span>
						  <span id="price_index_page_<?php echo $auc["auctionID"]; ?>">---</span>
					      </span><br />
					  </span>
					  
                                <div class="clear"></div>
                               
                                

                               <?php 
                               if($auction_sl_type  == 'live'){
				    if ($uid == 0) {
				    ?>
					<a id="image_main_<?php echo $auc["auctionID"]; ?>" class="buynow01 button bid-button-link" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>');" onmouseover="$(this).text('<?php echo LOGIN; ?>');"><?php echo PLACE_BID; ?></a>

				    <?php } else {
				    ?>
					<a id="image_main_<?php echo $auc["auctionID"]; ?>" class="buynow02 button bid-button-link" name="getbid.php?prid=<?php echo $auc["productID"]; ?>&aid=<?php echo $auc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onclick="$.post('getbid.php?prid=<?php echo $auc["productID"]; ?>&aid=<?php echo $auc["auctionID"]; ?>&uid=<?php echo $uid; ?>', function(response){});"><?php echo PLACE_BID; ?></a>

				    <?php } ?>
				<?php } ?>
				<div class="clear"></div>
				
				<div class="retailvalue">
				    
				    <?php echo RETAIL_VALUE; ?>: <?php echo $Currency; ?><span id="value_index_pag2e_<?php echo $auc["auctionID"]; ?>"><?php echo $auc['price']; ?></span>
				
				<div class="dpercent"><span id="off_retail_percent_<?php echo $auc["auctionID"]; ?>"><?php echo $retailpercent . '%'; ?></span> <?php echo OFF_RETAIL; ?></div>
				<span id="product_bidder_<?php echo $auc["auctionID"]; ?>" class="current-winner">---</span><br/>
				</div>
                                        <?php
                                                   if (Sitesetting::isEnableAvatar()) {

                                                       $avatarPath = $UploadImagePath . "avatars/default.png";

                                                       if ($obj['avatar'] != '') {
                                                           $tmppath = $UploadImagePath . "avatars/" . $auc["avatar"];
                                                           if (file_exists($tmppath)) {
                                                               $avatarPath = $tmppath;
                                                           }
                                                       }
                                        ?>				
	    
				<div style="text-align:center;" class="avatar"><img id="product_avatarimage_<?php echo $auc['auctionID']; ?>" alt="" src="<?php echo $avatarPath; ?>"/></div>
<?php } ?>
				</span>
			  </div>
			  
		    </div>
		
                <?php
                        }
                    }
                    db_free_result($resflash);
                    
                 }
                ?>

             
            
            
            </div>
      
        <script type="text/javascript">
        
        
    $(document).ready(function() {
      <?php
        if(in_array('design_suite', $addons)){
        $a = 1;
        
		          $res_sliders = db_query("select distinct(constant) from languages where constant like 'SLIDER%' AND value != '' order by id desc");
 
	    while ($auc = db_fetch_array($res_sliders)) {
	    ?>
	   
						   
	    
        <?php
        $a++;
        }
        }
        ?>
       $('.jshowoff').jshowoff({
        cssClass: 'thumbFeatures',
        effect:'none',
        controls: true,
        links:true,
         <?php
        if(in_array('design_suite', $addons)){
        ?>
      pause:true
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
    

    <div id="banner-help">
        <div class="help-links">
            <a style="cursor:pointer" onclick="javascript:showVideo()" id="banner_watch_video"></a>
            <a href="registration.php" id="banner_sign_up"></a>
        </div>
    </div>

</div>
