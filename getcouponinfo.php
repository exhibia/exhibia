<?php
/**
 * get the information of coupon according coupon code
 */
ini_set('display_errors', 1);
//include("session.php");
include_once 'config/config.inc.php';
include_once 'data/usercoupon.php';


function checkCouponDiscount($price, $coupon_str){

  $coupons = explode(",", $coupon_str);
  $final_price = $price;
  
  
  $sql_disc = db_fetch_object(db_query("select * from sitesetting where name = 'max_discount' limit 1"));
  $max_discount = $price * $sql_disc;
  $max_discount = $final_price - $max_discount;
  
  foreach($coupons as $key => $value){

  $this_coupon = db_fetch_object(db_query("select discount, operand from coupon, user_coupon where uniqueid = '$value' and coupon.id = user_coupon.couponid limit 1"));
  
  if($operand == "$"){
      $final_price = $final_price - $this_coupon->discount;
      
      
  
  }else{
  
      
       $final_price = ($final_price * ((100-$this_coupon->discount) / 100));
  
  }
  }

    if($final_price >= $max_discount){
  
	return true;
   
   }

}


$uid = $_SESSION["userid"];
$userCoupondb=new UserCoupon(null);

if($_REQUEST['couponcode']!='') {
    $couponcode=$_REQUEST['couponcode'];
    
    
    if($_REQUEST['coup_codes'] != '' & db_num_rows(db_query("select * from sitesetting where name = 'multiple_coupon' and value = 1"))>= 1){
	
	  $result=$userCoupondb->selectByUniqueIdMultiple($uid, $couponcode, $_REQUEST['coup_codes']);   
    
    }else{
   
	    $result=$userCoupondb->selectByUniqueId($uid, $couponcode);
    
    }
    if($result!=false){
   
	      if(db_num_rows($result)>0){
	      

		      $coupon=db_fetch_object($result);
		      $coupons  = $_REQUEST['coup_codes'] . "," . $coupon->uniqueid;
		      
		      
			  if(checkCouponDiscount($_REQUEST['price'], $coupons) == true){
				    $arr=array('msg'=>'ok','data'=>$coupon);
				    
				    db_free_result($result);
				    $str=json_encode($arr);
				    echo $str;
			      }else{
			      
			      
				  echo '{"msg":"You Have Reached The Max Discount"}';       
			      
			      }
		
	    }else{
		      if(db_num_rows(db_query("select * from sitesetting where name = 'multiple_coupon' and value = 1"))>= 1){
		      
			  echo '{"msg":"You Don\'t Have Any More Coupons Or '.INCORRECT_COUPON_CODE.'"}';
		      
		      }else{
			  echo '{"msg":"'.INCORRECT_COUPON_CODE.'"}';
		      }
	    }
	    
	}else{
	
	echo '{"msg":"'.INCORRECT_COUPON_CODE.'"}';
	
	}

    
    }else {
    echo '{"msg":"'.ENTER_A_COUPONCODE_PLEASE.'"}';
}


?>