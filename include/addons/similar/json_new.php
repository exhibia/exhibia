<?php
@session_start();


include("../../../config/config.inc.php");

include_once($BASE_DIR . "/common/sitesetting.php");
include_once($BASE_DIR . "/common/seosupport.php");

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
    
   
	

$aucdata=new stdClass();


	    
if($totalauc == 0){
setcookie("po[$_REQUEST[auction_id]]", "$objauc[productID]", time()-3600);
$qryauc = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productIDO, sp.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,lockauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,tax1,tax2,price,p.name,p.picture1,(select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount " . "from auction a left join 
auc_due_table adt on a.auctionID=adt.auction_id left join similar_products_bids sp on sp.auctionID=a.auctionID left join products p on a.productID=p.productID where adt.auc_due_time>0 and a.auc_status='2'";
      $qryauc .= " and a.auctionID=$_REQUEST[auction_id]";

$resauc = db_query($qryauc);
$totalauc = db_num_rows($resauc);   
   $objauc = db_fetch_object($resauc);
   
   
   
	setcookie("po[$_REQUEST[auction_id]]", $objauc->productID, time()-3600);
	
	    setcookie("po[$_REQUEST[auction_id]]", $objauc->productID, time()+3600);
	    
      if(!empty($_REQUEST['getid'])){

	//echo "$objauc[auctionID]";


      }else{
	 
     } 
	

//echo db_error();
}else{


$objauc = db_fetch_object($resauc);
	
	setcookie("po[$_REQUEST[auction_id]]", $objauc->productID, time()-3600);
	
	    setcookie("po[$_REQUEST[auction_id]]", $objauc->productID, time()+3600);


echo db_error();



      if(!empty($_REQUEST['getid'])){

	//echo "$objauc[auctionID]";


      }else{

	  

     }                            

}
$data->aid = $objauc->auctionID;

$data->img = urlencode("$UploadImagePath/products/thumbs_big/thumbbig_" . $objauc->picture1);
$data->price = urlencode($objauc->price)
;
    if($objauc->allowbuynow == 1){
	  $data->buynow = urlencode('buyitnow.php?prid=' . $objauc->productID . "&auctionId=" . $objauc->auctionID . "&uid=" . $_SESSION['userid']);
    }

			    if ($objauc->uniqueauction == false) {
				$data->url =  urlencode(SEOSupport::getProductUrl($objauc->name, $objauc->productID, 'n'));
			      } else {
				$data->url =  urlencode(SEOSupport::getProductUrl($objauc->name, $objauc->productID, 'l'));
			    }
$data->prodtitle = $objauc->name;



echo json_encode($data);