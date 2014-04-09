<style>
#bid-information {
  clear: both;
  float: right;
  margin: 90px 0 0;
  width: 287px;
}
#bid-information h3 {
  background-image:url('');
  background-color:#0E76BD!important;
  color: #FFFFFF;
  padding:5px 0 2px 0px;
  font-size:14px;
  height: 30px;
  margin: 0 auto;
  text-align: center;
  text-shadow: 0px 0px transparent;
  line-height:30px;
  text-transform: uppercase;
  width: 287px;
  border-radius:10px 10px 0 0;
}
.funders_percent {
  color: #080904;
  float: right;
  font-size: 32px;
  font-weight: bold;
  margin-right: 20px;
  position: relative;
  top: -35px;
}
.blue_star {
  float: left;
  left: 240px;
  position: relative;
  top: -38px;
}
.escroe_data {
  height: 80px;
  margin: 0 0 20px 0;
}
.funders span {
  color: #000000;
  font-size: 16px;
}
.funders {
  color: #56A5C4;
  float: left;
  font-size: 16px;
  font-weight: bold;
  left: 10px;
  position: relative;
  top: 12px;
}
.funders_bar {
  background: none repeat scroll 0 0 #ACE0F8;
  border-radius: 4px!important;
  display: block;
  height: 20px;
  position: relative;
  text-align: left;
  top: 49px;
  width: 251px;
}
</style>
<?php

$prid = isset($_REQUEST["pid"]) ? chkInput($_REQUEST["pid"], 'i') : 0; // never to use



if (isset($_REQUEST["aid"])) {
    $aucid = $_REQUEST["aid"];

    $aucid = $aucid == 0 ? 1 : $aucid;
} else {

    $aucid = 1;

    header("location: index.php");
}



$uid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : 0;

switch(basename($_SERVER['PHP_SELF'])){

case('viewproduct.php'):
$qrysel = "select shippingcharge,auc_plus_price, username,avatar,adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,am.picture as auctypepic,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,lockauction,cashauction,reserve,locktype,lockprice,locktime,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,picture2,picture3,picture4,short_desc,long_desc,a.escroe,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " .
        "from auction a left join products p on p.productID=a.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
        "left join auc_due_table adt on a.auctionID=adt.auction_id left join registration r on a.buy_user=r.id " .
        "left join shipping sp on a.shipping_id=sp.id " .
        "left join avatar av on av.id=r.avatarid " .
        "left join auction_management am on am.auc_manage=a.time_duration where a.auctionID=$aucid";
break;
case('viewproduct_lowest.php'):

$qrysel = "select shippingcharge,auc_plus_price, username,avatar,adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,am.picture as auctypepic,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,lockauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_banner2,bidpack_banner3,bidpack_banner4,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,picture2,picture3,picture4,short_desc,long_desc,a.escroe, " .
        "(select count(*) from unique_bid u where u.auctionid=a.auctionID) as lowbidcount,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount  " .
        "from auction a left join products p on p.productID=a.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
        "left join auc_due_table adt on a.auctionID=adt.auction_id left join registration r on a.buy_user=r.id " .
        "left join shipping sp on a.shipping_id=sp.id " .
        "left join avatar av on av.id=r.avatarid " .
        "left join auction_management am on am.auc_manage=a.time_duration where a.auctionID=$aucid";

break;
}
$ressel = db_query($qrysel);
if (db_num_rows($ressel) <= 0) {
    header("location:{$SITE_URL}index.php");
}
$obj = db_fetch_array($ressel);

db_free_result($ressel);


//
$onlineperbidvalue = Sitesetting::getBidPrice();

//the price - bid times
$aucdb = new Auction(null);
$buynowprice = $aucdb->getBuynowPrice($uid, $aucid);

if ($uid <> 0) {
    $reswatch = db_query("select count(*) from watchlist where auc_id=$aucid and user_id=$uid");

    if (db_num_rows($reswatch) > 0) {

        $totalwatch = db_result($reswatch, 0);

        //$totalwatch = $totalwatch !== FALSE ? 0 : $totalwatch;
    } else {

        $totalwatch = 0;
    }

    db_free_result($reswatch);
} else {

    $totalwatch = 0;
}



$resregmsg = db_query("select reg_message from general_setting where id=4");

$regmsg = db_num_rows($resregmsg) > 0 ? db_result($resregmsg, 0) : FALSE;

db_free_result($resregmsg);

?>
<?php //include("$BASE_DIR/include/topmenu.php"); ?>
                <div id="title-category-content">
  <?php //include("$BASE_DIR/include/categorymenu.php"); ?>
		</div>
                    
                <!-- /title-category-content -->

  <?php //include("$BASE_DIR/include/addons/auction_boxes/pas/top_auctions/index.php"); ?>
  <?php include("$BASE_DIR/include/addons/auction_boxes/pas/auction_description/index.php"); ?>

  





<!--	  <?php if(in_array('maps', $addons)) { include('include/addons/maps/googlemap.php'); } ?>                                                                                                       -->
<!--          <div class="custom_box_content" id="custom_box_content_13" contenteditable="true"  title="13"><?php $content = 13; include("$BASE_DIR/include/addons/custom_content/get_content.php"); ?></div>      -->
              
                <!-- Begin Main Auction -->
                        <div id="bid-information">
 <?php include("$BASE_DIR/include/addons/pas/auction_descriptions/index.php"); ?> 
 


                    <?
                                if (( $obj["auc_status"] == 1 || $obj["auc_status"] == 2 ) && $uid <> 0) {
                                    if ($obj["auc_status"] == 1 || $obj["auc_status"] == 2) {
                                        if ($uid <> 0 && $totalwatch == 0) {
                    ?>
                                            <h3 id="notadded_watchlist" ><a style="cursor:pointer;" onclick="addWatchlist('<?= $aucid; ?>','<?= $uid; ?>')" ><?php echo ADD_AUCTION_TO_WATCHLIST; ?></a></h3>
                                            <h3 style="display:none;" id="added_watchlist"><a><?php echo ADD_AUCTION_TO_WATCHLIST; ?></a></h3>
                    <?php } elseif ($uid <> 0) {
                    ?>
                                            <h3 id="added_watchlist"><a><?php echo ADD_AUCTION_TO_WATCHLIST; ?></a></h3>
                    <?
                                        }
                                    }
                                } else {
                    ?>
                                    <h3 id="added_watchlist"><a><?php echo ADD_AUCTION_TO_WATCHLIST; ?></a></h3>
                    <?php } ?>

                                <div class="tabBox">
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            $(".tabheader").click(function(){
                                                var rel=$(this).attr("rel");
                                                rels=rel.split("|");
                                                if(rels.length>1){
                                                    $("#"+rels[1]).hide();
                                                    $("#"+rels[0]).show();
                                                    $(this).parent().parent().children("li").removeClass("current");
                                                    $(this).parent("li").addClass("current");
                                                }
                                            });
                                        });
                                    </script>

                                    <div id="bidtab">

                                        <ul>
                                            <li class="current"><a rel="tab_history<?= $uid <> 0 && $obj["auc_status"] == 2 ? '|tab_mybid' : ''; ?>" class="tabheader"><?php echo BID_HISTORY; ?></a></li>
                                <?php
                                if ($uid <> 0 && $obj["auc_status"] == 2) {
                                ?>
                                    <li><a class="tabheader" rel="tab_mybid|tab_history"><?php echo MY_BIDS; ?></a></li>
                                <?php } ?>
                            </ul>
                            <div id="tab_history" class="tab-content">
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th><?php echo BID; ?></th>
                                            <th><?php echo BIDDER; ?></th>
                                            <th><?php echo TYPE; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $qryhis = "select bidding_price, username, bidding_type from " . ($obj["use_free"] == 1 ? "free" : "bid") . "_account ba " . "left join registration r on ba.user_id=r.id where ba.auction_id=$aucid and ba.bid_flag='d' order by ba.id desc limit 0, 5";
                                        $reshis = db_query($qryhis);
                                        $totalhis = db_num_rows($reshis);
                                        $q = 0;
                                        for ($j = 1, $q = 0; $j <= 5; $j++, $q++) {
                                            $objhis = db_fetch_object($reshis);
                                        ?>
                                            <tr>
                                                <td id="bid_price_<?= $q; ?>"></td>
                                                <td id="bid_user_name_<?= $q; ?>">
                                                <?php
                                                if ($objhis->username != "")
                                                    echo $objhis->username;
                                                if ($objhis->bidding_price != "" && $objhis->username == "")
                                                    echo USER_REMOVED;
                                                ?>
                                            </td>
                                            <td id="bid_type_<?= $q; ?>">
                                                <?php
                                                if ($objhis->bidding_type == 's')
                                                    echo SINGLE_BID;
                                                if ($objhis->bidding_type == 'b')
                                                    echo AUTOBIDDER;
                                                if ($objhis->bidding_type == 'm')
                                                    echo SMS_BID;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                            db_free_result($reshis);
                                        ?>
                                        </tbody>
                                    </table>
                                </div><!-- /tab-content -->
                                <div id="tab_mybid" class="tab-content hide">
                                <?php
                                            if ($uid <> 0 && $obj["auc_status"] == 2) {
                                ?>
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo BID; ?></th>
                                                            <th><?php echo BIDDER; ?></th>
                                                            <th><?php echo TYPE; ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                        <?php
                                                $qryhis1 = "select bidding_price, username, bidding_type from " . ($obj["use_free"] == 1 ? "free" : "bid") . "_account ba " . "left join registration r on ba.user_id=r.id " . "where ba.auction_id=$aucid and ba.bid_flag='d' and ba.user_id=$uid order by ba.id desc limit 0, 5";
                                                $reshis1 = db_query($qryhis1);
                                                $totalhisl = db_num_rows($reshis1);
                                                for ($k = 1, $r = 0; $k <= 5; $k++, $r++) {
                                                    $objhis1 = db_fetch_object($reshis1);
                                        ?>
                                                    <tr>
                                                        <td id="my_bid_price_<?= $r; ?>"><?= ($objhis1->bidding_price != "" ? $Currency . number_format($objhis1->bidding_price, 2) : "&nbsp;"); ?></td>
                                                        <td id="my_bid_time_<?= $r; ?>">
                                                <?php
                                                    if ($objhis1->username != "")
                                                        echo $objhis1->username;
                                                    if ($objhis1->bidding_price != "" && $objhis1->username == "")
                                                        echo USER_REMOVED;
                                                ?>
                                                </td>
                                                <td id="my_bid_type_<?= $r;
                                                ?>">
                                                    <?php
                                                    if ($objhis1->bidding_type == 's')
                                                        echo SINGLE_BID;
                                                    if ($objhis1->bidding_type == 'b')
                                                        echo AUTOBIDDER;
                                                    if ($objhis1->bidding_type == 'm')
                                                        echo SMS_BID;
                                                    ?>
                                            </td>
                                        </tr>
                                        <?
                                                }
                                                db_free_result($reshis1);
                                        ?>
                                            </tbody>
                                        </table>
                                <?php } ?>
                                        </div><!-- /tab-content -->
                                    </div><!-- tab1-->

					  <?php
                                            if ($uid == 0) {
					    ?>
                                                <a class="register-button"  onclick="window.location.href='register.php'"></a>


					  <?php
                                            } else {
                                                if ($obj["auc_status"] == 2 || $obj["auc_status"] == 1) {
					  ?>
                                                    <div id="autobider">
                                                        <ul>
                                                            <li class="current"><a class="tabheader" rel="bookautobidder<?= $obj["nailbiterauction"] == 0 ? "|myautobidder" : "";?>"><?php echo BOOK_AUTOBIDDER; ?></a></li>
						    <?php if ($obj["nailbiterauction"] == 0) {  ?>
                                                       <li><a class="tabheader" rel="myautobidder|bookautobidder"><?php echo MY_AUTOBIDDER; ?></a></li>
						    <?php } ?>
                                                   </ul>
                                                   <div id="bookautobidder" class="tab-content">
                                                       <form name="bidbutler" action="" method="post">
                                                           <table border="0" cellspacing="0" cellpadding="0">
                                                               <thead>
                                                                   <tr>
                                                                       <th><?php echo BID_FROM; ?></th>
                                                                       <th><?php echo BID_TO; ?></th>
                                                                       <th><?php echo BIDS; ?></th>
                                                                   </tr>
                                                               </thead>
                                                               <tbody>
							  <?php if ($obj["nailbiterauction"] == 0) { ?>
                                                           <tr>
                                                               <td>
								<?php echo $Currency; ?> <input type="text" name="bidbutstartprice" value="" id="bid_form" />
							      </td>
							      <td>
								<?php echo $Currency; ?> <input type="text" name="bidbutendprice" value="" id="bid_to" />
							      </td>

							      <td>
								<input type="text" name="totalbids" value="" id="bid_bids" />
								<input type="hidden" name="isreverseauction" id="isreverseauction" value="<?php echo $obj['reverseauction']; ?>"/>
							      </td>
							  </tr>
							  <?php } else { ?>
                                                           <tr>
                                                               <td colspan="3" align="center"><?php echo THIS_AUCTION_IS_NAILBITER_AUCTION; ?><br /><?php echo YOU_CANT_PLACE_AUTOBIDDER; ?></td>
                                                           </tr>
							  <?php } ?>
                                                   </tbody>
                                               </table>
                                               <p>
                                                   <a id="bookbidbutlerbutton" name="<?= $aucid; ?>" title="Book" class="button bookbidbutlerbutton"><?php echo BOOK; ?></a>
                                                   <a href="help.php?pt=1" title="Auction Tips" class="alert"><?php echo AUCTION_TIPS; ?></a>
                                                   <span id="butlermessage" style="display: none;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo AUTOBIDDER_ADDED; ?></strong></span>
                                               </p>
                                           </form>
                                       </div><!-- /tab-content -->

                                       <div id="myautobidder" class="tab-content hide">
                                <?php if ($obj["nailbiterauction"] == 0) {
                                ?>
                                                           <table border="0" cellspacing="0" cellpadding="0">
                                                               <thead>
                                                                   <tr>
                                                                       <th><?php echo BID_FROM; ?></th>
                                                                       <th><?php echo BID_TO; ?></th>
                                                                       <th><?php echo BIDS; ?></th>
                                                                       <th></th>
                                                                   </tr>
                                                               </thead>
                                                               <tbody>
                                        <?
                                                           $qrbutler = "select butler_start_price, butler_end_price, butler_bid,used_bids, id from bidbutler " . "where auc_id=$aucid and user_id=$uid and butler_status=0 order by id desc";
                                                           $rsbutler = db_query($qrbutler);
                                                           $totalbutler = db_num_rows($rsbutler);
                                                           if ($totalbutler > 0) {
                                                               for ($i = 1, $q = 1; $i <= 20; $i++, $q++) {
                                                                   $objbutler = db_fetch_object($rsbutler);
                                                                   $bids = $objbutler->butler_bid - $objbutler->used_bids;
                                        ?>
                                                                   <tr id="mainbutlerbody_<?= $i; ?>" <?= ($i > $totalbutler ? "style=\"display: none;\"" : ""); ?>>
                                                                       <td id="butlerstartprice_<?= $q; ?>"><?= ($objbutler->butler_start_price != "" ? $Currency . number_format($objbutler->butler_start_price, 2) : ""); ?></td>
                                                                       <td id="butlerendprice_<?= $q ?>"><?= ($objbutler->butler_end_price != "" ? $Currency . number_format($objbutler->butler_end_price, 2) : ""); ?></td>
                                                                       <td id="butlerbids_<?= $q; ?>"><?= $bids; ?></td>
                                                                       <td align="center">
                                                <?php if ($objbutler->butler_start_price != "") {
                                                ?>
                                                                       <span id="deletebidbutler_<?= $q; ?>">
                                                                           <img src="<?php echo $SITE_URL;?>img/buttons/btn_closezoom.png" style="cursor: pointer;" onclick="DeleteBidButler('<?= $objbutler->id ?>','<?= $q ?>');" id="butler_image_<?= $q; ?>" />
                                                                       </span>
                                                <?php } else {
                                                ?>
                                                                       <span id="deletebidbutler_<?= $q; ?>" style="display: none;"><img src="<?php echo $SITE_URL;?>img/buttons/btn_closezoom.png" style="cursor: pointer;" onclick="DeleteBidButler('<?= $objbutler->id ?>','<?= $q ?>');" id="butler_image_<?= $q; ?>"  />
                                                                       </span>
                                                <?php } ?>
                                                               </td>
                                                           </tr>
                                        <?php } ?>
                                                               <tr style="display:none;" id="live_no_bidbutler">
                                                                   <td colspan="4"><strong><?php echo NO_ACTIVE_AUTOBIDDERS; ?></strong></td>
                                                               </tr>
                                        <?
                                                           } else {
                                                               for ($i = 1; $i <= 20; $i++) {
                                        ?>
                                                                   <tr id="mainbutlerbody_<?= $i;
                                        ?>" <?= ($i > 3 ? "style=\"display: none;\"" : ""); ?>>
                                                                   <td id="butlerstartprice_<?= $i; ?>"></td>
                                                                   <td id="butlerendprice_<?= $i ?>"></td>
                                                                   <td id="butlerbids_<?= $i;
                                        ?>"></td>
                                                               <td><span id="deletebidbutler_<?= $i;
                                        ?>" style="display: none;"><img src="images/btn_closezoom.png" style="cursor: pointer;" onclick="" id="butler_image_<?= $i;
                                        ?>" /></span></td>
                                        </tr>
                                        <?php } ?><!--end for-->
                                                               <tr style="display:table-row;" id="live_no_bidbutler">
                                                                   <td colspan="4"><strong><?php echo NO_ACTIVE_AUTOBIDDERS; ?></strong></td>
                                                               </tr>
                                        <?
                                                           }
                                                           db_free_result($rsbutler);
                                        ?>
                                                       </tbody>
                                                   </table>
                                <?php } ?>
                                                   </div><!-- /tab-content -->

                                               </div><!--end auto bider-->

                        <?
                                                   }
                                               }
                        ?>
                                           </div><!-- /tabBox -->
                                       </div><!-- /bid-information -->

                <?php
                                               $pname = $obj['bidpack'] ? $obj['bidpack_name'] : $obj['name'];
                                               $picture = $obj['bidpack'] ? $obj['bidpack_banner'] : $obj['picture1'];
                                               $picture2 = $obj['bidpack'] ? $obj['bidpack_banner2'] : $obj['picture2'];
                                               $picture3 = $obj['bidpack'] ? $obj['bidpack_banner3'] : $obj['picture3'];
                                               $picture4 = $obj['bidpack'] ? $obj['bidpack_banner4'] : $obj['picture4'];
                                               $price = $obj['bidpack'] ? $obj['bidpack_price'] : $obj['price'];
                                               $short_desc = $obj['bidpack'] ? "{$obj['bid_size']} Bids and {$obj['freebids']} Freebids" : $obj['short_desc'];
                                               $long_desc = $obj['bidpack'] ? $short_desc : $obj['long_desc'];
                ?>

                                               <div id="product-details">
                                                   <p class="auctions-id"><?php echo AUCTION_ID; ?>: <span id="history_auctionid"><?= $aucid; ?></span></p>
                                               <h2 id="pr_name_<?php echo $obj['productID'];?>">
						      <?php echo $pname; ?>

						  </h2>
						
                                          
                                          
                                          
                                          <p class="description" id="pr_short_desc_<?php echo $obj['productID']; ?>" ><?php echo str_replace("<br />", "", $short_desc); ?></p>
                                            
                                           <div class="clear"></div>
                                           <div id="product-gallery">
                                               <div class="main-product">
                            <?php
                                               $cornerImag = cornerImag($obj);

                                               $seatauction = $obj['seatauction'];
                                               if ($seatauction == true && $obj['seatcount'] >= $obj['minseats']) {
                                                   $seatauction = false;
                                               }
                            ?>
                            <?php if ($cornerImag != '') {
                            ?>
                                                   <div class="corner_imagev_detail">
                                                       <img src="<?php echo $SITE_URL;?>css/<?php echo $template;?>/icons/<?php echo $cornerImag; ?>"  alt=""/>
                                                   </div>
                            <?php } ?>
                                               <div id="mainimage1">
                                <?php if ($picture != "") {
                                ?>
                                                   <img alt="" src="<?= $UploadImagePath; ?>products/<?= $picture; ?>"/>
                                <?php } ?>
                                           </div>

                                           <div id="mainimage2" style="display: none;">
                                <?php if ($picture2 != "") {
                                ?>
                                                   <img alt=""  src="<?= $UploadImagePath; ?>products/<?= $picture2; ?>"/>
                                <?php } ?>
                                           </div>

                                           <div id="mainimage3" style="display: none;">
                                <?php if ($picture3 != "") {
                                ?>
                                                   <img alt=""  src="<?= $UploadImagePath; ?>products/<?= $picture3; ?>"/>
                                <?php } ?>
                                           </div>
                                           <div id="mainimage4" style="display: none;">
                                <?php if ($picture4 != "") {
                                ?>
                                                   <img alt="" src="<?= $UploadImagePath; ?>products/<?= $picture4; ?>"/>
                                <?php } ?>
                                           </div>

                                       </div><!-- /main-product -->
                                       <div class="product-small">
                                           <span onclick="changeimage(1);" id="otherimageprd_1" style="cursor: pointer;">
                                               <img src="<?= $UploadImagePath; ?>products/<?= $picture; ?>" alt="product" border="0" />
                                           </span>
                                       </div><!-- /product-small -->
                        <?php if ($picture2 != "") {
                        ?>
                                                   <div class="product-small">
                                                       <span onclick="changeimage(2);" id="otherimageprd_2" style="cursor: pointer;"><img src="<?= $UploadImagePath; ?>products/<?= $picture2; ?>" alt="product" border="0" /></span>
                                                   </div><!-- /product-small -->
                        <?php } ?>

                        <?php if ($picture3 != "") {
                        ?>
                                                   <div class="product-small">
                                                       <span onclick="changeimage(3);" id="otherimageprd_3" style="cursor: pointer;"><img src="<?= $UploadImagePath; ?>products/<?= $picture3; ?>" alt="product" border="0" /></span>
                                                   </div><!-- /product-small -->
                        <?php } ?>

                        <?php if ($picture4 != "") {
                        ?>
                                                   <div class="product-small">
                                                       <span onclick="changeimage(4);" id="otherimageprd_4" style="cursor: pointer;"><img src="<?= $UploadImagePath; ?>products/<?= $picture4; ?>" alt="product" border="0" /></span>
                                                   </div><!-- /product-small -->
                        <?php } ?>

                                           </div><!-- /product-gallery -->
				
                                           <div id="product-information">

					      <?php
                                               if ($obj["auc_status"] == 2) { //begin auction box
                                                   $add .= "," . $obj["auctionID"];
					      ?>
                                                   <div class="product-box auction-item" title="<?= $obj["auctionID"]; ?>" id="auction_<?= $obj["auctionID"]; ?>">
                                                       <div class="product-content">

                                                           <p class="pricebox">
                                                              
                                
                                               </p>

					      <?php if ($uid == 0) { 
						      if($obj['escroe'] == 1){ ?>
						       <a id="image_main_<?php echo $obj["auctionID"]; ?>" rel="<?php echo $obj["auctionID"]; ?>" class="button ubid-button-link" name="getuniquebid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo 'FUND'; ?></a>
					       <?php }else{ ?>
						     
                                                       <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="gradient button" onclick="window.location.href='<?php echo $SITE_URL; ?>login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>

					      <?php 
						  }
					      
					      } else { ?>
						      <?php if ($seatauction == true) { ?>
                                                           <div id="seat_button_<?php echo $obj["auctionID"]; ?>">
                                                               <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button butseat-button-link" name="getseat.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>
                                                           </div>
						<?php } ?>

                                                       <div id="normal_button_<?php echo $obj["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
							    <?php if ($obj['uniqueauction'] == false) { ?>
							      <?php if($obj['escroe'] != 1){ ?>
								    <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button bid-button-link" name="getbid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>
							      <?php }else{ ?>
								     <a id="image_main_<?php echo $obj["auctionID"]; ?>" href="javascript:;" onclick="add_funds('add_funds.php?uid=<?php echo $_SESSION['userid'];?>&aid=<?php echo $obj["auctionID"]; ?>');" class="button_fund bid-button-link" ><?php echo 'FUND'; ?></a>
							      
							      <?php } ?>
							    <?php } else { ?>
								<?php if($obj['escroe'] != 1){ ?>
								    <a id="image_main_<?php echo $obj["auctionID"]; ?>" rel="<?php echo $obj["auctionID"]; ?>" class="button ubid-button-link" name="getuniquebid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>
								<?php }else{ ?>
								    <a id="image_main_<?php echo $obj["auctionID"]; ?>" href="javascript:;" onclick="add_funds('add_funds.php?uid=<?php echo $_SESSION['userid'];?>&aid=<?php echo $obj["auctionID"]; ?>');" class="button_fund ubid-button-link" ><?php echo 'FUND'; ?></a>
							      
								<?php } ?>
							    <?php } ?>
						      </div>

                                <?php } ?>
				<?php if($obj['escroe'] != 1){ ?>
                                                   <p class="timebox">
                                    <?php if ($obj['auctypepic'] != '') {
                                    ?>
                                                       <span class="auction_type_picture">
                                                           <img alt="" src="<?php echo "{$UploadImagePath}aucflag/" . $obj['auctypepic']; ?>"/>
                                                       </span>
                                    <?php } ?>
				     
                                                   <span id="counter_index_page_<?= $obj["auctionID"]; ?>">
                                                       <script language="javascript">document.getElementById('counter_index_page_<?= $obj["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?= $obj["auc_due_time"]; ?>');</script>
                                                   </span>
                                                </p>
                                     <?php }else{ ?>
					  <div class="escroe_data">
					      <span class="pin_icon blue_star" id="watch_<?php echo $obj["auctionID"]; ?>">
						<img  src="img/blue_star.png" />
					      </span>
					      <span id="funders_<?php echo $obj["auctionID"]; ?>" class="funders">
						  <span id="funders_count_<?php echo $obj["auctionID"]; ?>">0</span> backers
					      </span>
					      <span id="funders_percent_<?php echo $obj["auctionID"]; ?>" class="funders_percent">0%</span>
					      <span id="funders_bar_<?php echo $obj["auctionID"]; ?>" class="funders_bar"><span></span></span>
					  </div>
                                     
                                     <?php } ?>
                                              

				      <?php if ($seatauction) {
							    ?>
                                                       <div class="seat_panel" id="seat_panel_<?php echo $obj["auctionID"]; ?>">
                                                           <div class="seat_bar" id="seat_bar_<?php echo $obj["auctionID"]; ?>">
                                                           </div>

                                                           <div class="seat_count">
                                                               <span id="seat_count_<?php echo $obj["auctionID"]; ?>">-</span>/<span><?php echo $obj['minseats']; ?></span>
                                                           </div>
                                                           <div class="seat_text1"><?php echo SEATS_AVAILABLE; ?></div>
                                                           <div class="seat_text2">
							  <?php echo SEAT_AUCTION_DESCRIPTION; ?>
                                                   </div>
                                                   <div class="seat_text3">
							<?php echo FROM_W; ?>:<span><?php echo $Currency . $obj['auc_start_price'] ?></span>&nbsp;&nbsp;
							<?php echo SEAT_BIDS; ?>:<span><?php echo $obj['seatbids'] ?></span>
                                                   </div>
                                               </div>

				  <?php } ?>
                                                   <div id="normal_panel_<?php echo $obj["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                                       <p id="blink_img_<?php echo $obj["auctionID"]; ?>" style="text-align:center;display:none;">
                                                           <img alt="" src="img/blink.gif"/>
                                                       </p>
                                                       <p class="winner">
                                        <?php
                                                   if (Sitesetting::isEnableAvatar()) {

                                                       $avatarPath = $UploadImagePath . "avatars/default.png";

                                                       if ($obj['avatar'] != '') {
                                                           $tmppath = $UploadImagePath . "avatars/" . $obj["avatar"];
                                                           if (file_exists($tmppath)) {
                                                               $avatarPath = $tmppath;
                                                           }
                                                       }
                                        ?>

                                                       <div style="text-align:center;min-height:50px;"><img id="product_avatarimage_<?php echo $obj['auctionID']; ?>" alt="" src="<?php echo $avatarPath; ?>"/></div>
					<?php } ?>
                                                   <div style="text-align:center;padding-top: 5px;">
                                                       <strong><?php echo BIDDER; ?>:</strong>
                                                       <span id="product_bidder_<?= $obj["auctionID"]; ?>">---</span>
                                                   </div>
                                               </p>

                                               <p>
                                                   <small>
						      <?php echo WITH_EACH_BID_PRICE_WILL; ?> <?php echo ($obj['reverseauction'] == true ? DECREASE : INCREASE) . BY; ?>  <?php echo ($obj["pennyauction"] == "1" ? $Currency . "0.00" : $Currency . $obj["auc_plus_price"]); ?>
                                               </small>
                                           </p>
                                           <p><small>
                                            <?php echo THIS_AUCTION_WILL_END_LATEST_ON; ?><?= enddatefunction($obj["auc_end_date"]); ?> at <?= $obj["auc_end_time"]; ?>
					    <?php if ($obj['lockauction'] == true) { ?>
                                                       <br/><?php printf(AUCTION_WILLBE_LOCKED, ($obj['locktype'] == 1 ? 'time' : 'price'), ($obj['locktype'] == 1 ? secondToTimer($obj['locktime']) : $Currency . $obj['lockprice'])); ?>
					    <?php } ?>
                                               </small></p>

                                       </div>
                                   </div><!-- /product-content -->
                               </div><!-- /product-box -->
			
                        <?php if ($uid <> 0) { ?>
                                                       <div class="product-box">
                                                           <div class="product-content">
                                                               <h3 class="savings"><?php echo SAVINGS; ?></h3>
                                                               <ul style="max-height:50px;">
                                                                   <li><span><?php echo WORTH_UP_TO; ?>:</span> <em><?= $Currency . $price; ?></em></li>
                                    <?
									if ($uid <> 0) {
									    $resbid = db_query("select sum(bid_count) from bid_account where bid_flag='d' and auction_id=$aucid and user_id=$uid group by auction_id");
									    if (db_num_rows($resbid) > 0) {
										$totbid = db_result($resbid, 0);
										$totbidprice = $totbid * $onlineperbidvalue;
									    } else {
										$totbid = 0;
										$totbidprice = 0;
									    }
									    db_free_result($resbid);
									    $price = $price;
									    if ($obj["fixedpriceauction"] == "1") {
										$fprice = $obj["auc_fixed_price"];
									    } elseif ($obj["offauction"] == "1") {
										$fprice = "0.00";
									    } else {
										$fprice = $obj["auc_due_price"];
									    }
                                    ?>

								  <li>
                                                               <span>
							<input type="hidden" id="onlineperbidvalue_text" value="<?php echo $onlineperbidvalue; ?>"/>
                                                       <input type="hidden" id="price_text" value="<?php echo $price; ?>"/>
                                                       <input type="hidden" id="fprice_text" value="<?php echo $fprice; ?>"/>
                                                       <input type="hidden" id="aucid_text" value="<?php echo $obj["auctionID"]; ?>"/>
                                                   </li>
                                    <?php } ?>
                                                       <li style="position:relative;top:-25px;"><span><?php echo AUCTION_PRICE; ?>:</span> <em id="product_auctionprice"><?= $Currency . $fprice; ?></em></li>
                                                   </ul>

                                                   <p class="result">
                                                       <span><?php echo SAVINGS; ?>:</span>
                                                       <em><?= $Currency; ?>
                                                           <span id="placebidssavingdisp" class="innerspan"><?= number_format(($price - $fprice), 2); ?></span>
                                                           <span id="placebidssaving" class="innerspan" style="display: none"><?= ($price - $fprice); ?></span>
                                                       </em>
                                                   </p>
                                                   <p><small><?php echo THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE; ?></small></p>
                                               </div><!-- /product-content -->
                                           </div><!-- /product-box -->
				  </div>
                        <?php } ?>


                        <?
                                               } elseif ($obj["auc_status"] == 1) {
                                                   $proprice = $price;
                                                   if ($obj["fixedpriceauction"] == "1") {
                                                       $aucprice = $obj["auc_fixed_price"];
                                                   } elseif ($obj["offauction"] == "1") {
                                                       $aucprice = "0.00";
                                                   } else {
                                                       $aucprice = $obj["auc_start_price"];
                                                   }
                        ?>
                                                   <div class="product-box">
                                                       <div class="product-content">
                                                           <p class="pricebox">
                                                               <strong><?php echo PRICE; ?>:</strong>
                                                               <span id="currencysymbol_<?= $obj["auctionID"]; ?>"><?php echo $Currency; ?></span>
                                                               <span id="price_index_page_<?= $obj["auctionID"]; ?>"><?php echo $obj["auc_start_price"]; ?></span><br />
<?php echo ALL_PRICES_ARE_IN_US_DOLLARS; ?>
                                               </p>

<?php if ($uid == 0) { ?>
                                                       <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="gradient button" onclick="window.location.href='<?php echo $SITE_URL; ?>login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : PLACE_BID; ?></a>

                                <?php } else {
                                ?>
<?php if ($seatauction == true) { ?>
                                                           <div id="seat_button_<?php echo $obj["auctionID"]; ?>">
                                                               <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button butseat-button-link" name="getseat.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>
                                                           </div>
<?php } ?>

                                                       <div id="normal_button_<?php echo $obj["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
<?php if ($obj['uniqueauction'] == false) { ?>
                                                           <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button bid-button-link" name="getbid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

                                    <?php } else { ?>
                                                           <a id="image_main_<?php echo $obj["auctionID"]; ?>" rel="<?php echo $obj["auctionID"]; ?>" class="button ubid-button-link" name="getuniquebid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>
                                    <?php } ?>
                                                   </div>

                                <?php } ?>
                                                   <p class="timebox">
                                    <?php if ($obj['auctypepic'] != '') {
                                    ?>
                                                       <span class="auction_type_picture">                                                                                               
                                                           <img alt="" src="<?php echo "{$UploadImagePath}aucflag/" . $obj['auctypepic']; ?>"/>
                                                       </span>                                                                                               
                                    <?php } ?>    
                                                   --:--:--
                                               </p>


                                <?php if ($seatauction) {
                                ?>
                                                       <div class="seat_panel" id="seat_panel_<?php echo $obj["auctionID"]; ?>">
                                                           <div class="seat_bar" id="seat_bar_<?php echo $obj["auctionID"]; ?>">
                                                           </div>

                                                           <div class="seat_count">
                                                               <span id="seat_count_<?php echo $obj["auctionID"]; ?>">-</span>/<span><?php echo $obj['minseats']; ?></span>
                                                           </div>
                                                           <div class="seat_text1"><?php echo SEATS_AVAILABLE; ?></div>
                                                           <div class="seat_text2">
                                        <?php echo SEAT_AUCTION_DESCRIPTION; ?>
                                                   </div>
                                                   <div class="seat_text3">
                                        <?php echo FROM_W; ?>:<span><?php echo $Currency . $obj['auc_start_price'] ?></span>&nbsp;&nbsp;
                                        <?php echo SEAT_BIDS; ?>:<span><?php echo $obj['seatbids'] ?></span>
                                                   </div>
                                               </div>
					  </div>
                                <?php } ?>
                                                   <div id="normal_panel_<?php echo $obj["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                                       <p class="winner">

                                        <?php
                                                   if (Sitesetting::isEnableAvatar()) {

                                                       $avatarPath = $UploadImagePath . "avatars/default.png";
                                                       if ($obj['avatar'] != '') {
                                                           $tmppath = $UploadImagePath . "avatars/" . $obj["avatar"];
                                                           if (file_exists($tmppath)) {
                                                               $avatarPath = $tmppath;
                                                           }
                                                       }
                                        ?>

                                                       <div style="text-align:center;"><img id="product_avatarimage_<?php echo $obj['auctionID']; ?>" alt="" src="<?php echo $avatarPath; ?>"/></div>
                                        <?php } ?>

                                                   <div style="text-align:center;"><strong><?php echo WINNER; ?>:</strong><span id="product_bidder_<?= $obj["auctionID"]; ?>">---</span></div>
                                               </p>
                                               <p><small>
                                            <?php echo WITH_EACH_BID_PRICE_WILL; ?> <?php echo ($obj['reverseauction'] == true ? DECREASE : INCREASE) . BY; ?>  <?php echo ($obj["pennyauction"] == "1" ? $Currency . "0.00" : $Currency . $obj["auc_plus_price"]); ?>
                                               </small></p>
                                           <p><small>
                                            <?php echo THIS_AUCTION_WILL_END_LATEST_ON; ?> <?= enddatefunction($obj["auc_end_date"]); ?> at <?= $obj["auc_end_time"]; ?>
                                            <?php if ($obj['lockauction'] == true) {
 ?>
                                                       <br/><?php printf(AUCTION_WILLBE_LOCKED, ($obj['locktype'] == 1 ? 'time' : 'price'), ($obj['locktype'] == 1 ? secondToTimer($obj['locktime']) : $Currency . $obj['lockprice'])); ?>
<?php } ?>
                                               </small></p>
                                       </div>
                                   </div><!-- /product-content -->
                               </div><!-- /product-box -->
                               <div class="product-box">
                                   <div class="product-content">
                                       <h3 class="savings"><?php echo SAVINGS; ?></h3>
                                       <ul>
                                           <li><span><?php echo WORTH_UP_TO; ?>:</span> <em><?= $Currency . $proprice; ?></em></li>
                                           <li><span><?php echo AUCTION_PRICE; ?>:</span> <em><?= $Currency . number_format($aucprice, 2); ?></em></li>
                                       </ul>
                                       <p class="result">
                                           <span><?php echo SAVINGS; ?>:</span>
                                           <em><?= $Currency; ?>
                                               <span id="placebidssavingdisp" class="innerspan"><?= number_format(($proprice - $aucprice), 2); ?></span>
                                               <span id="placebidssaving" class="innerspan" style="display: none"><?= number_format(($proprice - $aucprice), 2); ?></span>
                                           </em>
                                       </p>
                                       <p><small><?php echo THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE; ?></small></p>
                                   </div><!-- /product-content -->
                               </div><!-- /product-box -->

                        <?
                                               } elseif ($obj["auc_status"] == 3) {
                                                   $qrybid = "select sum(bid_count) from " . ($obj["use_free"] == 1 ? "free" : "bid") . "_account " . "where bid_flag='d' and auction_id=$aucid and user_id=" . $obj["buy_user"] . " group by auction_id";
                                                   $resbid = db_query($qrybid);
                                                   $totbid = db_num_rows($resbid) > 0 ? db_result($resbid, 0) : 0;
                                                   db_free_result($resbid);
                                                   $totbidprice = $totbid * Sitesetting::getBidPrice();
                                                   if ($obj["fixedpriceauction"] == "1") {
                                                       $fprice = $obj["auc_fixed_price"];
                                                   } elseif ($obj["offauction"] == "1") {
                                                       $fprice = "0.00";
                                                   } else {
                                                       $fprice = $obj["auc_final_price"];
                                                   }
                                                   $saving_price = $price - $fprice;
                                                   $saving_percent = $price == 0 ? '100' : ($saving_price * 100 / $price);
                        ?>

                                                   <div class="product-box">
                                                       <div class="product-content">
                                                           <p style="float:none" class="pricebox">
                                                               <strong><?php echo PRICE; ?>:</strong>
                                                               <span><?= $Currency . number_format($fprice, 2); ?></span>
                                                               <br /><?php echo ALL_PRICES_ARE_IN_US_DOLLARS; ?><br />
                                                           </p>

                                                           <p class="timebox">
                                                               <?php if($obj['auctypepic']!=''){?>
                                                       <span class="auction_type_picture">
                                                       <img alt="" src="<?php echo "{$UploadImagePath}aucflag/".$obj['auctypepic']; ?>"/>
                                                       </span>
                                                       <?php }?>
                                                               <?php echo ENDED; ?>
                                                           </p>


                                                           <p class="winner">
                                    <?php
                                                   if (Sitesetting::isEnableAvatar()) {

                                                       $avatarPath = $UploadImagePath . "avatars/default.png";
                                                       if ($obj['avatar'] != '') {
                                                           $tmppath = $UploadImagePath . "avatars/" . $obj["avatar"];
                                                           if (file_exists($tmppath)) {
                                                               $avatarPath = $tmppath;
                                                           }
                                                       }
                                    ?>

                                                       <div style="text-align:center;"><img id="product_avatarimage_<?php echo $obj['auctionID']; ?>" alt="" src="<?php echo $avatarPath; ?>"/></div>
<?php } ?>
                                                   <div style="text-align:center;"><strong><?php echo WINNER; ?>:</strong><?= ($obj["username"] != "" ? $obj["username"] : "---"); ?></div>
                                               </p>
                                               <p><small></small></p>
                                               <p><small>
                                        <?php echo THIS_AUCTION_ENDED_ON; ?> <?= arrangedate(substr($obj["auc_final_end_date"], 0, 10)); ?> at <?= substr($obj["auc_final_end_date"], 10); ?>
<?php if ($obj['lockauction'] == true) { ?>
                                                       <br/><?php printf(AUCTION_WILLBE_LOCKED, ($obj['locktype'] == 1 ? 'time' : 'price'), ($obj['locktype'] == 1 ? secondToTimer($obj['locktime']) : $Currency . $obj['lockprice'])); ?>
<?php } ?>
                                               </small></p>
                                       </div><!-- /product-content -->
                                   </div><!-- /product-box -->
                                   <div class="product-box">
                                       <div class="product-content">
                                           <h3 class="savings"><?php echo SAVINGS; ?></h3>
                                <?php if ($obj["buy_user"] != "0") {
                                ?>
                                <?php echo CONGRATULATIONS; ?>,<?= htmlspecialchars(stripslashes($obj["username"]), ENT_QUOTES); ?>!Savings:<?= number_format($saving_percent, 2); ?> %
                                <?php } else {
                                ?>
                                <?php echo NO_BIDS_PLACED; ?>
<?php } ?>
                                                   <ul>
                                                       <li><span><?php echo WORTH_UP_TO; ?>:</span><em><?= $Currency . $price; ?></em></li>
                                                       <li><span><?php echo PLACED_BIDS; ?> :</span> <em><?= ($totbid != "" ? $totbid : "0"); ?></em></li>
                                                       <li><span><?php echo FINAL_PRICE; ?>:</span> <em><?= $Currency . $fprice; ?></em></li>
                                                   </ul>
                                                   <p class="result"><span><?php echo SAVINGS; ?>:</span> <em><?= $Currency . number_format($saving_price, 2); ?></em></p>
                                                   <p><small><?php echo THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE; ?></small></p>
                                               </div><!-- /product-content -->
                                           </div><!-- /product-box -->
				      </div>

                        <?php } //end auction box 
                        
                       
                        
                        
                        ?>

				  </div><!-- /product-information -->
				  <div class="clear"></div>
                                      
				  <?php
				   include("$BASE_DIR/include/buynow.php");
				   ?>
				   <div class="clear"></div>
				  <?php include("$BASE_DIR/include/addons/auction_boxes/$template/product_details/index.php"); ?>
				    <div class="clear"></div>
                                       
            
            <?
                                               if ($obj["auc_status"] == 2) {
            ?>
                                                   <span style="display: none;" class="productImageThumb"><?php echo DETAILS; ?></span>
                                                   <span style="display: none;" id="curproductprice"><?php echo $obj['auc_due_price']; ?></span>
            <?
                                               }
            ?>
<?php if (Sitesetting::isEnableAvatar() == true) { ?>
                                                   <span style="display: none;" id="display_avatar"><?php echo $obj['auctionID'] ?></span>
<?php } ?>
                                        
                                           <span class="usefreebids" id="useonlyfree" style="display: none;"><?=
                                               $obj["use_free"]; ?></span>
                                               
                                   

				 
                       