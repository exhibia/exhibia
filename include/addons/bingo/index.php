
<style>
<?php
@db_query("alter table bingo_user_data add column marked int(1) not null default '0';");
 $auctions_array = array('auctions' => 'All Auctions', 'beginner_auction' => 'Beginer Auctions', 'pennyauction' => 'Penny Auction', 'offauction' => '100% Off', 'halfbackauction' => 'Dutch Auction', 'reverseauction' => 'Reverse Auction', 'reserve' => 'Reserve Auctions', 'cashauction' => 'Cash Auction', 'nightauction' => 'Night Auction', 'openauction' => 'Open Auction', 'lockauction' => 'Lock Auction', 'seatauction' => 'Seated Auctions', 'nailbiterauction' => 'Nail Biter Auction', 'silentauction' => "Silent Auctions");
 
 
foreach($auctions_array as $key => $value){
?>
	#auction-listing #live-auctions-<?php echo $key; ?> {
				background : url(css/snapbids/auction-listing-bg.gif);
	}
	#auction-listing #live-auctions-head-<?php echo $key; ?> {
				margin-top : 10px;
				height : 50px;
				background : url(css/snapbids/auctionListing-ttl-bg.png);
	}
	#auction-listing #live-auctions-head-<?php echo $key; ?> img {
				float : left;
				padding : 6px 0 0 20px;
	}
	#auction-listing #live-auctions-head-<?php echo $key; ?> h2 {
				margin : 0px;
				float : left;
				padding : 8px 0 0 20px;
				font-weight : bold;
				font-size : 28px;
				color : #ffffff;
				text-shadow : 1px 1px 1px #bcbcbc;
				font-family : Arial,Helvetica,sans-serif;
	}
	#auction-listing #live-auctions-head-<?php echo $key; ?> h3 {
				margin : 0px;
				float : left;
				padding : 8px 0 0 20px;
				font-weight : bold;
				font-size : 28px;
				color : #ffffff;
				text-shadow : 1px 1px 1px #bcbcbc;
				font-family : Arial,Helvetica,sans-serif;
	}
	<?php } ?>
</style>
<?php	
$uid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : 0;
$changeimage = "home";
$pagename = "index";
if (!isset($_SESSION["ipid"]) && !isset($_SESSION["login_logout"])) {

    $_SESSION["ipid"] = date("Y-m-d G:i:s");

    $_SESSION["ipaddress"] = $_SERVER['REMOTE_ADDR'];



    $qryipins = "Insert into login_logout (ipaddress,load_time) values('" . $_SESSION["ipaddress"] . "', '" . $_SESSION["ipid"] . "')";

    db_query($qryipins) or die(db_error());
}

$featuredcount = Sitesetting::getFeaturedAuctionCount();

//if ( $_GET["ref"] != "" ) $_SESSION["refid"] = $_GET["ref"];
//first six products get by this query

$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,beginner_auction,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,
        (select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a " .
        "left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join auc_due_table adt on a.auctionID=adt.auction_id " .
        "where adt.auc_due_time > 0 and a.total_time > 0 and a.auc_status='2' and a.bidpack=0 order by adt.auc_due_time limit 0, $featuredcount";


$resauc = db_query($qryauc) or die(db_error());

$totalauc = db_num_rows($resauc);

//end for first nine products
?>


        <!-- ============= Header =============  -->
        <div class="pagewidth">
            <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
       
        <!-- ============= End Header =============  -->

        <div id="flash_step">
            <div class="pagewidth" class="clearfix">
                <div id="mainflash">
                    <div id="mainflash_inner">
		      <?php include("include/addons/slider/$template/index.php"); ?>
                    </div>
                </div>
                <div id="videoflash">
		    <h1 style="margin:0px 0px -30px 170px;">PURCHASE</h1>
                    <h1>DONATIONS: 10 &cent; EACH!</h1>
		    <a href="http://www.charityfunauctions.com/registration.php"><img  src="http://www.charityfunauctions.com/css/snapbids/clicktogetstarted.png" alt=""/></a>
		    <p>TIME TO MAKE A DIFFERENCE</p>
                </div>
                <div class="clear"></div>
                <div id="steps">
                    <div class="left">
                        <ul>
                            <li><?php echo BID_PRICE;?></li>
                            <li><?php echo PICK_A_PRODUCT;?></li>
                            <li class="last"><?php echo IF_LAST;?></li>
                        </ul>
                    </div>
                    <div class="left" id="reginfo">
                        <h1><?php echo "$25 " . FREE_BIDS;?></h1>
                        <h2><?php echo INSTANT_CREDIT;?></h2>
                        <div id="regbutton"><a href="<?php echo $SITE_URL;?>registration.php"><?php echo REGISTER_FREE;?></a></div>
                        <h3><?php LIMIT_PER_HOUSEHOLD;?></h3>
                        <img src="<?php echo $SITE_URL;?>img/reg_symbol.jpg"/>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
     
        
                <div id="maincol">
<?php 

if($top_auctions == true){ ?>
                    <!-- ============= Ending Auctions =============  -->
                    <div id="ending-auct-head">
                            <!--<h3><?php echo ENDING_AUCTIONS; ?></h3>
                            <h4><?php echo BID_NOW; ?> - <?php echo THESE_AUCTIONS_ARE_ABOUT_TO_END; ?></h4>-->                        
                    </div>
                    <div id="ending-auct">                        

                        <?php
                        $co = "";
                        if ($totalauc > 0) {
                            $rowindex = 0;
                            $is_first = TRUE;
                            while (( $objauc = db_fetch_array($resauc))) {
                                $co .= ( $is_first ? $objauc["auctionID"] : "," . $objauc["auctionID"]);
                                $is_first = FALSE;

                                $cornerImag = cornerImag($objauc);

                                $seatauction = $objauc['seatauction'];
                                if ($seatauction == true && $objauc['seatcount'] >= $objauc['minseats']) {
                                    $seatauction = false;
                                }

                                $pname = $objauc['bidpack'] ? $objauc['bidpack_name'] : $objauc['name'];
                                $picture = $objauc['bidpack'] ? $objauc['bidpack_banner'] : $objauc['picture1'];
                                $price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];
                                ?>

                            
                                <?php
                            }
                            db_free_result($resauc);
                        }
                        ?>

                        <div class="clear"></div>

                    </div>
                    <div id="ending-auct-end"></div>
                    <!-- ============= End Ending Auctions =============  -->
                    <div class="clear"></div>
            <?php } ?>
                    <!-- ============= Live Auctions =============  -->
	    <ul id="categories-menu">
                <li>
                    <a class="first"></a>
                    <ul>
                      <!--  <li><a href="<?php echo $SITE_URL;?>allauctions.php?aid=2"><?php echo ALL_LIVE_AUCTIONS; ?> (<?php echo checkaucstatus(2); ?>)</a></li> -->
                       <!-- <li><a href="<?php echo $SITE_URL;?>allauctions.php?aid=4"><?php echo REVERSE_AUCTION_W;?> (<?php echo $adb->getReverseCount();?>)</a></li> -->
			<!-- <li><a href="<?php echo $SITE_URL;?>allauctions.php?aid=5"><?php echo LOWEST_UNIQUE_AUCTION_W;?> (<?php echo $adb->getLowestUniqueCount();?>)</a></li> -->
                        <?php
                        $resc = db_query("select categoryID as cid, name, (select count(*) from auction where categoryID=cid and auc_status='2') as cnt from categories where status=1");
                        while (( $cat = db_fetch_array($resc))) {
                            ?>
                            <li><a href="<?php echo $SITE_URL;?>allauctions.php?id=<?php echo $cat["cid"]; ?>">&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars(stripcslashes($cat["name"]), ENT_QUOTES); ?> (<?php echo $cat["cnt"]; ?>)</a></li>
                            <?php
                        }
                        db_free_result($resc);
                        ?>
                        <!-- <li><a href="<?php echo $SITE_URL;?>allauctions.php?aid=1"><?php echo FUTURE_AUCTIONS; ?> (<?php echo checkaucstatus(1); ?>)</a></li> -->
                        <!--<li><a href="<?php echo $SITE_URL;?>allauctions.php?aid=3"><?php echo ENDED_AUCTIONS; ?> (<?php echo checkaucstatus(3); ?>)</a></li> -->
                        <li><a></a></li>
                    </ul>
                </li>
            </ul>
 <?php include 'include/searchbox.php'; ?>
                   
                    <div class="clear"></div>
                    
                   <script>
                   function create_blank_card(num){
			var card = '';
			
			for(i=0; i < num; i++){

			    card += '<li style="float:left;background-color:#cacaca;color:#fff!important;font-size:16px;max-width:120px!important;height:130px;border-radius:6px;margin: 5px 5px 5px 5px;">';
			    card += '<ul style="list-style:none;color:#fff!important;font-weight:bold;padding:5px 0 5px 0;"><li style="display:inline;width:20px;padding: 0 5px 0 5px;">B</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">I</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">N</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">G</li><li style="display:inline;width:20px;padding: 0 5px 0 5px;">O</li></ul>';
			    card += '<ul style="background-color: #FFFFFF !important;max-width: 100px !important;border-left: 2px solid #cacaca;border-right: 2px solid #cacaca;">'; 
			    bottom = 1;
			    top = 15;
			    for(p=1; p<=25; p++){
			      if(p == 13){
				  card += '<li style="float:left;width:19px!important;border-right:1px solid #000;border-bottom:1px solid #000;height:18px!important;"></li>';
			      }else{
				card += '<li style="float:left;width:19px!important;border-right:1px solid #000;border-bottom:1px solid #000;">' + Math.floor((Math.random()*top)+bottom)+ '</li>';
			      }
			      if(p % 5 == 0){
			      bottom = bottom + 15;
			      top= top+15;
			      }
			      card += '<li class="clear"></li>';
			      }
			    }
			    card += '</ul>';
			    card += '</li>';
			}
		      return card;
		      }

                   $('.darkblue-12-link').click(function(){
			preventDefault();
			add_timer_break('#live_ajax_auctions');
			 $.ajax({
				      url: 'ajax_auctions.php?',
				      data : { 'type' : id },
				      dataType: 'html',
				      success: function(response){
				      
				      
				      
					  $('#live_ajax_auctions').html(response);
					 
					 
				      }
			      });
                   
                   });
                   function sort_auctions(id){
		     add_timer_break('#live_ajax_auctions');


		      $('#sort_auctions_menu li a').removeClass('active');
		      $('#sort_auctions_link-' + id).addClass('active');
		         $.ajax({
				      url: 'ajax_auctions.php?',
				      data : { 'type' : id <?php if(!empty($_SESSION['userid'])){ ?>, "userid" : <?php echo $_SESSION['userid']; } ?> },
				      dataType: 'html',
				      success: function(response){
				      
				      
				      
					  $('#live_ajax_auctions').html(response);
					  remove_timer_break();
					
					 
				      }
			      });
		      
                   
                   }
                   </script>
		   <ul id="sort_auctions_menu">
		    
                       <?php
                       $run = 1;
                       foreach($auctions_array as $key => $value){
			      if($key != 'auctions'){
			      $filter = " and a.$key = 1 ";
			      }else{
			      $filter = '';
			      }
			      if($key == 'seatauction'){
									}
                       if(db_num_rows(db_query("select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,short_desc,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,halfbackauction,seatauction,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id where adt.auc_due_time>0  and a.total_time > 0 and a.auc_status=2 $filter")) >= 1){
			  ?>
			  <li><a id="sort_auctions_link-<?php echo $key;?>" <?php if($run == 1){ ?> class="active" <?php }else{ ?> class="inactive" <?php } ?> href="javascript:;" onclick="sort_auctions('<?php echo $key; ?>');"><?php  echo $value; ?></a></li>
			  <?php
			  
			    $run++;
                       }
                     
                       }
                       ?>
                       </ul>
                    
			<div id="live_ajax_auctions">
			    <script>
			      $.ajax({
			      
				      url: 'ajax_auctions.php?',
				      data : { 'type' : 'auctions' <?php if(!empty($_SESSION['userid'])){ ?>, "userid" : <?php echo $_SESSION['userid']; } ?> },
				      dataType: 'html',
				      success: function(response){
					 
					  $('#live_ajax_auctions').html(response);
					    remove_timer_break();
					
					   
				      }
			      });
			     
			    </script>
			</div>
	</div>
</div>
                   


  
       
