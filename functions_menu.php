<?php
ini_set('display_errors', 1);

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
$functions = dirToArray('Menu_Functions'); 

foreach($functions as $key => $function){
	$o = 1;
	while($o <= 1000){
	
	    $function = str_replace($o . "_", "", $function);
	$o++;
	}
    if(!function_exists(str_replace('.php', '', basename($function)))){
    
	
	include_once("Menu_Functions/" . $function);
    
    
    }
}







				  








	












