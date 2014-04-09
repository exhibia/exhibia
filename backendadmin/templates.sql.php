<?php
if(!empty($row['template'])){


@db_query("alter table style_images add column template text not null;");

ini_set('max_execution_time', 0);
shell_exec("rm DESIGN/DESIGNFILES/$row[template]/ -R -f");
@mkdir("DESIGN/DESIGNFILES", 0777);
@mkdir("DESIGN/DESIGNFILES/$row[template]", 0777);


shell_exec("cd DESIGN/DESIGNFILES/$row[template]/");
shell_exec("rm css.zip");
shell_exec("rm img.zip");

$file = file_get_contents("http://pennyauctionsoft.com/DESIGNFILES/$row[template]/css.zip");
$fp = fopen("DESIGN/DESIGNFILES/$row[template]/css.zip", 'w');
fwrite($fp, $file);
fclose($fp);


echo "http://pennyauctionsoft.com/DESIGNFILES/$row[template]/img.zip<br>";
$file = file_get_contents("http://pennyauctionsoft.com/DESIGNFILES/$row[template]/img.zip");
$fp = fopen("DESIGN/DESIGNFILES/$row[template]/img.zip", 'w');
fwrite($fp, $file);
fclose($fp);

//echo "Downloading http://pennyauctionsoft.com/DESIGNFILES/$row[template]/css.zip to enable $row[template] now<br>";
//echo "Downloading http://pennyauctionsoft.com/DESIGNFILES/$row[template]/img.zip to enable $row[template] now<br>";

@mkdir("DESIGN/DESIGNFILES/$row[template]/files", 0777);


 $zip = new ZipArchive;
     $res = $zip->open("DESIGN/DESIGNFILES/$row[template]/css.zip");

//echo "Extracting $row[template]/css.zip in preparation of adding it to your database<br> =>";
     if ($res === TRUE) {

         $zip->extractTo("DESIGN/DESIGNFILES/$row[template]/files/");
         $zip->close();
      //   echo 'ok<br>';
     } else {
    //     echo 'failed<br>';
     }


 $zip = new ZipArchive;
     $res = $zip->open("DESIGN/DESIGNFILES/$row[template]/img.zip");

//echo "Extracting $row[template]/img.zip in preparation of adding it to your database<br> =>";
     if ($res === TRUE) {

         $zip->extractTo("DESIGN/DESIGNFILES/$row[template]/files/");
         $zip->close();
//         echo 'ok<br>';
     } else {
  //       echo 'failed<br>';
     }


if(!function_exists('directoryToArray')){
function directoryToArray($directory, $extension, $full_path ) {

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
if(!function_exists('parse')){
function parse($file){
    $css = file_get_contents($file);
    preg_match_all( '/(?ims)([a-z0-9\s\.\:#_\-@,]+)\{([^\}]*)\}/', $css, $arr);
    $result = array();
    foreach ($arr[0] as $i => $x){

        $selector = trim($arr[1][$i]);
        $rules = explode(';', trim($arr[2][$i]));
        $rules_arr = array();
        foreach ($rules as $strRule){
            if (!empty($strRule)){
                $rule = explode(":", $strRule);
                $rules_arr[trim($rule[0])] = trim($rule[1]);
            }
        }
//print_r($rules_arr);
        //$selectors = explode(',', trim($selector));
        //foreach ($selectors as $strSel){

//echo trim($selector) . "<br>";
            $result[trim($selector)] = $rules_arr;
        //}
    }
    return $result;
}


}
?>


<?php 
 // examples for scanning a directory called images


$dirlist = directoryToArray("DESIGN/DESIGNFILES/$row[template]/files/css/", 'css', true);

foreach($dirlist as $key=>$css_page){


preg_replace('/\/\*.*\*\//', "", $css_page);




//echo $key . " =. " . $css_page . "<br>";
db_query("delete from stylesheets where page = '$key' and template = '$row[template]'");

//echo "Parsing css file $value<br>";
$page = parse($css_page);
//print_r($css);
//echo "</pre>";

foreach($page as $element => $elementArray){
//echo "		" . $element . " { <br>";

   foreach($page[$element] as $property => $css_value){
//echo "				$property : $css_value;<br>";

//echo "		}<br>";
if(!empty($element)){
//echo "inserting $property => $css_value into CSS database for later use for page named $css_page and element id => $element<br>";


    db_query("INSERT INTO stylesheets values(null, '" . str_replace("DESIGN/DESIGNFILES/$row[template]/files/css//", "", $css_page) . "', '$row[template]', '" . addslashes($element). "', '" . addslashes($property) . "', '" . addslashes($css_value) . "');");
echo db_error();

}
}

}
  
//parse the css here

db_query("DELETE FROM stylesheets  where value like '%//For browsers Moz,Opera,etc.%'");

db_query("update stylesheets  set value= 'url(\"pngbehavior.htc\");' where value = 'url(http'");


}




$giflist = directoryToArray("DESIGN/DESIGNFILES/$row[template]/files/img/", 'gif', true);
$pnglist = directoryToArray("DESIGN/DESIGNFILES/$row[template]/files/img/", 'png', true);
$jpglist = directoryToArray("DESIGN/DESIGNFILES/$row[template]/files/img/", 'jpg', true);



foreach($giflist as $key=>$value){
$file = file_get_contents($value);




$img_name = addslashes(str_replace("DESIGN/DESIGNFILES/$row[template]/files/img//", "", $value));

//echo "Parsing image file $value<br>";

db_query("INSERT INTO style_images values(null, '$img_name', '" . addslashes($file) . "', '" . strlen($file). "', 'image/gif', '$row[template]');");
$id = db_insert_id();

if(db_num_rows(db_query("SELECT id from stylesheets where value LIKE '%$img_name%'")) >= 1){

      $sqlImg = db_query("SELECT id, value from stylesheets where value LIKE '%$img_name%'");

	    while($pointer  = db_fetch_array($sqlImg)){

$file_pointer = str_replace("../img/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);
$file_pointer = str_replace("../img/backgrounds/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);
$file_pointer = str_replace("../img/icons/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);
$file_pointer = str_replace("../img/buttons/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);


db_query("update stylesheets set value = '" . addslashes($file_pointer). "' where id = '$pointer[id]'");  
	  }

}


}



foreach($pnglist as $key=>$value){
$file = file_get_contents($value);



$img_name = addslashes(str_replace("DESIGN/DESIGNFILES/$row[template]/files/img//", "", $value));

//echo "Parsing image file $value<br>";

db_query("INSERT INTO style_images values(null, '$img_name', '" . addslashes($file) . "', '" . strlen($file). "', 'image/png', '$row[template]');");
$id = db_insert_id();


if(db_num_rows(db_query("SELECT id from stylesheets where value LIKE '%$img_name%'")) >= 1){

      $sqlImg = db_query("SELECT id, value from stylesheets where value LIKE '%$img_name%'");

	    while($pointer  = db_fetch_array($sqlImg)){

$file_pointer = str_replace("../img/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);
$file_pointer = str_replace("../img/backgrounds/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);
$file_pointer = str_replace("../img/icons/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);
$file_pointer = str_replace("../img/buttons/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);


db_query("update stylesheets set value = '" . addslashes($file_pointer). "' where id = '$pointer[id]'");  

	  }


}

}




foreach($jpglist as $key=>$value){
$file = file_get_contents($value);


$img_name = addslashes(str_replace("DESIGN/DESIGNFILES/$row[template]/files/img//", "", $value));
//echo "Parsing image file $value<br>";

db_query("INSERT INTO style_images values(null, '$img_name', '" . addslashes($file) . "', '" . strlen($file). "', 'image/jpg', '$row[template]');");
$id = db_insert_id();
if(db_num_rows(db_query("SELECT id from stylesheets where value LIKE '%$img_name%'")) >= 1){

      $sqlImg = db_query("SELECT id, value from stylesheets where value LIKE '%$img_name%'");

	    while($pointer  = db_fetch_array($sqlImg)){


$file_pointer = str_replace("../img/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);
$file_pointer = str_replace("../img/backgrounds/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);
$file_pointer = str_replace("../img/icons/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);
$file_pointer = str_replace("../img/buttons/" . $img_name, "$SITE_URL/get_file.php?id=$id", $pointer['value']);


db_query("update stylesheets set value = '" . addslashes($file_pointer). "' where id = '$pointer[id]'");  


	  }


}

}


}

?>