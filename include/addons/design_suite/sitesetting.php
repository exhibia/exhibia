<?php

session_start();
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


function replaceText($text){

preg_match_all("/\[\[(.*)\]\]/", $text, $matches);
  foreach($matches[1] as $match){

    $sqlText = db_fetch_array(db_query("select value from languages where constant = '$match' and language = 'english' limit 1"));
  if(!empty($sqlText[0])){
  


  $text = str_replace($match, $sqlText[0], str_replace("[[", " ", str_replace("]]", " ", $text)));
	  }
	  }



return $text;


}


function createEditable($rowlang, $text = false){
echo $text;

		      if(!empty($rowlang['missing'])){
		       $openEditStr = "<h25 class=\"edit\" id=\"".strtolower($rowlang['constant']) .":". uniqid() . ":missing\" onclick=\"edit_text(this.id);\"";

			  $openEditStr .= "style=\"border:1px dotted yellow;\"><-missing";
			  }else{
			  $openEditStr = "<h25 class=\"edit\" id=\"".strtolower($rowlang['constant']) .":$rowlang[id]\" onclick=\"edit_text(this.id);\"";

			  $openEditStr .= "style=\"border:1px dotted green;\">";
			  }
			    $openEditStr .= "<h40 style=\"position:relative; left:95% top:-1px;cursor:move;\">.</h40>";
			    $closeEditStr = "</h25>";
			  $openEditStr = '';
			  $closeEditStr = '';
		    if(!empty($rowlang['missing'])){
		    $rowlang['value'] = $rowlang['constant'];
		    }


			    $ignore = array('ALL_CATEGORIES', 'ALL_LIVE_AUCTIONS', 'ENDED_AUCTIONS', 'DIALOG_TIMEOUT_TITLE');

			    if(in_array($rowlang['constant'], $ignore)){
			    $openEditStr = '';
			    $closeEditStr = '';
			    }
			     

			     



//if(!preg_match('/SLIDER/', $rowlang['value']) & !preg_match('/STEP/', $rowlang['value'])){
			  preg_match_all("/\[\[(.*)\]\]/", $rowlang['value'], $matches);

			    foreach($matches[1] as $match){
			   
				 if(!empty($$match)){
					  $match = $$match;
					  

					  }else{
				  $sqlText = db_fetch_array(db_query("select value, constant, id from languages where constant = '$match' and language = 'english' limit 1"));
					if(!empty($sqlText[0])){
					    if(!in_array($rowlang['constant'], $ignore)){
						  $openEditStr = "<h25 class=\"edit\" id=\"".strtolower($sqlText['constant']) .":$sqlText[id]\" onclick=\"edit_text(this.id);\">";
						    $closeEditStr = "</h25>";
						}

						$rowlang['value'] = str_replace("[[". $match . "]]", $sqlText[0], $rowlang['value']);
						}else{
					 
						
					    if(!in_array($sqlText['constant'], $ignore)){
						  $openEditStr = "<h25 class=\"edit\" id=\"".strtolower($match) .":" . uniqid() . "\" onclick=\"edit_text(this.id);\" style=\"border: 1px
dotted yellow;\">";
						    $closeEditStr = "</h25><-missing";
						}
					    $rowlang['value'] = str_replace("[[". $match . "]]", $opnEditStr .  $match. $closeEditStr,
					    $rowlang['value']);

				    }
				    }
				      $rowlang['value'] = str_replace("[[". $match . "]]", $match,
					    $rowlang['value']); 
				 }
			  //  }


			    
 define("$rowlang[constant]", $openEditStr . str_replace("&#46;", ".", str_replace("&#47;", "/",
		  str_replace("&#33;", "!", htmlspecialchars_decode("$rowlang[value]")))) .$closeEditStr);
		}


		function loadAddonsAsArray($dbserver, $dbusername, $dbpassword, $dbname){
		  db_connect($dbserver, $dbusername, $dbpassword);

		    db_select_db($dbname);
		
		$modules_array = array();
		      $addons = db_query("select * from sitesetting where name = 'addons'");

			  while($row = db_fetch_array($addons)){

			      $modules_array[$row['id']] = $row['value'];
				

				$addon_settings = db_query("select * from sitesetting where name = '$row[value]'");

				while($row2 = db_fetch_array($addon_settings)){
				$array = explode("::", $row2['value']);

				  $modules_array[$row['id']][$array[0]] = $array[1];
					

				
				}


			  }
		  return $modules_array;
		}
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
        global $defaultlanguage;
        $langstr = '';
        //echo $_SESSION['lang1'];
//        echo $_COOKIE['lang'];
        if (isset($_SESSION['lang1'])) {
            $langstr = $_SESSION['lang1'];
        } else if (isset($_COOKIE['lang'])) {
            $langstr = $_COOKIE['lang'];
        }
//echo $langstr;
        if ($langstr == '') {
            $langstr = $defaultlanguage;
        }
	  if(db_num_rows(db_query("select * from languages where language = '$langstr'")) >= 1){


	    $langqry = db_query("select value, id, constant, language from languages where language = '$langstr'");

		while($rowlang = db_fetch_array($langqry)){
		



				     
				    if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag != '0'")) >= 1){


				    createEditable($rowlang);


				      }else{
				      define("$rowlang[constant]",  str_replace("&#46;", ".", str_replace("&#47;", "/", str_replace("&#33;", "!",
htmlspecialchars_decode(replaceText("$rowlang[value]"))))));
				    }

				  }
		  echo db_error();

	  }else{
        $langdir = '';
        if (file_exists('languages'))
            $langdir = 'languages/';
        else
            $langdir='../languages/';
//include common
        //echo $filename.$langstr;
        if (!file_exists($langdir . $langstr)) {
            $langstr = $defaultlanguage;
            $_SESSION['lang'] = $langstr;
            setcookie('lang', $langstr);
        }
        $langdir.=$langstr;

        $commondir = $langdir . '/common';
        if (file_exists($commondir)) {
            $dir_handle = opendir($commondir);
            if ($dir_handle) {
                while (($file = readdir($dir_handle)) !== false) {
                    if ($file === '.' || $file === '..') {
                        continue;
                    }
                    $tmp = realpath($commondir . '/' . $file);
                    if (!is_dir($tmp)) {
                        if (preg_match('/^lang_.+/', $file)) {
                            include ($commondir . '/' . $file);
                        }
                    }
                }
            }
        }
//获取当前文件名
        $url = $_SERVER['PHP_SELF'];
        $filename = end(explode('/', $url));
        $mainlang = $langdir . '/lang_' . $filename;

        if (file_exists($mainlang)) { 
            include ($mainlang);
        }

	}
    }

    public static function isEnableAvatar() {
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
        $sql = "select * from sitesetting where name='inviter';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        return false;
    }

    public static function isEnableTimerDelay() {
        $sql = "select * from sitesetting where name='timerdelay';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        return false;
    }

    public static function isEnableTax() {
        $sql = "select * from sitesetting where name='taxenable';";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value == '1' ? true : false;
        }
        return false;
    }

    public static function getLastaucseconds() {
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
        $sql = "select * from sitesetting where name='halfback'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 50;
        }
    }

    public static function getBidPrice() {
        $sql = "select * from sitesetting where name='bidprice'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 1;
        }
    }

    public static function getAdminAutoBidderType() {
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
        $sql = "select * from sitesetting where name='dateformat'";
        $result = db_query($sql);
        if ($result != false && db_num_rows($result) > 0) {
            $obj = db_fetch_object($result);
            return $obj->value;
        } else {
            return 'd/m/Y';
        }
    }

}
 $addons =  loadAddonsAsArray($DBSERVER,$USERNAME,$PASSWORD,$DATABASENAME);

$admin = db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag != '0'"));

    foreach ($addons as $key => $value){

	if(file_exists("include/addons/$value/installer.php") & $admin >= 1){

	    include("include/addons/$value/installer.php");

    }else{
	if(file_exists("include/addons/$value/functions.php")){

	  include("include/addons/$value/functions.php");


	}
    }

 }
?>
