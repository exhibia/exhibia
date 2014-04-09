<?php
ini_set('display_errors', 1);
setcookie("new_template", $_GET['new_template'], time()-100000000000000000000, '/');
setcookie("new_template", $_GET['new_template'], time()+100000000000000000000, '/');

include("../../../config/config.inc.php");

shell_exec("cd $BASE_DIR");

shell_exec("rm " . $BASE_DIR . '/progress.txt');
file_put_contents( $BASE_DIR . '/progress.txt', '' );



shell_exec("rm " . $BASE_DIR . "/$_COOKIE[new_template].zip");

 
 
$targetFile = fopen( $BASE_DIR . "/$_COOKIE[new_template].zip", 'w' );

 
$ch = curl_init( "http://$download_server/templates/" . "$_COOKIE[new_template].zip" );
 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
curl_setopt( $ch, CURLOPT_NOPROGRESS, false );
 
curl_setopt( $ch, CURLOPT_PROGRESSFUNCTION, 'progressCallback' );
 
curl_setopt( $ch, CURLOPT_FILE, $targetFile );
 
curl_exec( $ch );
 
fclose( $ch );
 

   
   




 
 
function progressCallback( $download_size, $downloaded_size, $upload_size, $uploaded_size )
 
{
 
static $previousProgress = 0;
 
include("../../../config/config.inc.php");


if ( $download_size == 0 ){
 
$progress = 0;
 
 
}
else{
$i = $progress;
$progress = round( $downloaded_size * 100 / $download_size );
 
if ( $progress > $previousProgress & $progress <= 100)
 
{
 
		  $previousProgress = $progress;
		  
		  $fp = fopen( $BASE_DIR . '/progress.txt', 'w+' );
		  
		  fputs( $fp, "$progress" );
		  
		  fclose( $fp );
 
}
    
    
 
}

 }
 
/*
$ctx = stream_context_create();
stream_context_set_params($ctx, array("notification" => "stream_notification_callback"));

$zip = file_get_contents("http://$download_server/templates/" . "$_REQUEST[template].zip", false, $ctx);
shell_exec("cd $BASE_DIR");
shell_exec("unzip $zip");
*/
