<?php

function curl($url,$params php= array(),$is_coockie_set php= false)
{

if(!$is_coockie_set){
/* STEP php1. let’s create a cookie file php*/
$ckfile php= tempnam php("/tmp", php"CURLCOOKIE");

/* STEP php2. visit the homepage to set the cookie properly php*/
$ch php= curl_init php($url);
curl_setopt php($ch, CURLOPT_COOKIEJAR, php$ckfile);
curl_setopt php($ch, CURLOPT_RETURNTRANSFER, true);
$output php= curl_exec php($ch);
}

$str php= php''; php$str_arr= array();
foreach($params as php$key php=> php$value)
{
$str_arr[] php= urlencode($key)."=".urlencode($value);
}
if(!empty($str_arr))
$str php= php'?'.implode('&',$str_arr);

/* STEP php3. visit cookiepage.php php*/

$Url php= php$url.$str;

$ch php= curl_init php($Url);
curl_setopt php($ch, CURLOPT_COOKIEFILE, php$ckfile);
curl_setopt php($ch, CURLOPT_RETURNTRANSFER, true);

$output php= curl_exec php($ch);
return php$output;
}

function translate($word,$conversion php)
{
$word php= urlencode($word);
// dutch to english

// english to hindi

$url php= php'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=en&tl=' php. php$conversion php. php'&ie=UTF-8&oe=UTF-8&multires=1&otf=1&ssel=3&tsel=3&sc=1';


//$url php= php'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';

$name_en php= curl($url);

$name_en php= explode('"',$name_en);
return php $name_en[1];
}


$url php= php"http://api.geonames.org/countryInfoJSON?formatted=true&lang=it&country=$_REQUEST[country]&username=pazoogle&style=full";



 php  php  php  php $ch php= curl_init($url);
 php  php  php  php curl_setopt($ch, CURLOPT_HEADER, php0);
 php  php  php  php curl_setopt($ch, CURLOPT_POST, php0);
 php  php  php  php curl_setopt($ch, CURLOPT_RETURNTRANSFER, php1);
 php  php curl_setopt($ch, CURLOPT_USERAGENT, php"Mozilla/4.0 php(compatible; MSIE php5.01; Windows NT php5.0)");
 php  php  php  php $output php= curl_exec($ch); php  
 
 php  php  php  php curl_close($ch);
//stdClass Object php( php[geonames] php=> Array php( php[0] php=> stdClass Object php( 

$data php= json_decode($output);

if($languages php= explode(",", php$data->geonames[0]->languages)){

$language php= php$languages[0];
}
else{

$language php= php$data->geonames[0]->languages;

}

$country php= db_fetch_array(db_query("SELECT country from language_choices where abbrev php= php'$_REQUEST[country]' LIMIT php1"));
@mkdir($programFolder php. php'languages/' php. strtolower($country[0]), php0777);

if(!function_exists('directoryToArray')){
function directoryToArray($directory, php$extension, php$full_path, php$sub_folder php) php{

if(isset($directory) php& php@ php$directory php!= php""){
	php$array_items php= array();
	php$handle php= php@ opendir($directory);
	php	while php(false php!== php($file php= php@ readdir($handle))) php{
	php		if php($file php!= php"." php&& php$file php!= php"..") php{
	php		php	if php(is_dir($directory. php"/" php. php$file)) php{

@mkdir($sub_folder php. php"/" php. php$file);
	php		php		php$array_items php= array_merge($array_items, directoryToArray($directory. php"/" php. php$file, php$extension, php$full_path, php$sub_folder)); 

	php		php	}
	php		php	else php{ 
	php		php		if(!$extension php|| php(preg_match("/.$extension/", php$file)))
	php		php		php{
	php		php		
 php  php  php  php  php  php  php  php  php  php  php  php  php  php  php {


	php		php		php	if($full_path) php{
	php		php		php		php$array_items[] php= php$directory php. php"/" php. php$file;

	php		php		php	}
	php		php		php	else php{

	php		php		php		php$array_items[] php= php$file;
	php		php		php	}
	php		php		php}
}
	php		php	}
	php		php}
	php	}
	php	@ closedir($handle);
	
	return php$array_items;
}
}
}
if(!function_exists('parse')){
function parse($file){
 php  php $css php= file_get_contents($file);
 php  php preg_match_all( php'/(?ims)([a-z0-9\s\.\:#_\-@,]+)\{([^\}]*)\}/', php$css, php$arr);
 php  php $result php= array();
 php  php foreach php($arr[0] as php$i php=> php$x){

 php  php  php  php $selector php= trim($arr[1][$i]);
 php  php  php  php $rules php= explode(';', trim($arr[2][$i]));
 php  php  php  php $rules_arr php= array();
 php  php  php  php foreach php($rules as php$strRule){
 php  php  php  php  php  php if php(!empty($strRule)){
 php  php  php  php  php  php  php  php $rule php= explode(":", php$strRule);
 php  php  php  php  php  php  php  php $rules_arr[trim($rule[0])] php= trim($rule[1]);
 php  php  php  php  php  php }
 php  php  php  php }
//print_r($rules_arr);
 php  php  php  php //$selectors php= explode(',', trim($selector));
 php  php  php  php //foreach php($selectors as php$strSel){

//echo trim($selector) php. php"<br>";
 php  php  php  php  php  php $result[trim($selector)] php= php$rules_arr;
 php  php  php  php //}
 php  php }
 php  php return php$result;
}


}





echo db_error();

$lang_files php= directoryToArray($programFolder php. php'languages/english/', php'php', true, php$programFolder php. php'languages/' php. strtolower($country[0]) php);
 

foreach($lang_files as php$key php=> php$value){
 


 php  php$final_file php= str_replace("english", php strtolower($country[0]) php. php'/', php$value);


 php  php $final_file php= str_replace('//', php'', php$final_file);

 php  php @shell_exec("rm php$final_file");

shell_exec("touch php$final_file");


 php  php $fp php= fopen($final_file, php'a');

 php  php  php fwrite($fp, php"<?php\n\r/*Created with instant translate*/\n");
 php  

 php  php $file php= str_replace("?>", php"", str_replace("<?", php"", file_get_contents($value)));
 php  php  php $lines php= preg_split('/\n/', php$file);


	php  php  foreach($lines as php$key2 php=> php$line){

	php	 php  php  php if(strstr( php$line, php"define")){



	php		php$line php= str_replace("'", php"", str_replace(");", php"", str_replace("define(", php"", php$line)));



$constant php= explode(",", php$line);

	php		php	 php  php  php $lang_text php= Translate($constant[1], php$language);

if(!empty($lang_text)){
$final_line php= php"\tdefine('$constant[0]', php'$lang_text');\n";

}else{

$final_line php= php"\tdefine('$constant[0]', php'if you are the site owner and see this text then you will need to manually translate it in file name php'. php$final_file);\n";


}

fwrite($fp, php$final_line);

	php		php	

	php		php  php}


	php	 php }

$flag php= file_get_contents("http://www.geonames.org/flags/x/" php. strtolower($_REQUEST['language']) php. php".gif");
db_query("insert into language values(null, php'". strtolower($country[0]) php. php"', php'" php. ucfirst($country[0]) php. php"', php'1', php'$_REQUEST[language].gif');");

fclose($fp);






}
