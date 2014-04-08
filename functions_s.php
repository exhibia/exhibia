<?php

/* common function */

include_once('config/config.inc.php');

    include_once $BASE_DIR . '/common/sitesetting.php';



    include_once $BASE_DIR . '/common/securityfilter.php';




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

/* end update record function */


/* update butler function */


$functions = dirToArray('Functions/'); 

foreach($functions as $key => $function){
	
	
	   
    if(!function_exists(str_replace('.php', '', basename($function))) & !class_exists(str_replace('.php', '', basename($function)))){
   
	
	include_once("Functions/" . $function);
    
    
    }
}  

$functions = dirToArray('Functions_s/'); 

foreach($functions as $key => $function){
	
	
	
    if(!function_exists(str_replace('.php', '', basename($function))) & !class_exists(str_replace('.php', '', basename($function)))){
   
	
	include_once("Functions_s/" . $function);
    
    
    }
}  






if(!empty($_REQUEST['test_email'])){


SendWinnerMail(1, 'true');
//SendHTMLMail2('buywithjoel@gmail.com', 'Test Email Servers Email', 'Joel this is a new method of testing site owner\'s email. It can be called from a browser to ensure that it is working properly', $adminemailadd);

//SendHTMLMail2('edward.goodnow@gmail.com', 'Test Email Servers Email', 'Joel this is a new method of testing site owner\'s email. It can be called from a browser to ensure that it is working properly', $adminemailadd);
}
?>
