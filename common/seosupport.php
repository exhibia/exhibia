<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * seo support class
 */
class SEOSupport {

    /**
     *
     * @param <type> $name product name
     * @param <type> $id product id
     * @param <type> $type product type 'l'=>lowest 'n'='normal'
     */
    public static function getProductUrl($name, $id, $type) {
        if (Sitesetting::enableSeourl() == false) {
            if ($type == 'n') {
                return sprintf("viewproduct.php?aid=%d", $id);
            } else {
                return sprintf("viewproduct_lowest.php?aid=%d", $id);
            }
        } else {
            if ($type == 'n') {
                return sprintf('auction/%s-%d.html', str_replace('|', "-", str_replace('-' ,'',$name)), $id);
            } else {
                return sprintf('auction-lowest/%s-%d.html', str_replace('|', "-", str_replace('-','',$name)), $id);
            }
        }
    }

    /**
     * get the redeem details url
     * @param <type> $name
     * @param <type> $id
     */
    public static function getRedeemUrl($name,$id){
        if (Sitesetting::enableSeourl() == false) {
            return sprintf("redemptiondetail.php?rid=%d", $id);
        }else{
            return sprintf('redeem/%s-%d.html', str_replace('|', "-", str_replace('-','',$name)), $id);
        }
    }
	public static function dynamicMeta($aid, $other = false){
	
	include("../config/config.inc.php");
	db_connect($DBSERVER, $USERNAME, $PASSWORD);
	db_select_db($DATABASENAME);

	$meta = array();
	  
		  $qrysel = "select * from auction, auction_run_status, products where auction.auctionID=$aid and auction_run_status.auctionId=$aid and auction.productID = products.productID"; 

			    
	      $ressel = db_query($qrysel);

	      $obj = db_fetch_array($ressel);
		if(empty($other)){
	                  $meta['description']= $obj['short_desc'] . " Going for $obj[auc_final_price] at $obj[auc_final_end_date]";
	                  
	                  }
	                  else{
	                 $meta['description']= $other . $obj['short_desc'] . " Going for $obj[auc_final_price] at $obj[auc_final_end_date]";
	                  
	                  
	                  }
	                  $meta['keywords'] = $obj['metatags'];
	                  
	                  
	    
	
	return $meta;
	}
	public static function dynamicTitle($aid, $other = false){
	if(file_exists("config/config.inc.php")){	
	include("config/config.inc.php");
	}else if(file_exists("../config/config.inc.php")){
	include("../config/config.inc.php");
	
	}
	db_connect($DBSERVER, $USERNAME, $PASSWORD);
	db_select_db($DATABASENAME);
			  
			  
		  $qrysel = "select * from auction, auction_run_status, products where auction.auctionID=$aid and auction_run_status.auctionId=$aid and auction.productID = products.productID"; 
//$aucid";


				
		  $ressel = db_query($qrysel);

		  $obj = db_fetch_array($ressel);
		
			
		$adate=date("Y-m-d H:i:s");
			$duration=$obj['lefttime'];
			$dateinsec=strtotime($adate);
			$newdate=$dateinsec+$duration;
			  
		  if(empty($other)){
			  return $obj['name']. " Going for $obj[newprice] ending at " . date('D M H:i:s Y',$newdate);
			  
			  
			  }else{
			  
			      return $other . $obj['name']. " Going for $obj[newprice] ending at ". date('D M H:i:s Y',$newdate);
			  
			  
			  }
	}
	public static function staticMeta($page, $other = false){
				switch('page'){

				case 'about':
					return FIND_OUT_ABOUT . " $SITE_NM";
				break;
				case 'help':
					return GET . ' ' . HELP . ' ' . ON . ' ' . $SITE_NM;
				break;
    case 'login':
    
      return LOGIN . ' ' . TO . ' ' . $SITE_NM;
    
    break;

    case 'registration':
    
      return REGISTER . ' ' . ON . ' ' . $SITE_NM;
    
    break;
    case 'rulesp':
    
      return $SITE_NM . ' ' . RULES . ' ' . AND_TXT . ' ' . POLICIES; 
    
    break;
    case 'siterules':
    
      return $SITE_NM . ' ' . RULES . ' ' . AND_TXT . ' ' . POLICIES; 
    
    break;
    
   
    case 'newsletter':
    
      return $SITE_NM . ' ' . RULES . ' ' . AND_TXT . ' ' . POLICIES; 
    
    break;
    case 'privacy':
    
      return $SITE_NM . ' ' . RULES . ' ' . AND_TXT . ' ' . POLICIES; 
    
    break;
    case 'forums':
    
     return $SITE_NM . ' ' . FORUMS; 
    
    break;

    case 'terms':
    
      return $SITE_NM . ' ' . TERMS_CONDITIONS; 
    
    break;

			}



		}


}

?>
