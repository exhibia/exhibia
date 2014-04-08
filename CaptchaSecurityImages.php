<?php
ini_set('display_errors', 1);


/*
* File: CaptchaSecurityImages.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 03/08/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-captcha.php
* 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
* GNU General Public License for more details: 
* http://www.gnu.org/licenses/gpl.html
*
*/
 require(dirname(__FILE__) . "/config/config.inc.php");
  db_query("CREATE TABLE IF NOT EXISTS `captcha_codes` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `captcha_code` varchar(200) NOT NULL,
		  `ip_address` varchar(200) NOT NULL,
		  `datetime` varchar(200) NOT NULL,
		  PRIMARY KEY (`id`)
	    ) 
	    ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;
    ");
    echo db_error();
	function executeQueries($code){
	
	 
	  
	  db_query("delete from captcha_codes where ip_address = '$_SERVER[REMOTE_ADDR]'");
	  db_query("insert into captcha_codes values(null, '$code', '$_SERVER[REMOTE_ADDR]', '" . time() . "');");
	  echo db_error();
	  
	}


	function CaptchaSecurityImages($width='120',$height='40',$characters='6') {
	$font = 'monofont.ttf';

		
		$possible = '23456789bcdfghjkmnpqrstvwxyz'; 
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
			
		}
		
		executeQueries($code);
		
		
		
		
		
		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = @imagecreate($width, $height) or die('Cannot Initialize new GD image stream');
		/* set the colours */
		$background_color = imagecolorallocate($image, 255, 255, 255);
		$text_color = imagecolorallocate($image, 20, 40, 100);
		$noise_color = imagecolorallocate($image, 100, 120, 180);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $font, $code);
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code);
		/* output captcha image to browser */
		imagejpeg($image);
		imagedestroy($image);
		$_SESSION['security_code'] = $code;
		
		//echo "$DATABASENAME";
		
	}



$width = isset($_GET['width']) ? $_GET['width'] : '120';
$height = isset($_GET['height']) ? $_GET['height'] : '40';
$characters = isset($_GET['characters']) ? $_GET['characters'] : '6';
header('Content-Type: image/jpeg');
CaptchaSecurityImages($width,$height,$characters);

?>