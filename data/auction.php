<?php

    require_once $BASE_DIR . '/common/dbmysql.php';

  
/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auction
 *
 * 
 */
class Auction {

    private $db;

    //put your code here

    public function __construct($db) {
        if ($db == null) {
            $this->db = new DBMysql();
        } else {
            $this->db = $db;
        }
    }

    public function selectByAuctionId($auctionid) {
        $qryauc = "select auctionID, name,short_desc, picture1,allowbuynow,uniqueauction,buynowprice,p.price,bidpack,bidpack_name,bidpack_banner,bid_size,bid_price,freebids, a.productID,tax1,tax2 from auction a " .
                "left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 " .
                "where a.auctionID=$auctionid";

        return $this->db->executeQuery($qryauc);
    }
   function default_tax($product_data, $location_data){
      if(!empty($location_data)){
	 
	
	      if(db_num_rows(db_query("select * from taxclass where country = '$location_data[delivery_country]' and enable = '1'")) >= 1){
	  
		    $tax_data = db_fetch_array(db_query("select * from taxclass where country = '$location_data[delivery_country]' limit 1"));
		
		
			if($tax_data['enable'] == 1){
			    
			    $tax[1] = $product_data['price'] * ($tax_data['percent'] / 100);
			    
			}else{
			
			    $tax[1] = '0.00';
			    
			}
		
	 
		  }else{
	  
		    $tax[1] = '0.00';
		    
	      }
	  }else{
	
	    $tax[1] = '0.00';
	   
	
	  }
	    return $tax;    
    
    
    
    
    }
  
    function us_tax($product_data, $location_data){
   $tax = array();
   
     if(!empty($location_data)){
	 
	if(strlen($location_data['delivery_state']) == 2){
	    $st = db_fetch_array(db_query("select stname from usstates where stcode = '" . addslashes($location_data['delivery_state']) . "'" ));
	    $location_data['delivery_state'] = $st['stname'];
	}
	if(empty($location_data['delivery_state'])){
	    $location_data['delivery_state'] = $location_data['state'];
	}
	if(empty($location_data['delivery_country'])){
	    $location_data['delivery_country'] = $location_data['country'];
	}
	
	      if(db_num_rows(db_query("select * from taxclass where country = '$location_data[delivery_country]' and state = '$location_data[delivery_state]' and enable = '1'")) >= 1){
	  
		    $tax_data = db_fetch_array(db_query("select * from taxclass where country = '$location_data[delivery_country]' and state = '$location_data[delivery_state]' limit 1"));
		
		
			if($tax_data['enable'] == 1){
			    
			    $tax[0] = $product_data['price'] * ($tax_data['percent'] / 100);
			    $tax[1] = $product_data['price'] * ($tax_data['percent2'] / 100);
			}else{
			
			    $tax[0] = '0.00';
			    $tax[1] = '0.00';
			}
		
	 
		  }else{
	  
		    $tax[0] = '0.00';
		    $tax[1] = '0.00';
	      }
	  }else{
	
	    $tax[0] = '0.00';
	    $tax[1] = '0.00';
	
	  }
	
	    return $tax;
      }

   function getTaxes($product_data, $location_data){
 
	  switch($location_data['delivery_country']){
	  
	  
	      case('US'):
	      
		  $tax = $this->us_tax($product_data, $location_data);
	      break;
	      case('CA'):
		  $tax = $this->us_tax($product_data, $location_data);
	      break;
	      default;
		  $tax = $this->default_tax($product_data, $location_data);
   
	 }

	 return $tax;
   
   }
    public function getBuynowPrice($userid, $aucid) {
    global $BASE_DIR;
    include("$BASE_DIR/config/xss_rules.php");
      $sql1 = "select * from auction left join products p on p.productID=auction.productID where auctionID=$aucid";
     
        $result = $this->db->executeQuery($sql1);
        if ($result == false || db_num_rows($result) <= 0) {
            return 0;
        }
        $obj = db_fetch_object($result);
    
	$buynowprice = array();
        $discountprice = 0;
        $price = $obj->buynowprice;
        
       
        if ($userid > 0 && $obj->allowbuynow == 1) {
            $sql = "select value from sitesetting where name='bidprice';";
            $ssresult = db_query($sql);
            $bidunit = db_result($ssresult, 0);

            $sql = "select value from sitesetting where name='maxdiscount';";
            $ssresult = db_query($sql);
            $maxdiscount = db_result($ssresult, 0);

            $bidtimes = 0;
            $bidtable = $obj->use_free == 1 ? 'free_account' : 'bid_account';
            $sql = "select count(*) from $bidtable where auction_id=$aucid and user_id=$userid and bid_flag='d'";
            $tempresult = db_query($sql);
            $bidtimes = db_result($tempresult, 0);

            $discountprice = $bidtimes * $bidunit;
          
            if ($discountprice > $price * $maxdiscount / 100) {
                $discountprice = $price * $maxdiscount / 100;
            }
          
            $buynowprice['price'] = $price - $discountprice;
           
            $savings = round (($discountprice / $price) * 100);
        }
	$buynowprice['start_price'] = $price;
	$buynowprice['discount'] = $discountprice;
	$buynowprice['savings'] = $savings;
	$buynowprice['shipping'] = $this->getShipping($aucid);
	
	
        $buynowprice['total'] = $buynowprice['price'];
      
        
        if (Sitesetting::isEnableTax() == true) {
            
            $p_item = db_fetch_array(db_query($sql1));
	    $user = db_fetch_array(db_query("select * from registration where id = $userid"));
	    
	    
	    $userid = $_SESSION['userid'];
	    $taxes =$this->getTaxes($p_item, $user);
            $buynowprice['tax1'] = $taxes[0];
            $buynowprice['tax2'] = $taxes[1];
            $buynowprice['total'] = $buynowprice['price'] + $taxes[0] + $taxes[1];
        }
	    $buynowprice['total'] = $buynowprice['total'] + $buynowprice['shipping'];
	    
        return $buynowprice;
    }
    public function getShipping($aucid){
    
	$sql = "select * from auction left join products p on p.productID=auction.productID left join shipping s on s.id = auction.shipping_id where auctionID=$aucid";
	
	$result = $this->db->executeQuery($sql);
	
	$shipping = db_fetch_array($result);
	
	return $shipping['shippingcharge'];
    
    }
    public function getBuyPriceWithTax($userid, $aucid) {
	$sql = "select * from auction left join products p on p.productID=auction.productID where auctionID=$aucid";
      
        $result = $this->db->executeQuery($sql);
        if ($result == false || db_num_rows($result) <= 0) {
            return 0;
        }
        $obj = db_fetch_object($result);

        $discountprice = 0;
        $buynowprice = $obj->buynowprice;
        if ($userid <> 0 && $obj->allowbuynow == 1) {
            $sql = "select value from sitesetting where name='bidprice';";
            $ssresult = db_query($sql);
            $bidunit = db_result($ssresult, 0);

            $sql = "select value from sitesetting where name='maxdiscount';";
            $ssresult = db_query($sql);
            $maxdiscount = db_result($ssresult, 0);

            $bidtimes = 0;
            $bidtable = $obj->use_free == 1 ? 'free_account' : 'bid_account';
            $sql = "select count(*) from $bidtable where auction_id=$aucid and user_id=$userid and bid_flag='d'";
            $tempresult = db_query($sql);
            $bidtimes = db_result($tempresult, 0);

            $discountprice = $bidtimes * $bidunit;
            if ($discountprice > $buynowprice * $maxdiscount / 100) {
                $discountprice = $buynowprice * $maxdiscount / 100;
            }
            $buynowprice = $buynowprice - $discountprice;
        }

        if (Sitesetting::isEnableTax() == true) {
            $temp = $buynowprice;

           /* if ($obj->tax1 != 0) {
                $buynowprice+=$temp * $obj->tax1 / 100;
            }

            if ($obj->tax2 != 0) {
                $buynowprice+=$temp * $obj->tax2 / 100;
            }*/
             /* $temp = $buynowprice;

            if ($obj->tax1 != 0) {
                $buynowprice+=$temp * $obj->tax1 / 100;
            }

            if ($obj->tax2 != 0) {
                $buynowprice+=$temp * $obj->tax2 / 100;
            }*/
            
            $p_item = db_fetch_array(db_query("select * from products where productID = " . $obj->productID));
	
	    $userid = $_SESSION['userid'];
            $buynowprice+=$this->getTax($p_item, $_SESSION);
        }

        return $buynowprice;
    }

    public function getReverseCount() {
        $sql = "select count(*) from auction where auc_status='2' and reverseauction=1";
        $result = $this->db->executeQuery($sql);
        if (db_num_rows($result) > 0) {
            return db_result($result, 0, 0);
        }
        return 0;
    }

    public function getLowestUniqueCount() {
        $sql = "select count(*) from auction where auc_status='2' and uniqueauction=1";
        $result = $this->db->executeQuery($sql);
        if (db_num_rows($result) > 0) {
            return db_result($result, 0, 0);
        }
        return 0;
    }

}

?>
