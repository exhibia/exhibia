<?php





$_REQUEST['type'] = 'logo';
if(!function_exists('ImageResize')){
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

}
if(isset($_REQUEST['resize'])){

require_once("../../config/config.inc.php");


db_connect($DBSERVER, $USERNAME, $PASSWORD);

db_select_db($DATABASENAME, $db);
include("$BASE_DIR/css/styles.php");


$img = file_get_contents($_REQUEST['path'] . $_REQUEST['name']);


if(ImageResize($_REQUEST['path'] . $_REQUEST['name'], str_replace("px", "", $_REQUEST['width']), str_replace("px", "", $_REQUEST['height']), $_REQUEST['path'], $_REQUEST['name']) == true){

echo "Image has been resized";

}


exit;
}else{
include("$BASE_DIR/css/styles.php");
if($_REQUEST['type'] == 'banner'){
?>

    <table align="center" style="padding-top:10px;padding-bottom:10px;margin: 0 auto;width:800px;">
      <tr>
	    <td colspan="2" valign="top" id="msg"><?php echo $msg; ?></td>
	

      </tr>
      <tr>
  
	  <td colspan="2" valign="top">
		<table>
		
		  
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
          createUploader('preview-logo');

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
			<div id="upload-button-logo2"></div>
		      </td>
		   </tr>
		   <tr>
		      <td>
		      <h3>If you changed your logo image outside of this program(FTP or Dreamweaver) then chances are this will never work</h3>
		      <p>Image must be in PNG format</p>
		      <p>Please ensure that your logo has proper permisions in place (chown apache or chmod 775)</p>
		      <?php 
		      if(file_exists($BASE_DIR . "/css/$template/logo.png")){
			  $a_src = $SITE_URL . "css/$template/logo.png";
			  $a_path = $BASE_DIR . "/css/$template/";
		      }else{
		      
			  $a_src = $SITE_URL . "img/logo.png";
			  $a_path = $BASE_DIR. "/img/";
		      
		      }
		      
		      ?>
		   
			<img src="<?php echo $a_src; ?>" id="preview-logo" style="border: 1px solid red;" />
		      </td>
		    </tr>
		  </table>
	  </td>
	</tr>
      </table>
<script type="text/javascript" src="<?php echo $SITE_URL;?>/include/addons/uploader/js/fileuploader.js"></script>
 <script>
 function cacheBuster(url) {
		    return url.replace(/\?cacheBuster=\d*/, "") + "?cacheBuster=" + new Date().getTime().toString();
		}
       function changeLogo(url){
      
 
	document.getElementById("preview-logo").src = cacheBuster('<?php echo $a_src;?>');
	  
	  
		
	      
	}
function createUploader(divId){
        
    if(divId){
	element = divId;
    }else{
    
	element = 'upload-button-logo';
    }     
          

 var uploader = new qq.FileUploader({

    // pass the dom node (ex. $(selector)[0] for jQuery users)

    element: document.getElementById(element),
    // path to server-side upload script
      action: '<?php echo $_SITE_URL;?>include/addons/uploader/uploadify.php',
    // validation
// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
// each file size limit in bytes
// this option isn't supported in all browsers
sizeLimit: 0, // max size
minSizeLimit: 0, // min size
// set to true to output server response to console
debug: true,

<?php
$_REQUEST['type'] = 'logo';
switch($_REQUEST['type']){ 

case 'logo':
@$file = array();
$_REQUEST['logo'] = 'logo.png';
$file[0] = 'logo.png';
$_REQUEST['path'] = $BASE_DIR . "/css/$template/";
  ?>
   	   
		


<?php

break;
case 'buttons':
  ?>
   	   
prompt($(this).attr('id'));

<?php

break;
case 'button':
  ?>
   	   


<?php

break;
case 'banner':
  ?>
   	   
	<?php $_REQUEST['path'] = "$BASE_DIR/img/banner/";?> 
	<?php
	if(!empty($_REQUEST['src'])){
	$_REQUEST['file'] = basename($_REQUEST['src']);
	
	}
	?>


<?php

break;

case 'background':
  ?>
   	   


<?php

break;

}
$file = explode("?", $_REQUEST['file']);
  ?>
multiple: false,

<?php
if($_REQUEST['type'] != 'background'){
?>
  params: {'type': '<?php echo $_REQUEST['type'];?>', 'path': '<?php echo @ $_REQUEST['path'];?>', 'file': '<?php echo @ $file[0];?>'},
  
<?php
}else{
?>
    params: {'element' : $(document.getElementById('background-element')).val(), 
	      'background-color': $(document.getElementById('background-color')).val(),
	      'background-attachment': $(document.getElementById('background-attachment')).val(), 
	      'background-repeat': $(document.getElementById('background-repeat')).val(), 
	      'type': '<?php echo $_REQUEST['type'];?>', 
	      'path': '<?php echo @ $_REQUEST['path'];?>'},
<?php
}
?>


    onSubmit: function(id, fileName){


	},

    onProgress: function(id, fileName, loaded, total){
	var progress = (loaded / total) * 100;


// $("#progress-<?php echo $_GET['type'];?>").progressbar({value: progress})


    },
        onComplete: function(id, fileName, responseJSON){ 
	//if(responseJSON.responseText){
	
	//}
	$("#progress-<?php echo $_REQUEST['type'];?>").html(responseJSON);
	window.location.href = window.location.href;

 //complete_<?php echo $_GET['type'];?>( $("logo-width").val(), $("logo-height").val());

<?php

switch($_REQUEST['type']){ 

case 'logo':
  ?>
   	   
		
changeLogo();

<?php

break;

case 'button':
  ?>
   	   
		
changeButtons();

<?php

break;
case 'banner':
  ?>
   	   
	<?php $_REQUEST['path'] = "$BASE_DIR/img/banner/";?> 
	<?php
	$_REQUEST['file'] = basename($_REQUEST['src']);
	?>
changeBanner();

<?php

break;

case 'background':
  ?>
	    var color = $(document.getElementById('background-color')).val();
	    var repeat = $(document.getElementById('background-repeat')).val();
	    var attachment = $(document.getElementById('background-attachment')).val();
	    var element = $(document.getElementById('background-element')).val();	   
change_background(element, color, attachment, repeat, fileName);

<?php

break;

}
  ?>



   

	  },
        onCancel: function(id, fileName){},
        // messages
          messages: {
            typeError: "{file} has invalid extension. Only {extensions} are allowed.",
            sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
            minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
            emptyError: "{file} is empty, please select files again without it.",
            onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
        },
    showMessage: function(message, fileName, extensions, sizeLimit, minSizeLimit){
	    alert(message);
      },
      

});
      }

       
       
          createUploader('upload-button-logo2', '<?php echo $a_path;?>');
	 function resize(id_to_resize, id_from){
	      width=$('#' + id_from).css('width');
	      height=$('#' + id_from).css('height');
	      $("#" + id_to_resize ).css('background-size', width + "px " + height + "px");
	    $.get('<?php echo $SITE_URL;?>/backendadmin/DESIGN/logo.php?type=logo&resize=true&width=' + width + '&height=' + height + '&name=logo.png&path=<?php if(empty($a_path)){ echo "../../../../img/"; }else{ echo $a_path; } ?>', function(response){
	    
		  $("#msg").html(response);
		  <?php
		//  db_query("delete from style_sheets where template = '$template'");
		  ?>
	      }
	    );
	 }
//http://dev.pennyauctionsoft.com//backendadmin/DESIGN/logo.php?type=logo&resize=true&width=384px&height=64px&name=logo.png&path=/home/dev_server/public_html/css/quibids-2.0/
   $("#preview-logo").resizable({
	
	grid: [10,10],
	resize: function( event, ui ) { 
	   // resize('preview-logo');
	    
	},
	start: function( event, ui ) {
	   // resize('preview-logo');
	},
	stop: function(event, ui) { 
	
	resize('preview-logo', 'preview-logo');
	
	} });
 </script>
 
 <?php
 }
 }
 
 ?>