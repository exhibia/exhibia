<?php
include("../../config/config.inc.php");
header("Content-type: image/png");
$string = $_REQUEST['time'];
$font = 5;
$width = imagefontwidth($font)* strlen($string) ;
$height = imagefontheight($font) ;


$im = imagecreatefrompng("clock.png");
$x = imagesx($im) - $width ;
$y = imagesy($im) - $height;


		imagealphablending($im, false);
                imagesavealpha($im, true);
                $transparent = imagecolorallocatealpha($im, 255, 255, 255, 127);
                imagefilledrectangle($im, 0, 0, $w, $h, $transparent);

$backgroundColor = imagecolorallocate ($im, 255, 255, 255);   //white background
$textColor = imagecolorallocate ($im, 255, 255, 255);   //black text
imagestring ($im, $font, 18, 18,  $string, $textColor);



imagepng ($im);