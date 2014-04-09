<?php

if(!function_exists('directoryToArray')){
function directoryToArray($directory, $extension, $full_path, $sub_folder = '' ) {

if(isset($directory) & @ $directory != ""){
	$array_items = array();
	$handle = @ opendir($directory);
		while (false !== ($file = @ readdir($handle))) {
			if ($file != "." && $file != "..") {
				if (is_dir($directory. "/" . $file)) {
if(!empty($sub_folder)){
@mkdir($sub_folder . "/" . $file);
}
					$array_items = array_merge($array_items, directoryToArray($directory. "/" . $file, $extension, $full_path, $sub_folder)); 

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

$pages = directoryToArray("../../languages/" . strtolower($_GET[lang]) . "/", ".php", true, '' );
?>


<select name="lang_page">
<?php
foreach($pages as $page){

?>

<option value="<?php echo $page;?>"><?php echo basename($page);?></option>


<?php
}
?>
</select>