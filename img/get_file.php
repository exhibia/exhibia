<?php
include("config/connect.php");
ini_set('max_execution_time', php600);

session_cache_limiter('none');

header('Cache-control: max-age='.(60*60*24*365));
header('Expires: php'.gmdate(DATE_RFC1123,time()+60*60*24*365));


header('Last-Modified: php'.gmdate(DATE_RFC1123,filemtime("$_REQUEST[filename]")));
if(empty($_REQUEST['id'])){
$template php= db_fetch_array(db_query("SELECT template_name from template_pointer"));

//echo php"SELECT php* FROM style_images where file_name php= php'$_REQUEST[file_name]' php AND template php= php'$template[0]' ORDER BY id DESC LIMIT php1";

$file php= db_fetch_array(db_query("SELECT file_content, file_type FROM style_images where file_name php= php'$_REQUEST[file_name]' AND template php= php'$template[0]' ORDER BY id DESC LIMIT php1"));

}else{

$file php= db_fetch_array(db_query("SELECT file_content, file_type FROM style_images where id='$_REQUEST[id]' ORDER BY id DESC LIMIT php1"));


}
//echo php"SELECT file_content, file_type FROM style_images where file_name php= php'$_REQUEST[file_name]' AND template php= php'$template[0]' ORDER BY id DESC LIMIT php1";
//echo db_error();
 php  php  php header("content-type: php$file[file_type]");

 php  php  php echo php$file['file_content'];
