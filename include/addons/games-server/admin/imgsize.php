<?php
function games_image($logo,$pid,$logo_temp)
	{
		$imagename = $logo;
		$imgname = "";//$time."_".$imagename.".jpg";
		$imgthumbname = "";
		
		
		$maindest = $BASE_DIR . "/uploads/games/";
		@mkdir($maindest);

		
		
		ImageResize($logo_temp,$maindest,$imagename, 65, 65);
		

	}
	function games_icon_image($logo,$pid,$logo_temp, $BASE_DIR)
	{
		$imagename = $logo;
		
		$imgthumbname = "";
		
		
		$maindest = $BASE_DIR . "/uploads/games/icon/";
		@mkdir($maindest);

		
		
		ImageResize($logo_temp,$maindest,$imagename, 25, 25);
		
		
	}
	function games_page_image($logo,$pid,$logo_temp, $BASE_DIR)
	{
		$imagename = $logo;
		
		$imgthumbname = "";
		
		
		
		$maindest = $BASE_DIR . "/uploads/games/page/";
		@mkdir($maindest);

		
		
		ImageResize($logo_temp,$maindest,$imagename, 250, 250);
		
		$maindest = $BASE_DIR . "/uploads/games/page/small/";
		@mkdir($maindest);

		
		
		ImageResize($logo_temp,$maindest,$imagename, 125, 125);
	}
	function games_banner_image($logo,$pid,$logo_temp, $BASE_DIR)
	{
		$imagename = $logo;
		
		$imgthumbname = "";
		
		
		$maindest = $BASE_DIR . "/uploads/games/banner/";
		@mkdir($maindest);

		
		
		ImageResize($logo_temp,$maindest,$imagename, 680, 240);
		

	}
	function games_categories_image($logo,$pid,$logo_temp, $BASE_DIR)
	{
		$imagename = $logo;
		
		$imgthumbname = "";
		
		
		$maindest = $BASE_DIR . "/uploads/games/";
		@mkdir($maindest);

		
		
		ImageResize($logo_temp,$maindest,$imagename, 175, 140);
		

	}
	
        function deleteImage($picture){
            if($picture!=''){
                if(file_exists($BASE_DIR . '/uploads/games/'.$picture)){
                    unlink($BASE_DIR . '/uploads/games/'.$picture);
                }
          
            }
        }
	function deleteSliderImage($picture){
            if($picture!=''){
                if(file_exists($BASE_DIR . '/uploads/games/banner/'.$picture)){
                    unlink($BASE_DIR . '/uploads/games/banner/'.$picture);
                }
          
            }	}
	function deletePageImage($picture){
            if($picture!=''){
                if(file_exists($BASE_DIR . '/uploads/games/page/'.$picture)){
                    unlink($BASE_DIR . '/uploads/games/page/'.$picture);
                }
		if(file_exists($BASE_DIR . '/uploads/games/page/small/'.$picture)){
                    unlink($BASE_DIR . '/uploads/games/page/small/'.$picture);
                }
            }
	}
	function deleteIconImage($picture){
            if($picture!=''){
                if(file_exists($BASE_DIR . '/uploads/games/icon/'.$picture)){
                    unlink($BASE_DIR . '/uploads/games/icon/'.$picture);
                }
          
            }
	}             
function ImageResize($img,$dest,$filename,$w,$h)
{

	//$img = $_GET['img'];
	//$percent = $_GET['percent'];
	/*$constrain = $_GET['constrain'];
	$w = $_GET['w'];
	$h = $_GET['h'];*/
	//Copy Org Image To Destination
	//@copy($img,$dest.'/'.$filename);
	
	
	// get image size of img
	$x = @getimagesize($img);
	
	// image width
	$sw = $x[0];
	// image height
	$sh = $x[1];
	
	if ($percent > 0) {
		// calculate resized height and width if percent is defined
		$percent = $percent * 0.00;
		$w = $sw * $percent;
		$h = $sh * $percent;
	} else {
		if (isset ($w) AND !isset ($h)) {
			// autocompute height if only width is set
			$h = (100 / ($sw / $w)) * .01;
			$h = @round ($sh * $h);
		} elseif (isset ($h) AND !isset ($w)) {
			// autocompute width if only height is set
			$w = (100 / ($sh / $h)) * .01;
			$w = @round ($sw * $w);
		} elseif (isset ($h) AND isset ($w) AND isset ($constrain)) {
			// get the smaller resulting image dimension if both height
			// and width are set and $constrain is also set
			$hx = (100 / ($sw / $w)) * .01;
			$hx = @round ($sh * $hx);
	
			$wx = (100 / ($sh / $h)) * .01;
			$wx = @round ($sw * $wx);
	
			if ($hx < $h) {
				$h = (100 / ($sw / $w)) * .01;
				$h = @round ($sh * $h);
			} else {
				$w = (100 / ($sh / $h)) * .01;
				$w = @round ($sw * $w);
			}
		}
	}
	
	$im = @ImageCreateFromJPEG ($img) or // Read JPEG Image
	$im = @ImageCreateFromPNG ($img) or // or PNG Image
	$im = @ImageCreateFromGIF ($img) or // or GIF Image
	$im = false; // If image is not JPEG, PNG, or GIF
	echo $im;
	
	if (!$im) {
		// We get errors from PHP's ImageCreate functions...
		// So let's echo back the contents of the actual image.
		readfile ($img);
	} else {
		// Create the resized image destination
		$thumb = @ImageCreateTrueColor ($w, $h);
		
		
		
// enable alpha blending on the destination image.
imagealphablending($thumb, true);

// Allocate a transparent color and fill the new image with it.
// Without this the image will have a black background instead of being transparent.
$transparent = imagecolorallocatealpha( $thumb, 0, 0, 0, 127 );
imagefill( $thumb, 0, 0, $transparent );


		// Copy from image source, resize it, and paste to image destination
		@ImageCopyResampled ($thumb, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);
		//@imagecopyresized($this->dest_image, $this->src_image, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
		// Output resized image
imagealphablending($thumb, false);

// save the alpha
imagesavealpha($thumb,true); 		
		echo $thumb;
		@imagepng ($thumb,$dest.'/'.$filename);
		//if($thumb)copy($thumb,'thumb_'.$filename);
	}
}








?>