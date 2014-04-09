<?php


if($enable_html_slider_content != 'no'){
//To turn off html content change this to no
$enable_html_slider_content = 'no';
}

if($enable_auction_slider_content != 'no'){
//To turn off auction content change this to no
$enable_auction_slider_content = 'no';
}

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
    
            <div id="slider_box" class="jshowoff" style="display:none;" >
        
         
            
            
            <?php
        $imgpath = dir($BASE_DIR . '/uploads/banner');
        $a = 0;
        while (false !== ($entry = $imgpath->read())) 
		{
		
            if (is_file($imgpath->path . '/' . $entry)) {
                if (preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $entry)) {
                
                $a++;
                    echo '<div class="images"><img src="' . $SITE_URL . 'uploads/banner/' . $entry . '" /></div>';
                    
                }
            }
        }
        if($enable_html_slider_content == 'yes'){
         $res_sliders = db_query("select distinct(constant), value from languages where constant like 'SLIDER%' AND value != '' order by value desc");
 
	    while ($auc = db_fetch_array($res_sliders)) {
		  $a++;
  
		 echo "<div id=\"$auc[constant]\" title=\"$a\">" . replaceText(str_replace("`", "", $auc['value'])) . "</div>";
  
	      }
	
	}
	      
	      if($enable_auction_slider_content == 'yes'){
                if ($co == '') {
                    $qryaucflash = "select a.auctionID, adt.auc_due_price, short_desc,price,adt.auc_due_time, p.name, p.picture1, p.productID from auction a " .
                            "left join products p on a.productID=p.productID left join auc_due_table adt on a.auctionID=adt.auction_id " .
                            "where a.auc_status='2' and a.uniqueauction='0' order by adt.auc_due_time limit 0,4";
                } else {
                    $qryaucflash = "select a.auctionID,  adt.auc_due_price, short_desc,price,adt.auc_due_time, p.name, p.picture1, p.productID from auction a " .
                            "left join products p on a.productID=p.productID left join auc_due_table adt on a.auctionID=adt.auction_id " .
                            "where a.auctionID not in (" . $co . ")  and a.auc_status='2' and a.uniqueauction='0' order by adt.auc_due_time limit 0,4";
                }

                $resflash = db_query($qryaucflash);
                if (db_num_rows($resflash)) {
         
                    while ($auc = db_fetch_array($resflash)) {
                    $a++;
                    
                    //Commented out so that auction willl also show up in the results of the main page and the slider at the same time
                     /*   if ($co == '')
                            $co.=$auc["auctionID"];
                        else
                            $co.="," . $auc["auctionID"];*/
                            
                            
if(!empty($auc['price'])){
                        $retailpercent = round($auc['auc_due_price'] * 100 / $auc['price'], 2);
}else{

$retailpercent = 0;
}
                ?>
                         
                            <!--      First Slider Content          -->
		 <div class="slider-auctions">
                            <div class="sliderLeft auction-item-slider" title="<?php echo $auc["auctionID"]; ?>" id="auction_<?php echo $auc["auctionID"]; ?>" onclick="<?php echo $auc["auc_due_price"]; ?>">
                                 <?php if ($auc['uniqueauction'] == false) {
                            ?>

                                <a href="<?php echo SEOSupport::getProductUrl($auc["name"], $auc["auctionID"], 'n'); ?>" target="_top">
                                    <img src="<?php echo $UploadImagePath; ?>products/<?php echo $auc["picture1"]; ?>" alt="" width="240" border="0" />
                                </a>
                            <?php } else {
                            ?>
                                <a href="<?php echo SEOSupport::getProductUrl($auc["name"], $auc["auctionID"], 'l'); ?>" target="_top">
                                    <img src="<?php echo $UploadImagePath; ?>products/<?php echo $auc["picture1"]; ?>" alt="" width="240" border="0" />
                                </a>

                            <?php } ?>
                                
                            <div class="slider-product-thumbs">
                             <ul id="thumbs-product" style="list-style-type:none;list-style:none;" class="jcarousel-skin-tango">
                                    <li>
                                   
                                            <img style="width:70px;max-height:55px;height:auto;"  src="<?php echo $UploadImagePath; ?>products/thumbs/thumb_<?php echo $auc["picture1"]; ?>" />
                                       
                                    </li>
                                <?php if ($auc["picture2"] != "") {
                                ?>
                                        <li>
                                            
                                                <img style="width:70px;max-height:55px;height:auto;"  src="<?php echo $UploadImagePath; ?>products/thumbs/thumb_<?php echo $auc["picture2"]; ?>" />
                                          
                                        </li>
                                <?php } ?>
                                <?php if ($auc["picture3"] != "") {
                                ?>
                                        <li>
                                         
                                                <img style="width:70px;max-height:55px;height:auto;"  src="<?php echo $UploadImagePath; ?>products/thumbs/thumb_<?php echo $auc["picture3"]; ?>" />
                                            
                                        </li>
                                <?php } ?>

                                <?php if ($auc["picture4"] != "") {
                                ?>
                                        <li>
                                            
                                                <img style="width:70px;max-height:55px;height:auto;"  src="<?php echo $UploadImagePath; ?>products/thumbs/thumb_<?php echo $auc["picture4"]; ?>" />
                                           
                                        </li>
                                <?php } ?>
                           </ul>
                            
                            
                            </div>
                           
				<span class="sliderRight">                                
				    <h2><?php echo htmlentities($auc['name']); ?></h2>
				    <p><?php echo strip_tags(str_replace('<br>', '', $auc['short_desc'])); ?></p>
				    
					  <span class="bigbannerinfo">
					     
						  <span class="auctionprice"><?php echo AUCTION_PRICE; ?>:</span>

					      
					  </span>

					  <span class="bannerprice">
					      <span class="pricedetail">
						  <span id="slider-currencysymbol_<?php echo $auc["auctionID"]; ?>"></span>
						  <span id="slider-price_index_page_<?php echo $auc["auctionID"]; ?>">---</span>
					      </span><br />
					  </span>
					  
                                <div class="clear"></div>
                                <div class="timer01">
                                    <span class="timerbig" id="slider-counter_index_page_<?php echo $auc["auctionID"]; ?>">
                                        <script language='javascript' type='text/javascript'>
                                            document.getElementById('slider-counter_index_page_<?php echo $auc["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $auc["auc_due_time"]; ?>');
                                        </script>
                                    </span>
                                </div>
                                

                               
				
				<div class="clear"></div>
				
				<div class="retailvalue">
				    
				    <?php echo RETAIL_VALUE; ?>: <?php echo $Currency; ?><span id="slider-value_index_page_<?php echo $auc["auctionID"]; ?>"><?php echo $auc['price']; ?></span>
				
				<div class="dpercent"><span id="slider-off_retail_percent_<?php echo $auc["auctionID"]; ?>"><?php echo $retailpercent . '%'; ?></span> <?php echo OFF_RETAIL; ?></div>
				<span id="slider-product_bidder_<?php echo $auc["auctionID"]; ?>" class="current-winner">---</span><br/>
				</div>
                                        <?php
                                                   if (Sitesetting::isEnableAvatar() == true) {

                                                       $avatarPath = $UploadImagePath . "avatars/default.png";

                                                       if ($auc['avatar'] != '') {
                                                           $tmppath = $UploadImagePath . "avatars/" . $auc["avatar"];
                                                           if (file_exists($tmppath)) {
                                                               $avatarPath = $tmppath;
                                                           }
                                                       }
                                        ?>				
	    
				<div style="text-align:center;" class="avatar"><img id="slider-product_avatarimage_<?php echo $auc['auctionID']; ?>" alt="" src="<?php echo $avatarPath; ?>"/></div>
<?php } ?>
				</span>
				
				
				    <?php if ($uid == 0) {
				    ?>
					<a id="slider-image_main_<?php echo $auc["auctionID"]; ?>" class="buynow01 buttons bid-button-link" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>');" onmouseover="$(this).text('<?php echo LOGIN; ?>');"><?php echo PLACE_BID; ?></a>

				    <?php } else {
				    ?>
					<a id="slider-image_main_<?php echo $auc["auctionID"]; ?>" class="buynow02 buttons bid-button-link" name="getbid.php?prid=<?php echo $auc["productID"]; ?>&aid=<?php echo $auc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onclick="$.post('getbid.php?prid=<?php echo $auc["productID"]; ?>&aid=<?php echo $auc["auctionID"]; ?>&uid=<?php echo $uid; ?>', function(response){});"><?php echo PLACE_BID; ?></a>

				    <?php } ?>
				</span>
			  </div>
			  
		    </div>
		
                <?php
                        }
                    }
                    db_free_result($resflash);
                    
                    }
                    echo db_error();
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
        pause:true
         <?php
         $sl_qry = db_query("select * from sitesetting where name = 'slider_settings' and value not like 'slider%' and value not like 'color:%' and value not like 'buttonset%'");
         
         while($sl_row = db_fetch_array($sl_qry)){
	    $effect = explode(":", $sl_row['value']);
	    if($effect[0] != 'links' & $effect[0] != 'controls'){
		echo ",\n" . $effect[0] . ": " . $effect[1];
	    }else{
	    
		if($effect[1] != 'false'){
		    echo ",\n" . $effect[0] . ": true";
		}else{
		    echo ",\n" . $effect[0] . ": false";
		}
	    }
	  
         }
        if(in_array('design_suite', $addons)){
        ?>
      
        <?php
        }
        ?>
        
        });
        <?php if($slider_settings['links'] == 'bullets' | $slider_settings['links'] == 'buttons'){
        ?>
        $('p.jshowoff-slidelinks a').text() = '';
        <?php } ?>
      
    });

    </script>
   
    <?php } else {
    
	  
    ?>
        <img src="img/banner-home.jpg" alt="" />
    <?php } ?>
    
  
   <script>
   $(document).ready(function(){
      $('#slider_box').css('display', 'block');
    });
    </script>
