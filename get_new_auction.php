<?php
ini_set('display_errors', 1);
//setcookie("last_auction", '', time()-3600);

session_start();

include("config/connect.php");
include_once 'functions.php';


include_once 'common/seosupport.php';




		  function choose_auction_box($box, $objauc, $UploadImagePath){

		    include("config/config.inc.php");
		    
		    @session_start();
		    
		    
		    $uid = $_SESSION['userid'];
		    include_once 'functions.php';


		    include_once 'common/seosupport.php';

		    
			$objauc2 = db_fetch_array(db_query("select * from auction where auctionID=$_REQUEST[auction_id]"));
			
			
                                $cornerImag = cornerImag($objauc);

                                $seatauction = $objauc['seatauction'];
                                if ($seatauction == true && $objauc['seatcount'] >= $objauc['minseats']) {
                                    $seatauction = false;
                                }

                                $pname = $objauc['bidpack'] ? $objauc['bidpack_name'] : $objauc['name'];

                                $picture = $objauc['bidpack'] ? $objauc['bidpack_banner'] : $objauc['picture1'];

                                $price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];
				$seatauction = $objauc['seatauction'];
				$uid = $_SESSION['userid'];
                     require($BASE_DIR . "/include/addons/similar/$template/$_REQUEST[box].php");
                     ?>
                     <input type="hidden" name="productID-hidden_<?php echo $objauc['auctionID'];?>" id="productID-hidden_<?php echo $objauc['auctionID'];?>" value="<?php echo $objauc['productID']; ?>" />
                     <?php
                       
                       
       }
       
       
       
       
$co = '';
$auclist = explode(",",  $_REQUEST['auctionlist']);
$is_first = TRUE;


$auctions_used = array();

 foreach($auclist as $value) {
 $is_first = FALSE;
 
 $auction = str_replace('auction_', '', $value);
 
 if(!empty($auction) & !preg_match("/$auction/", $co)){
   
      if(empty($co)){
      $co = $auction . ",";
      }else{
      $co .= $auction . ",";
      }
array_push($auctions_used, $auction);   
   }
     

}

$max= max($auctions_used);

$co = rtrim($co, ",");

if(!empty($_COOKIE['last_auction'])){
$co .= "," . $_COOKIE['last_auction'];

}

if(empty($_SESSION['userid'])){
$_SESSION['userid'] = 0;
}

$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productIDO,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1, (select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join 
auc_due_table adt on a.auctionID=adt.auction_id left join similar_products sp on sp.auctionID=a.auctionID where adt.auc_due_time>0 and a.auc_status='2'";
      $qryauc .= " and a.auctionID=$_REQUEST[auction_id]";
      $product = db_fetch_array(db_query($qryauc));
    
if(db_num_rows(db_query("select * from similar_products_bids where auctionID=$_REQUEST[auction_id] and userid=$_SESSION[userid]")) == 0){

    db_query("insert into similar_products_bids values(null, $_REQUEST[auction_id], $product[productID], '$_SESSION[userid]', 0, NOW());");

    $qry = db_query("select * from similar_products where auctionID=$_REQUEST[auction_id]");
    
    $row = db_fetch_array($qry);
    
    $products = explode(",", $row['productID']);
    foreach($products as $productID){
	db_query("insert into similar_products_bids values(null, $_REQUEST[auction_id], $productID, '$_SESSION[userid]', 0, NOW());");
    
    
    }
  
}


$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productIDO,sp.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,tax1,tax2,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a left join 
auc_due_table adt on a.auctionID=adt.auction_id left join similar_products_bids sp on sp.auctionID=a.auctionID left join products p on sp.productID=p.productID where adt.auc_due_time>0 and a.auc_status='2'";
      $qryauc .= " and a.auctionID=$_REQUEST[auction_id]";

      
$qryaucl = $qryauc . " order by sp.id desc limit 1";
$qryaucf = $qryauc . " order by sp.id asc limit 1";


$last = db_fetch_array(db_query($qryaucl));
$first = db_fetch_array(db_query($qryaucf));
if($_REQUEST['which'] == 'back' | $_REQUEST['which'] == 'forward'){

      if($_REQUEST['which'] == 'back'){
      
	  if(!empty($_COOKIE['po']) ){
	      
	      $qryauc .= " and sp.productID <> " . $_COOKIE['po'][$_REQUEST['auction_id']] . " order by sp.id desc limit 1";
	      
	  }else{
	      if(!empty($_COOKIE['po'][$_REQUEST['auction_id']])){
		    $reset = 'true';
		    }
	      $qryauc .= " order by sp.id desc limit 1";
	  }
	  
	  
	  
      }else{
      
      
	 if(!empty($_COOKIE['po']) ){
	     
	      $qryauc .= " and sp.productID <> " . $_COOKIE['po'][$_REQUEST['auction_id']] . "  order by sp.id asc limit 1";
	      
	       
	  
	    }else{
	    
	      if(!empty($_COOKIE['po'][$_REQUEST['auction_id']])){
		$reset = 'true';
		}
		$qryauc .= " order by sp.id asc limit 1";
	    }
      
      
      }
      
 }else{
 
 
      $qryauc .= " and sp.productID = " . $_REQUEST['which'] . " order by sp.id desc limit 1";

 }
     
      


$resauc = db_query($qryauc);
$totalauc = db_num_rows($resauc);   
    echo db_error();  
    
   
	

	    
	    
if($totalauc == 0){
setcookie("po[$_REQUEST[auction_id]]", "$objauc[productID]", time()-3600);
$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productIDO, sp.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,tax1,tax2,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a left join 
auc_due_table adt on a.auctionID=adt.auction_id left join similar_products_bids sp on sp.auctionID=a.auctionID left join products p on a.productID=p.productID where adt.auc_due_time>0 and a.auc_status='2'";
      $qryauc .= " and a.auctionID=$_REQUEST[auction_id]";

$resauc = db_query($qryauc);
$totalauc = db_num_rows($resauc);   
   $objauc = db_fetch_array($resauc);
	setcookie("po[$_REQUEST[auction_id]]", "$objauc[productID]", time()-3600);
	
	    setcookie("po[$_REQUEST[auction_id]]", "$objauc[productID]", time()+3600);
      if(!empty($_REQUEST['getid'])){

	echo "$objauc[auctionID]";


      }else{

	 choose_auction_box($box, $objauc, $UploadImagePath);

     } 
	

//echo db_error();
}else{

	$objauc = db_fetch_array($resauc);
	setcookie("po[$_REQUEST[auction_id]]", "$objauc[productID]", time()-3600);
	
	    setcookie("po[$_REQUEST[auction_id]]", "$objauc[productID]", time()+3600);


echo db_error();



      if(!empty($_REQUEST['getid'])){

	echo "$objauc[auctionID]";


      }else{

	 choose_auction_box($box, $objauc, $UploadImagePath);

     }                            

}

?>