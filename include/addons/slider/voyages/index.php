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

      
    <?php if (Sitesetting::enableFlashBanner() == true) {
    
 
        
?>
<script src="<?php echo $SITE_URL;?>js/jquery.jshowoff.min.js" type="text/javascript"></script>     
<!-- PROM BANNERS -->
   
            <div id="slider_box">
            
            <div class="jshowoff" >
        
     
            
            
            <?php
        $imgpath = dir($BASE_DIR . '/include/addons/slider/' . $template . '/img/' . $entry );
        $a = 0;
        while (false !== ($entry = $imgpath->read())) 
		{
		
            if (is_file($imgpath->path . '/' . $entry)) {
                if (preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $entry)) {
                
                $a++;
                    echo '<div class="slider-images"><img src="' . $SITE_URL . '/include/addons/slider/' . $template . '/img/' . $entry . '" /></div>';
                    
                }
            }
        }
        
    ?>
 <?php
        
          if($enable_html_slider_content == 'yes'){
         $res_sliders = db_query("select distinct(constant), value from languages where constant like 'SLIDER%' AND value != '' order by value desc");
 
	    while ($auc = db_fetch_array($res_sliders)) {
		  $a++;
  
		  echo "<div id=\"$auc[constant]\" title=\"$a\" contenteditable=\"true\" class=\"editable\">" . $auc['value'] . "</div>";
  
	      }
	   }
	
	 if($enable_auction_slider_content == 'yes'){
	  
$qryaucflash = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,p.picture2,p.picture3,p.picture4,p.short_desc,p.categoryID, (select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
         (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a " .
        "left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join auc_due_table adt on a.auctionID=adt.auction_id " .
        " where adt.auc_due_time!=0 and a.auc_status='2' and a.bidpack=0 and a.seatauction='0' order by adt.auc_due_time limit 0, 4";
        
        
                $resflash = db_query($qryaucflash);
                if (db_num_rows($resflash)) {
         
                    while ($auc = db_fetch_array($resflash)) {
                   
                    $a++;
                   
                            
                            
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
                                                   if (Sitesetting::isEnableAvatar()) {

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
				<span class="slider-similar">
				<?php
				
				$cat = db_fetch_array(db_query("select * from categories where categoryID = $auc[categoryID]"));
				?>
				<span>
				See all <br />
				<a href="allauctions.php?id=<?php echo $cat['categoryID']; ?>"><?php echo $cat['name']; ?></a>
				<br />
				auctions
				</span>
				
				    <?php if ($uid == 0) {
				    ?>
					<a id="slider-image_main_<?php echo $auc["auctionID"]; ?>" class="buynow01 button bid-button-link" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo PLACE_BID; ?>');" onmouseover="$(this).text('<?php echo LOGIN; ?>');"><?php echo PLACE_BID; ?></a>

				    <?php } else {
				    ?>
					<a id="slider-image_main_<?php echo $auc["auctionID"]; ?>" class="buynow02 button bid-button-link" name="getbid.php?prid=<?php echo $auc["productID"]; ?>&aid=<?php echo $auc["auctionID"]; ?>&uid=<?php echo $uid; ?>" onclick="$.post('getbid.php?prid=<?php echo $auc["productID"]; ?>&aid=<?php echo $auc["auctionID"]; ?>&uid=<?php echo $uid; ?>', function(response){});"><?php echo PLACE_BID; ?></a>

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
    




    
   
