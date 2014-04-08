<?php
include("config/config.inc.php");
$template = 'koodeal';
//echo $BASE_DIR . "/include/$template/";
$folder = $BASE_DIR . "/include/$template/";



function directoryToArray($directory, $extension = 'php') {

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

@mkdir("$BASE_DIR/css/$template/", 0777);
if(file_exists("/home/demo/public_html/img/")){

  shell_exec("cp /home/demo/public_html/img/* /home/dev_server/public_html/css/$template/ -R -f");
  shell_exec("cp /home/demo/public_html/image/* /home/dev_server/public_html/css/$template/ -R -f");
  shell_exec("cp /home/demo/public_html/images/* /home/dev_server/public_html/css/$template/ -R -f");

}

$files = directoryToArray($folder);
shell_exec("rm $BASE_DIR/include/$template/*.txt -f");
shell_exec("rm $BASE_DIR/include/$template/*.xml -f");
shell_exec("rm $BASE_DIR/include/$template/*.css -f");
shell_exec("rm $BASE_DIR/include/$template/*.js -f");
shell_exec("rm $BASE_DIR/include/$template/*.png -f");
shell_exec("rm $BASE_DIR/include/$template/*.gif -f");
shell_exec("rm $BASE_DIR/include/$template/*.jpg -f");
shell_exec("rm $BASE_DIR/include/$template/*.ttf -f");
shell_exec("rm $BASE_DIR/include/$template/*.log -f");
shell_exec("rm $BASE_DIR/include/$template/*.bat -f");
shell_exec("rm $BASE_DIR/include/$template/*.sh -f");
shell_exec("rm $BASE_DIR/include/$template/.htaccess -f");

@mkdir("$BASE_DIR/include/$template/user_pages/");
@mkdir("$BASE_DIR/include/$template/product_pages/");
@mkdir("$BASE_DIR/include/$template/cms_pages/");
foreach($files as $file){
    $TextIn = file_get_contents("$BASE_DIR/include/$template/$file");
       
	  $TextOut = preg_split("#<body(.*)>#", $TextIn);
	  if(!empty($TextOut[1])){
	    $Text = $TextOut[1];
	  }else{
	      $Text = $TextIn;
	  }
    
    
    $Text = str_replace("</body>", "", $Text);
    $Text = str_replace("</html>", "", $Text);
    


    $Text = str_replace("include 'footer.php'", "include(\"\$BASE_DIR/include/\$template/footer.php\")", $Text);
    $Text = str_replace("include 'header.php'", "include(\"\$BASE_DIR/include/\$template/header.php\")", $Text);
    $Text = str_replace("include 'include/categorymenu.php'", "include(\"\$BASE_DIR/include/\$template/categorymenu.php\")", $Text);
    
    $Text = str_replace("include(\"footer.php\")", "include(\"\$BASE_DIR/include/\$template/footer.php\")", $Text);
    $Text = str_replace("include(\"header.php\")", "include(\"\$BASE_DIR/include/\$template/header.php\")", $Text);
    
    
    $Text = str_replace("img/", "css/$template/", $Text);
   
                                
 $Text = str_replace("include/allliveauction.php", "$BASE_DIR/include/$template/allliveauction.php", $Text);
 $Text = str_replace("include/futureauctions.php", "$BASE_DIR/include/$template/futureauctions.php", $Text);
 $Text = str_replace("include/endedauctions.php", "$BASE_DIR/include/$template/endedauctions.php", $Text);
 $Text = str_replace("include/reverseauction.php", "$BASE_DIR/include/$template/reverseauction.php", $Text);
 $Text = str_replace("include/lowestuniqueauction.php", "$BASE_DIR/include/$template/lowestuniqueauction.php", $Text);
 $Text = str_replace("css/$template/icons/", "include/addons/icons/$template/", $Text);

    $Text = str_replace("'include/banner.php'", "'include/addons/slider/' . \$template . '/index.php'", $Text);
    
    
      shell_exec("rm $BASE_DIR/include/$template/$file -f");
    if($file == 'index.php'){
      $file = 'main.php';
    }
    if($file == 'header.php'){
    
    
    
    }
    if(file_exists("$BASE_DIR/include/snapbids/$file")){
      $handle = fopen("$BASE_DIR/include/$template/$file", "w+");
      fwrite($handle, $Text);
      fclose($handle);
    }else if(file_exists("$BASE_DIR/include/snapbids/cms_pages/$file")){
    
	$Text = preg_replace("#select (.*) from `?static_pages`? where id(.*)#", "select (.*) from `static_pages` where page = '\" . str_replace(\".php\", \"\", basename(\$_SERVER['PHP_SELF']))", $Text);
    
    
      $handle = fopen("$BASE_DIR/include/$template/cms_pages/$file", "w+");
      fwrite($handle, $Text);
      fclose($handle);   
    
    }else if(file_exists("$BASE_DIR/include/snapbids/product_pages/$file")){
       $handle = fopen("$BASE_DIR/include/$template/product_pages/$file", "w+");
      fwrite($handle, $Text);
      fclose($handle);   
    
    }else if(file_exists("$BASE_DIR/include/snapbids/user_pages/$file")){
      $handle = fopen("$BASE_DIR/include/$template/user_pages/$file", "w+");
      fwrite($handle, $Text);
      fclose($handle);    
    
    }
	
    
    
}
foreach($addons as $key => $value){
    if(is_dir("$BASE_DIR/include/addons/$value/snapbids/")){
    
	cp("$BASE_DIR/include/addons/$value/snapbids/ $BASE_DIR/include/addons/$value/$template/");
    
    }
}
$cms_pages = db_query("select distinct(page) from static_pages");
while($row = db_fetch_array($cms_pages)){

    if(!file_exists("$BASE_DIR/include/snapbids/cms_pages/$row[page].php")){
      shell_exec("cp $BASE_DIR/include/snapbids/cms_pages/aboutus.php $BASE_DIR/include/snapbids/cms_pages/$row[page].php");
    }
}


