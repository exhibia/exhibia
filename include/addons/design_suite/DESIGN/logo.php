<?php

    header("Pragma: no-cache");
    header("Cache: no-cache");
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    
    
require_once("../../../../config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD);

db_select_db($DATABASENAME);


if(!empty($_REQUEST['slider_type'])){


      if($_REQUEST['slider_type'] == 'jquery'){
	    shell_exec("cp ../slider.php ../../../../slider.php");

	      if( db_num_rows(db_query("select * from sitesetting where name = 'slider' and value = 'slider.php'")) == 0){
		    db_query("insert into sitesetting values(null, 'slider', 'slider.php');");
	      
		}else{
		
		
		
		}
		
	  }else{
	  db_query("delete from sitesetting where name = 'slider' and value = 'slider.php'");
	  db_query("insert into sitesetting values(null, 'slider', '$_REQUEST[slider_type]');");
	  
	  
	  }


}else{

function ImageResize($img,$w,$h,$dest,$filename)
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
	
	if (!$im) {
		// We get errors from PHP's ImageCreate functions...
		// So let's echo back the contents of the actual image.
		readfile ($img);
	} else {
		// Create the resized image destination
		$thumb = @ImageCreateTrueColor ($w, $h);
		
		imagealphablending($thumb, false);
                imagesavealpha($thumb, true);
                $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
                imagefilledrectangle($thumb, 0, 0, $w, $h, $transparent);
                
		// Copy from image source, resize it, and paste to image destination
	ImageCopyResampled ($thumb, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);
		//@imagecopyresized($this->dest_image, $this->src_image, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
		// Output resized image
		
	ImagePNG ($thumb,$dest.$filename);
		//if($thumb)copy($thumb,'thumb_'.$filename);
		return true;
	}
}


if(isset($_REQUEST['resize'])){





$img = file_get_contents($_REQUEST['path'] . $_REQUEST['name']);


if(ImageResize($_REQUEST['path'] . $_REQUEST['name'],$_REQUEST['width'],$_REQUEST['height'], $_REQUEST['path'], $_REQUEST['name']) == true){

echo "Image has been resized";

}



}else{

if($_REQUEST['type'] == 'banner'){
?>

<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
    <table align="center" style="padding-top:10px;padding-bottom:10px;margin: 0 auto;width:800px;">
      <tr>
	    <td colspan="2" valign="top" id="msg"><?php echo $msg; ?></td>
	

      </tr>
      <tr>
  
	  <td colspan="2" valign="top">
		<table>
		
		  <tr>
		    <td>
			<?php include("../../uploader/uploader.php");?>
	      
		      </td>
		      <td>Choose Slider Type: 
			  <select id="choose-banner" onchange="choose_slider_type();">
			    <option value=""></option>
			    <option value="flash">Flash</option>
			    <option value="jquery">Jquery</option>
			  </select>
		      </td>
		   </tr>
		   <tr>
		      <td colspan="2">
		      
		      <?php $url = explode("?", $_REQUEST['src']); ?>
			<img src="<?php echo $SITE_URL;?>img/banner/<?php echo basename($url[0]);?>" id="preview-logo" />
		      </td>
		    </tr>
		  </table>
	  </td>
	  
	</tr>
      </table>

 <script>
          createUploader('#upload-button-logo');

 </script>
 
 
 <?php



}else{
 ?>


    <table align="center" style="padding-top:10px;padding-bottom:10px;margin: 0 auto;width:800px;">
      <tr>
	    <td colspan="2" valign="top" id="msg"><?php echo $msg; ?></td>
	

      </tr>
      <tr>
  
	  <td colspan="2" valign="top">
		<table>
		
		  <tr>
		    <td>
			<?php include("../../uploader/uploader.php");?>
	      
		      </td>
		   </tr>
		   <tr>
		      <td>
			<img src="<?php echo $SITE_URL;?>img/logo.png" id="preview-logo" />
		      </td>
		    </tr>
		  </table>
	  </td>
	</tr>
      </table>

 <script>
          createUploader('#upload-button-logo');
	 function resize(id_to_resize, id_from){
	 
	      width=$('#' + id_from).css('width');
	      height=$('#' + id_from).css('height');
	      $("#" + id_to_resize ).css('background-size', width + " " + height);
	    $.get('include/addons/design_suite/DESIGN/logo.php?resize=true&width=' + width + '&height=' + height + '&name=logo.png&path=../../../../img/', function(response){
	    
		  $("#msg").html(response);
	      }
	    );
	 }

   $("#preview-logo").resizable({
	aspectRatio: true,
	alsoResize: "#logo",
	ghost: true,
	grid: [10,10],
	resize: function( event, ui ) { 
	    resize('logo a ', 'preview-logo');
	    
	},
	start: function( event, ui ) {
	    resize('logo a', 'preview-logo');
	},
	stop: function(event, ui) { 
	
	resize('logo a', 'preview-logo');
	
	} });
 </script>
 
 <?php
 }
 }
 }
 ?>