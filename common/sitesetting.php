<?php


/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sitesetting
 *
 * @author fedora
 */

if(!function_exists('directoryToArray')){
function directoryToArray($directory, $extension, $full_path = false) {

if(isset($directory) & @ $directory != ""){
	$array_items = array();
	$handle = @ opendir($directory);
		while (false !== ($file = @ readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (is_dir($directory. "/" . $file)) {
					$array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $extension, $full_path));
				}
				else {
					if(!$extension || (preg_match("/.$extension/", $file)))
					{

                              {


						if($full_path) {
							$array_items[] = $directory . "/" . $file;

						}
						else {

							$array_items[] = $file;
						}
					}
}
				}
			}
		}
		@ closedir($handle);

	return $array_items;
}
}
}

if(!function_exists('replaceText')){
function replaceText($text){
global $SITE_NAME, $SITE_NM, $SITE_URL;
$defaultlanguage=Sitesetting::getLanguage();

if(empty($_COOKIE['lang'])){
$language = $defaultlanguage;
}else{
$language  = $_COOKIE['lang'];
}


$static_constants = array("\$SITE_NM" => $SITE_NM, "SITE_NM" => $SITE_NM, "SITE_NAME" => $SITE_NAME, "SITE_URL" => $SITE_URL, "template" => $template);
foreach($static_constants as $key => $value){
 $text = str_replace("[[" . $key . "]]", $value, $text);
}
$text = str_replace("PennyAuctionSoft", $SITE_NM, $text);
$text = str_replace("Penny Auction Soft", $SITE_NM, $text);
$text = str_replace("\$SITE_NM", $SITE_NM, $text);
$test = preg_match_all("/\[\[(.*)\]\]/", $text, $matches);

      if(is_array($matches[1])){
      if(!in_array($static_constants)){
	 
      
       if(!empty($GLOBALS[$matches[1][0]])){
	
		$text = str_replace("[[" . $matches[1][0] . "]]", $GLOBALS[$matches[1][0]], $text );
	    
	    
	    }else if(defined(constant($matches[1][0]))){
	    
		$text = str_replace("[[" . $matches[1][0] . "]]", constant($matches[1][0]), $text );
	    
	    }else if(!empty($_SESSION[$matches[1][0]])){
	    
		  $text = str_replace("[[" . $matches[1][0] . "]]", $_SESSION[$matches[1][0]], $text );
	    
	    
	    
	    }else

		{
		
		$sqlText = db_fetch_array(db_query("select value from languages where constant = '$matches[1][0]' and language = '$language' limit 1"));
		  if(!empty($sqlText[0])){
		  


			$text = str_replace("[[" . $matches[1][0] . "]]", $sqlText[0], $text );
		  }
		
	  
	  }
	 
      }
$text =  ltrim($text, "'");
return $text;
    }
}

}

if(!function_exists('createEditable')){
function createEditable($rowlang, $text = false, $defaultlanguage = 'english'){
$language = $defaultlanguage;

		      
			  
		    if(!empty($rowlang['missing'])){
		    $rowlang['value'] = $rowlang['constant'];
		    }


			  
			     

			     



//if(!preg_match('/SLIDER/', $rowlang['value']) & !preg_match('/STEP/', $rowlang['value'])){
			  preg_match_all("/\[\[(.*)\]\]/", $rowlang['value'], $matches);

			    foreach($matches[1] as $match){
			   
				 
					  $match = $$match;
					  

					
				      $rowlang['value'] = str_replace("[[". $match . "]]", $match,
					    $rowlang['value']); 
				 }
			  //  }


			    
		      define("$rowlang[constant]", $openEditStr .str_replace("&#46;", ".", str_replace("&#47;", "/", str_replace("&#33;", "!", htmlspecialchars_decode( ltrim($rowlang['value'], "'"))))) .$closeEditStr);
		}

}

function loadAddonsAsArray($dbserver, $dbusername, $dbpassword, $dbname){
		  $dba = db_connect($dbserver, $dbusername, $dbpassword, $dbserver);
		  db_select_db($dbname, $dba);
		  
		  
		$addons_array = array();
		$modules_array = array();
		      $addons = db_query("select distinct(value), id from sitesetting where name = 'addons' and status = 1");

			  while($row = db_fetch_array($addons)){
			  
			      $modules_array[$row['id']] = $row['value'];
				

				$addon_settings = db_query("select * from sitesetting where name = '$row[value]'");

				while($row2 = db_fetch_array($addon_settings)){
				
				 
				if(!empty($row['id']) & !empty($row['value'])){
				
				    $settings_me = explode(":", $row2['value']);
				   // $addons[$row['id']] = $row['value'];
				    $settings[$row['value']] = array('API_KEY' => $settings_me[0], 'API_PASSWORD' => $settings_me[1]);
				}	

				
				}


			  }
		  return $modules_array;
		}
		
		
		
		
		
		
		
		
		
		
		
if(!class_exists('Sitesetting')){		
class Sitesetting {

    private static $email = '';

    public static function getEmail($dbserver, $dbname, $dbusername, $dbpassword) {
        //if(self::$email=='') {
        $db = db_connect($dbserver, $dbusername, $dbpassword);
        if (!$db) {
            die('Could not connect: ' . db_error());
        }
        db_select_db($dbname, $db);
        $sql = "select * from sitesetting where name='adminemail';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            self::$email = $obj->value;
        }
        //}
        return self::$email;
    }

    public static function getEmailNoDb() {
        //if(self::$email=='') {

        $sql = "select * from sitesetting where name='adminemail';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            self::$email = $obj->value;
        }
        //}
        return self::$email;
    }

    public static function getLanguage() {
        $sql = "select * from sitesetting where name='defaultlanguage';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            $lang = $obj->value;
        } else {
            $lang = "english";
        }
        return $lang;
    }

    public static function setLanguage() {
        global $defaultlanguage, $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        
        if (!empty($_SESSION['lang'])) {
            $langstr = $_SESSION['lang'];
        } else if (!empty($_COOKIE['lang'])) {
            $langstr = $_COOKIE['lang'];
        }else
//echo $langstr;
        if (empty($langstr)) {
            $langstr = $defaultlanguage;
        }
       
	  if(db_num_rows(db_query("select * from languages where language = '$langstr'")) >= 1){


	    $langqry = db_query("select value, id, constant, language from languages where language = '$langstr'");

		while($rowlang = db_fetch_array($langqry)){




				     
				    if(db_num_rows(db_query("select * from sitesetting where name = 'addons' and value = 'design_suite' and status = 1")) >= 1 & db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag >= '1'")) >= 1){


					  createEditable($rowlang, false, $langstr);


				      }else{
				      define("$rowlang[constant]",  str_replace("&#46;", ".", str_replace("&#47;", "/", str_replace("&#33;", "!",htmlspecialchars_decode(replaceText($rowlang['value']))))));
				    }

				  }
		 

	  }
 echo db_error();
	}
    
    public static function EnableFireworks() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='fireworks';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        //}
        return false;
    }
    public static function EnableGavel() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='gavel';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        //}
        return false;
    }
    public static function isEnableAvatar() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='avatarfeature';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        //}
        return false;
    }

    public static function isEnableInviter() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='inviter';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        return false;
    }

    public static function isEnableTimerDelay() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='timerdelay';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        return false;
    }

    public static function isEnableTax() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='taxenable';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        return false;
    }

    public static function getLastaucseconds() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='lastaucseconds';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 0;
        }
    }

    public static function getWinLimitPerMonth() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='winpermonth';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 0;
        }
    }

    public static function getWinLimitPerWeek() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='winperweek';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 0;
        }
    }

    public static function getFeaturedAuctionCount() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='featuredcount'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 8;
        }
    }

    public static function getAutobidderSeconds() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='autobidsecond'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 0;
        }
    }

    public static function enableSeourl() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='seourl'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        } else {
            return false;
        }
    }

    public static function enableFlashBanner() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='flashbanner'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        } else {
            return false;
        }
    }

    public static function getDiscountOfHalfback() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='halfback'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 50;
        }
    }

    public static function getBidPrice($aid = '') {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
    if(empty($aid)){
        $sql = "select * from sitesetting where name='bidprice'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 1;
        }
        
      }else{
	  $sql = "select * from auction left join auction_management am on time_duration=am.auc_manage where auctionID = $aid limit 1"; 
	
	  $result = db_query($sql);
	  $obj = db_fetch_object($result);
	
            return $obj->auc_plus_price;
      }
    }
    public static function ds_enabled() {
        /* global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='design_suite'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {*/
            return 0;
        //}
    }
    public static function getAdminAutoBidderType() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='adminbidtype'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 1;
        }
    }

    public static function getTimeout() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='leavetimeout'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 0;
        }
    }

    public static function isEnableLiveMap() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='livemap'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 0;
        }
    }

    public static function isEnableSocial() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='social'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 0;
        }
    }

    public static function isEnableSlotMachine() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='slotmachine'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 0;
        }
    }

    public static function isAllowAdminBidder() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='allowadminbid'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 0;
        }
    }

    public static function getDataRefreshRate() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='refreshrate'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 1000;
        }
    }

    public static function getAjaxTimeOut() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='reftimeout'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 3000;
        }
    }

    public static function getDateFormat() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='dateformat'";
      
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 'd/m/Y';
        }
    }
    public static function reserve_icon() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='reserve_icon';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        //}
        return false;
    }
    public static function sold_color() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='sold_color';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        }
        //}
        return false;
    }
    public static function price_color() {
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
        $sql = "select * from sitesetting where name='price_color';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        }
        //}
        return false;
    }

   }
}



function check_addons_conditionals($cond_array, $addon){
         global $BASE_DIR;
        include("$BASE_DIR/config/config.inc.php");
    $r = 0;
      $sql = "select * from nav_conditionals where menu_name = 'addons' and link_name = '$addon'";
     
			      
    $qry = db_query($sql);

	 
	    while($row = db_fetch_array($qry)){
	$str = preg_match_all("/(.*?)\['(.*?)'\]/", $row['conditional_type'], $matches);
	
	switch($matches[1][0]){
	
		case('_COOKIE'):
	  switch($row['conditional_operator']){
		  
		      case('db_num_rows'):
		      break;
		      case('db_result'):
		      break;
		      case('>='):
		     
			  if($_COOKIE[$matches[2][0]] >= $row['conditional_val']){
			   
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('=='):
			  if($_COOKIE[$matches[2][0]]  == $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!='):
			  if($_COOKIE[$matches[2][0]]  != $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<='):
			  if($_COOKIE[$matches[2][0]]  <= $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!empty'):
		     
			    if(!empty($_COOKIE[$matches[2][0]] )){
			    
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('>'):
			  if($_COOKIE[$matches[2][0]]  > $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<'):
			  if($_COOKIE[$matches[2][0]]  < $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('empty'):
		    
			    if(empty($_COOKIE[$matches[2][0]] )){
			   
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('!isset'):
			   if(!isset($_COOKIE[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('preg_match'):
		      break;
		      case('isset'):
		      
			   if(isset($_COOKIE[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		}
		case('_GET'):
	  switch($row['conditional_operator']){
		  
		      case('db_num_rows'):
		      break;
		      case('db_result'):
		      break;
		      case('>='):
		     
			  if($_GET[$matches[2][0]] >= $row['conditional_val']){
			   
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('=='):
			  if($_GET[$matches[2][0]]  == $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!='):
			  if($_GET[$matches[2][0]]  != $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<='):
			  if($_GET[$matches[2][0]]  <= $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!empty'):
		     
			    if(!empty($_GET[$matches[2][0]] )){
			    
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('>'):
			  if($_GET[$matches[2][0]]  > $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<'):
			  if($_GET[$matches[2][0]]  < $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('empty'):
		    
			    if(empty($_GET[$matches[2][0]] )){
			   
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('!isset'):
			   if(!isset($_GET[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('preg_match'):
		      break;
		      case('isset'):
		      
			   if(isset($_GET[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		}
		break;
		
		case('_POST'):
	  switch($row['conditional_operator']){
		  
		      case('db_num_rows'):
		      break;
		      case('db_result'):
		      break;
		      case('>='):
		     
			  if($_POST[$matches[2][0]] >= $row['conditional_val']){
			   
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('=='):
			  if($_POST[$matches[2][0]]  == $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!='):
			  if($_POST[$matches[2][0]]  != $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<='):
			  if($_POST[$matches[2][0]]  <= $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!empty'):
		     
			    if(!empty($_POST[$matches[2][0]] )){
			    
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('>'):
			  if($_POST[$matches[2][0]]  > $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<'):
			  if($_POST[$matches[2][0]]  < $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('empty'):
		    
			    if(empty($_POST[$matches[2][0]] )){
			   
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('!isset'):
			   if(!isset($_POST[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('preg_match'):
		      break;
		      case('isset'):
		      
			   if(isset($_POST[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		}
		break;
		

      case('_SERVER'):
	  switch($row['conditional_operator']){
		  
		      case('db_num_rows'):
		      break;
		      case('db_result'):
		      break;
		      case('>='):
		     
			  if($_SERVER[$matches[2][0]] >= $row['conditional_val']){
			   
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('=='):
			  if($_SERVER[$matches[2][0]]  === $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!='):
		   
			  if($_SERVER[$matches[2][0]] !== $row['conditional_val']){
			      $r = 1;
			      
			  }else{
			      $r = 0;
			  }
			  
		      break;
		      case('<='):
			  if($_SERVER[$matches[2][0]]  <= $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!empty'):
		     
			    if(!empty($_SERVER[$matches[2][0]] )){
			    
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('>'):
			  if($_SERVER[$matches[2][0]]  > $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<'):
			  if($_SERVER[$matches[2][0]]  < $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('empty'):
		    
			    if(empty($_SERVER[$matches[2][0]] )){
			   
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('!isset'):
			   if(!isset($_SERVER[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('preg_match'):
		      break;
		      case('isset'):
		      
			   if(isset($_SERVER[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		}
		
	
    break;
    case('_SERVER'):
	  switch($row['conditional_operator']){
		  
		      case('db_num_rows'):
		      break;
		      case('db_result'):
		      break;
		      case('>='):
		     
			  if($GLOBALS[$matches[2][0]] >= $row['conditional_val']){
			   
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('=='):
			  if($GLOBALS[$matches[2][0]]  === $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!='):
		   
			  if($GLOBALS[$matches[2][0]] !== $row['conditional_val']){
			      $r = 1;
			      
			  }else{
			      $r = 0;
			  }
			  
		      break;
		      case('<='):
			  if($GLOBALS[$matches[2][0]]  <= $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!empty'):
		     
			    if(!empty($GLOBALS[$matches[2][0]] )){
			    
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('>'):
			  if($GLOBALS[$matches[2][0]]  > $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<'):
			  if($GLOBALS[$matches[2][0]]  < $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('empty'):
		    
			    if(empty($GLOBALS[$matches[2][0]] )){
			   
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('!isset'):
			   if(!isset($GLOBALS[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('preg_match'):
		      break;
		      case('isset'):
		      
			   if(isset($GLOBALS[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		}
		
	
    break;
	case('_SESSION'):
	  switch($row['conditional_operator']){
		  
		      case('db_num_rows'):
		      break;
		      case('db_result'):
		      break;
		      case('>='):
		     
			  if($_SESSION[$matches[2][0]] >= $row['conditional_val']){
			   
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('=='):
			  if($_SESSION[$matches[2][0]]  == $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!='):
			  if($_SESSION[$matches[2][0]]  != $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<='):
			  if($_SESSION[$matches[2][0]]  <= $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('!empty'):
		     
			    if(!empty($_SESSION[$matches[2][0]] )){
			    
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('>'):
			  if($_SESSION[$matches[2][0]]  > $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('<'):
			  if($_SESSION[$matches[2][0]]  < $row['conditional_val']){
			      $r = $r + 1;
			  }else{
			      $r = 0;
			  }
		      break;
		      case('empty'):
		    
			    if(empty($_SESSION[$matches[2][0]] )){
			   
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('!isset'):
			   if(!isset($_SESSION[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		      case('preg_match'):
		      break;
		      case('isset'):
		      
			   if(isset($_SESSION[$matches[2][0]] )){
				$r = $r + 1;
			    }else{
			    
				$r = 0;
			    }
		      break;
		}
	break;	
	}
    
    
    
    } 


    return $r;
}



 $addons =  loadAddonsAsArray($DBSERVER,$USERNAME,$PASSWORD,$DATABASENAME);

$admin = db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag = '1'"));



    foreach ($addons as $key => $value){

	$valid_rows = "select * from nav_conditionals where menu_name = 'addons' and link_name = '$value'";
			$sql_check =db_fetch_array($valid_rows);      
			      
			      
			      if(db_num_rows(db_query($valid_rows)) == 0){
			      
			      
				  if(file_exists("include/addons/$value/installer.php") & $admin >= 1){

					    include("include/addons/$value/installer.php");

				    }else{
					if(file_exists("include/addons/$value/functions_s.php")){

					  include("include/addons/$value/functions_s.php");


					}
				}
			      
			      }else{
    
				if(check_addons_conditionals($sql_check, $value) >= 1){
				    if(file_exists("include/addons/$value/installer.php") & $admin >= 1){

					include("include/addons/$value/installer.php");

				}else{
				    if(file_exists("include/addons/$value/functions_s.php")){

				      include("include/addons/$value/functions_s.php");


				    }
				}

			    }
	
	
		}
		
		
 
	
 }



$page_areas = array("container" => array('column-right', 'column-left')); 

if(db_num_rows(db_query("select * from page_areas where is_page = 1 and page = '" .basename($_SERVER['PHP_SELF']) . "'")) >= 1){

    $qry = db_query("select * from page_areas where is_page = 1 and page = '" .basename($_SERVER['PHP_SELF']) . "' order by menu_index asc");
    $p = 0;
    while($row = db_fetch_array($qry)){
   
	    $page_areas[$row['menu']][$row['menu_index']] = $row['name'];
	
	
    $p++;
    
    }



}

?>
