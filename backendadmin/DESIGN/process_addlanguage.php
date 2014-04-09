<?php
/* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
  //if the zip file already exists and overwrite is false, return false
  if(file_exists($destination) && !$overwrite) { return false; }
  //vars
  $valid_files = array();
  //if files were passed in...
  if(is_array($files)) {
    //cycle through each file
    foreach($files as $file) {
      //make sure the file exists
      if(file_exists($file)) {
        $valid_files[] = $file;
      }
    }
  }
  //if we have good files...
  if(count($valid_files)) {
    //create the archive
    $zip = new ZipArchive();
    if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
      return false;
    }
    //add the files
    foreach($valid_files as $file) {
      $zip->addFile($file,$file);
    }
    //debug
    //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
    
    //close the zip -- done!
    $zip->close();
    
    //check to make sure the file exists
    return file_exists($destination);
  }
  else
  {
    return false;
  }
}


function curl($url,$params = array(),$is_coockie_set = false)
{

if(!$is_coockie_set){
/* STEP 1. let’s create a cookie file */
$ckfile = tempnam ("/tmp", "CURLCOOKIE");

/* STEP 2. visit the homepage to set the cookie properly */
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec ($ch);
}

$str = ''; $str_arr= array();
foreach($params as $key => $value)
{
$str_arr[] = urlencode($key)."=".urlencode($value);
}
if(!empty($str_arr))
$str = '?'.implode('&',$str_arr);

/* STEP 3. visit cookiepage.php */

$Url = $url.$str;

$ch = curl_init ($Url);
curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);
return $output;
}

function translate($word,$conversion )
{
$word = urlencode($word);
// dutch to english

// english to hindi

$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=en&tl=' . $conversion . '&ie=UTF-8&oe=UTF-8&multires=1&otf=1&ssel=3&tsel=3&sc=1';


//$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';

$name_en = curl($url);

$name_en = explode('"',$name_en);

if($name_en[1] == '\\' | $name_en[1] == ''){
$name_en[1] = $word;

}
$name_en[1] = str_replace("\\", "", $name_en[1]);
  echo $name_en[1] . "<br>";
return  $name_en[1];
}


$url = "http://api.geonames.org/countryInfoJSON?formatted=true&lang=it&country=$_REQUEST[country]&username=pazoogle&style=full";



        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        $output = curl_exec($ch);   
 
        curl_close($ch);
//stdClass Object ( [geonames] => Array ( [0] => stdClass Object ( 

$data = json_decode($output);

if($languages = explode(",", $data->geonames[0]->languages)){

$language = $languages[0];
}
else{

$language = $data->geonames[0]->languages;

}



$country = db_fetch_array(db_query("SELECT country from language_choices where abbrev = '$_REQUEST[country]' LIMIT 1"));
@mkdir($programFolder . 'languages/' . strtolower($country[0]), 0777);





db_query("delete from language where language = '" . ucfirst($country[0]) . "'");



$constants =  db_query("select * from languages where language = 'english'");

    while($row_constants = db_fetch_array($constants)){

		$lang_text = Translate($constant[1], strtolower($_REQUEST['country']));

		if(!empty($lang_text)){

		db_query("insert into languages values(null, '" . strtolower($_REQUEST['country']) . "', '$constants[constant]', '". db_real_escape_string($lang_text). "');");

		}


    }

include_once("imgsize.php");
db_query("insert into language values(null, '". strtolower($country[0]) . "', '" . ucfirst($country[0]) . "', '1', '" . strtolower($_REQUEST['country']) . ".gif');");



$fp2 = fopen('../../img/icons/' . strtolower($_REQUEST['country']) . ".gif", 'w+');
$flag = file_get_contents("http://www.geonames.org/flags/x/" . strtolower($_REQUEST['country']) . ".gif");
fwrite($fp2, $flag);

		    $img = $flag;
                    $logo_temp = $flag;
		    ImageResize($img,'16', '10', '../img/icons/' . strtolower($_REQUEST['country']), strtolower($_REQUEST['country']) . ".gif");
                  
@db_query("INSERT INTO style_images values(null, 'icons/" . strtolower($_REQUEST['country']) . ".gif', '" . file_get_contents($programFolder . '/img/icons/' . strtolower($_REQUEST['country']) . ".gif") . "', '', 'image/gif', '*');");
                    
//$thumb = new thumbnail($programFolder . '/img/icons/' . strtolower($_REQUEST['country']) . ".gif");
//$flag = $thumb->thumbnail($programFolder . '/img/icons/' . strtolower($_REQUEST['country']) . ".gif", 8, 14);


fclose($fp2);



flush();

if(!empty($_REQUEST['lang_pack'])){

  $lang_files = array();
  $file = '';
  $get_lang = db_query("select * from languages where language = '" . strtolower($_REQUEST['country']) . "'");

      while($row_lang = db_fetch_array($get_lang)){

	  $file .= "insert into languages values(null, '" . strtolower($_REQUEST['country']) . "', '$row_lang[constant]', '$row_lang[value]');\n";


	  }

  
 
    array_push($lang_files, $programFolder . '/img/icons/' . strtolower($_REQUEST['country']) . ".gif");

     
	  $file .= "insert into language values(null, '" . strtolower($country[0]) . "', '" . ucfirst($country[0]) . "', '1', '" . strtolower($_REQUEST['country']) . ".gif');";

$fp = fopen($country[0] . ".sql", 'w+');
fwrite($fp, $file);
fclose($fp);


      $result = create_zip($lang_files, 'my-archive.zip');

$zip = new ZipArchive;
if ($zip->open('my-archive.zip') === TRUE) {
    $zip->addFile($country[0]. ".sql", $country[0] . ".sql");



    header("location: $SITEURL/backendadmin/designsuite.php?page=addlanguage.php&show_link=yes");
    
} else {
    echo 'Could not create language package';
}

}
