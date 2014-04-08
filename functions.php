<?php



if (file_exists('common/securityfilter.php')) {
    include_once 'common/securityfilter.php';
} else {
    include_once '../common/securityfilter.php';
}

if (file_exists('common/seosupport.php')) {
    include_once 'common/seosupport.php';
} else {
    include_once '../common/seosupport.php';
}


  foreach($addons as $key => $value){
    if(file_exists("include/addons/$value/$template/functions_s.php")){
    
	include("include/addons/$value/$template/functions_s.php");
    
    
    }else{
      if(file_exists("include/addons/$value/functions_s.php")){

	    include_once("include/addons/$value/functions_s.php");

      }
    }

  }
  


// Functions added for begin transaction and commit transaction



  if(db_num_rows(db_query("select * from registration where id = $_SESSION[userid] and admin_user_flag >= 1")) > 0){

      $user_level = db_fetch_array(db_query("select * from registration where id = $_SESSION[userid] and admin_user_flag >= 1"));
	  $_SESSION['user_level'] = $user_level['admin_user_flag'];
	  $_SESSION['admin'] = $user_level['admin_user_flag'];
  }

if(basename($_SERVER['PHP_SELF']) != 'edit_menu.php'){	
include("functions_menu.php"); 

}






if(!function_exists('dirToArray')){
function dirToArray($directory, $extension = 'php') {

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
$functions = dirToArray($BASE_DIR . '/Functions/'); 


foreach($functions as $key => $function){

	$o = 1;
	while($o <= 1000){
	
	    $function = str_replace($o . "_", "", $function);
	$o++;
	}
    if(!function_exists(str_replace('.php', '', basename($function)))){
 
	
	require_once($BASE_DIR . '/Functions/' . basename($function));
    
    
    }
}

 $settings_sql = db_query("select distinct value from sitesetting where name = 'master_settings' and name not like 'template%'");
 
    while($row_s = db_fetch_array($settings_sql)){
	$setting = explode(":", $row_s[0]);
	
	$$setting[0] = $setting[1];
    }
    
    
    
    
if(!empty($_SESSION['userid'])){

update_users_bids($_SESSION['userid']);

}


 if($_REQUEST['test_email'] == "true"){
	if($_REQUEST['test_email_type'] == 'html'){
	    if(empty($_REQUEST['email_template'])){
	      SendHTMLMail('edward.goodnow@gmail.com', 'Test HTML Email Functions on ' . $SITE_NM . ' at ' . date("Y-md H:i:s"), '<font color="red">Ed this is a debug HTML Email from</font> ' .$SITE_NM, $adminemailadd);
	      SendHTMLMail('buywithjoel@gmail.com', 'Test HTML Email Functions on ' . $SITE_NM . ' at ' . date("Y-md H:i:s"), '<font color="red">Ed this is a debug HTML Email from</font> ' .$SITE_NM, $adminemailadd);
	    }
	   
	
	}else{
   if($_REQUEST['test_email_type'] == 'winner'){
	  
		  SendWinnerMail(1, 'true');
	    
	    }else{
   
	 
	    
	  mail('edward.goodnow@gmail.com', 'Test Email Functions on ' . $SITE_NM . ' at ' . date("Y-md H:i:s"), 'Ed this is a debug Email from ' .$SITE_NM, null, '-f ' . $adminemailadd);
	  mail('buywithjoel@gmail.com', 'Test Email Functions on ' . $SITE_NM . ' at ' . date("Y-md H:i:s"), 'Joel this is a debug Email from ' .$SITE_NM, null, '-f ' . $adminemailadd);
	   
	  }
    
      }
    }	
  