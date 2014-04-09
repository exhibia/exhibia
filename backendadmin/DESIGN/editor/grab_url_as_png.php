<?php
header('Pragma: public');
header('Cache-Control: max-age=86400');
header('Expires: '. gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));
header('Content-Type: image/png');
// save this snippet as url_to_png.php
// usage: php url_to_png.php http://example.com

 
$md5 = md5(urldecode($_REQUEST['url']));



if(!file_exists("snaps/$md5.png")){
$command = "/opt/wkhtmltopdf/bin/wkhtmltopdf " . urldecode($_REQUEST['url']) . " snaps/$md5.pdf";

shell_exec($command);

$command = "convert snaps/$md5.pdf -append snaps/$md5.png";

exec($command, $output, $ret);
if ($ret){
    //echo "Error converting\n";
   // die;
}
 }
$img = file_get_contents("snaps/$md5.png");

echo $img;
 