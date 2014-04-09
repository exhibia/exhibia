<?php

	function forum_image($logo,$pid,$logo_temp)
	{
		$imagename = $logo;
		$imgname = "";//$time."_".$imagename.".jpg";
		$imgthumbname = "";
		
		
		$maindest = "../uploads/forum_image/";
		@mkdir($maindest);

		
		
		ImageResize($logo_temp,$maindest,$imagename, 65, 65);
		

	}
	function rank_image($logo,$pid,$logo_temp)
	{
		$imagename = $logo;
		$imgname = "";//$time."_".$imagename.".jpg";
		$imgthumbname = "";
		
		
		$maindest = "../uploads/rank_image/";
		

		
		
		ImageResize($logo_temp,$maindest,$imagename, 125, 125);
		

	}
	function categoryimage($logo,$pid,$logo_temp)
	{
		$imagename = $logo;
		$imgname = "";//$time."_".$imagename.".jpg";
		$imgthumbname = "";
		
		
		$maindest = "../uploads/products/";
		$dest = "../uploads/products/thumbs/";
		$dest1 = "../uploads/products/thumbs_big/";		
		$dest2 = "../uploads/products/thumbs_small/";		
		
		$popupdest = "../uploads/products/popup/";

		
		
		ImageResize($logo_temp,$maindest,$imagename, 600, 300);
		ImageResize($logo_temp,$dest,'thumb_'.$imagename, 200, 100);
		ImageResize($logo_temp,$dest1,'thumbbig_'.$imagename, 400, 200);
		ImageResize($logo_temp,$dest2,'thumbsmall_'.$imagename, 75, 38);
		ImageResize($logo_temp,$popupdest,'popup_'.$imagename, 300, 150);
		
		
		$imgname = $imagename;
		$imgthumbname = 'thumb_'.$imagename;
		$imgpopup = "popup_".$imagename;

	}
	function productimage($logo,$pid,$logo_temp)
	{
		$imagename = $logo;
		$imgname = "";//$time."_".$imagename.".jpg";
		$imgthumbname = "";
		
		
		$maindest = "../uploads/products/";
		$dest = "../uploads/products/thumbs/";
		$dest1 = "../uploads/products/thumbs_big/";		
		$dest2 = "../uploads/products/thumbs_small/";		
		
		$popupdest = "../uploads/products/popup/";

		
		
		ImageResize($logo_temp,$maindest,$imagename, 275, 350);
		ImageResize($logo_temp,$dest,'thumb_'.$imagename, 60, 80);
		ImageResize($logo_temp,$dest1,'thumbbig_'.$imagename, 90, 120);
		ImageResize($logo_temp,$dest2,'thumbsmall_'.$imagename, 75, 100);
		ImageResize($logo_temp,$popupdest,'popup_'.$imagename, 300, 500);
		
		
		$imgname = $imagename;
		$imgthumbname = 'thumb_'.$imagename;
		$imgpopup = "popup_".$imagename;

	}

        function deleteImage($picture){
            if($picture!=''){
                if(file_exists('../uploads/products/'.$picture)){
                    unlink('../uploads/products/'.$picture);
                }
                if(file_exists('../uploads/products/thumbs/thumb_'.$picture)){
                    unlink('../uploads/products/thumbs/thumb_'.$picture);
                }
                if(file_exists('../uploads/products/thumbs_big/thumbbig_'.$picture)){
                    unlink('../uploads/products/thumbs_big/thumbbig_'.$picture);
                }
                if(file_exists('../uploads/products/thumbs_small/thumbsmall_'.$picture)){
                    unlink('../uploads/products/thumbs_small/thumbsmall_'.$picture);
                }
                if(file_exists('../uploads/products/popup/popup_'.$picture)){
                    unlink('../uploads/products/popup/popup_'.$picture);
                }
            }
        }

function communityimage($logo,$pid,$logo_temp)
{
	$imagename = $logo;
	$imgname = "";//$time."_".$imagename.".jpg";
	$imgthumbname = "";

	$dest = "../uploads/community/thumb/";
	//$dest1 = "../uploads/community/thumbs_big/";		
	//$dest2 = "../uploads/community/thumbs_small/";		
	$maindest = "../uploads/community/popup/";
	$popupdest = "../uploads/community/";
	ImageResize($logo_temp,$maindest,'popup_'.$imagename, 300, 500);
	ImageResize($logo_temp,$dest,'thumb_'.$imagename, 60, 80);
	//ImageResizenewBig($logo_temp,$dest1,'thumbbig_'.$imagename);
	//ImageResizenewSmall($logo_temp,$dest2,'thumbsmall_'.$imagename);
	ImageResize($logo_temp,$popupdest,$imagename, 100, 120);
	$imgname = $imagename;
	$imgthumbname = 'thumb_'.$imagename;
	$imgpopup = "popup_".$imagename;
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
		$percent = $percent * 0.01;
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