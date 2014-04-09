<?php
include("../../config/connect.php");
header("Content-type: image/png");
define('BIDS_TO_TAKE', 'Bids Auction');
$string = $_REQUEST['bids'] . ' ' . BIDS_TO_TAKE;
$font = 2;
$width = imagefontwidth($font)* strlen($string) ;
$height = imagefontheight($font) ;


$im = imagecreatefrompng("bids.png");
$x = imagesx($im) - $width ;
$y = imagesy($im) - $height;


		imagealphablending($im, false);
                imagesavealpha($im, true);
                $transparent = imagecolorallocatealpha($im, 255, 255, 255, 127);
                imagefilledrectangle($im, 0, 0, $w, $h, $transparent);

$backgroundColor = imagecolorallocate ($im, 255, 255, 255);   //white background
$textColor = imagecolorallocate ($im, 255, 255, 255);   //black text
imagestring ($im, $font, 5, 5,  $string, $textColor);



imagepng ($im);