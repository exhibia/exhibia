<?php
ini_set('display_errors', 1);

$programFolder = '/home/pennyauc/public_html/qbidz-new';
db_query("DELETE FROM template_pointer");
db_query("INSERT INTO template_pointer values(null, '$_REQUEST[template]', '" . time("Y-m-d H:i:s") . "');");
echo db_error();


$file = file_get_contents("http://pennyauctionsoft.com/DESIGNFILES/$_REQUEST[template]/pages.zip");
$fp = fopen("DESIGN/DESIGNFILES/$_REQUEST[template]/pages.zip", 'w');
fwrite($fp, $file);
fclose($fp);



 $zip = new ZipArchive;
     $res = $zip->open("DESIGN/DESIGNFILES/$_REQUEST[template]/pages.zip");

//echo "Extracting $row[template]/css.zip in preparation of adding it to your database<br> =>";
     if ($res === TRUE) {

         $zip->extractTo("DESIGN/DESIGNFILES/$_REQUEST[template]/files/");
         $zip->close();
      //   echo 'ok<br>';
     } else {
    //     echo 'failed<br>';
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


chmod("DESIGN/DESIGNFILES/$_REQUEST[template]/files/pages/", 0777);

$pagelist = directoryToArray("DESIGN/DESIGNFILES/$_REQUEST[template]/files/pages/", '*', true);



foreach($pagelist as $key=>$value){
echo $value . "<br>";
$page = str_replace("DESIGN/DESIGNFILES/$_REQUEST[template]/files/pages//", "", $value);


unlink("$programFolder/$page");
shell_exec("cp $programFolder/backendadmin/$value $programFolder/$page");
/*}else{

if(file_exists("cp $programFolder/backendadmin/$value")){
echo "Please set folder permission on $programFolder so that your Apache server can write too them...ie...set them to a minimum of 755 and make them owned by the user and group running Apache";

}
}*/


}