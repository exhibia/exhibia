<?php
    header("Pragma: no-cache");
    header("Cache: no-cache");
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
$_REQUEST['type'] = 'banner';
include("../../../config/config.inc.php");

?>
<style>
.qq-uploader{
background:red!important;
}

</style>
<?php
if(!empty($_REQUEST['for'])){
if(!empty($_REQUEST['delete_banner'])){

unlink("$BASE_DIR/". $_REQUEST['delete_banner']);
unlink("$BASE_DIR/include/addons/slider/$template/img/". $_REQUEST['delete_banner']);
echo "<li style=\"display:inline;\">" . $_REQUEST['delete_banner'] . " Deleted</li>";

 


  $imgpath = dir("$BASE_DIR/include/addons/slider/$template/img/");
	$i = 1;
        while (false !== ($entry = $imgpath->read())) {
            if (is_file($imgpath->path . '/' . $entry)) {
                if (preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $entry)) {
                if($entry ==  $_REQUEST['delete_banner']){
                
                unlink($imgpath->path . '/' . $entry);
                
                }else{
		  ?>
		  
		    <li style="display:inline;">
			
			  <img src="<?php echo $SITE_URL . '/include/addons/slider/' . $template . '/img/' . $entry; ?>" style="width:200px; height:auto;" id="banner[<?php echo $i;?>]" />
			
			 <input type="radio" onclick="javascript: ajax_PAS('include/addons/design_suite/DESIGN/logo.php?type=banner&src=' + document.getElementById('banner[<?php echo $i;?>]').src, 'get=sliderform', 'get','edit_inner');" style="position:relative;left:-20px;z-index:5000;" />
			
		      <img src="include/addons/design_suite/img/delete.png" style="width:15px;height:auto;position:relative;left:-40px;top:-30px;z-index:5000;" onclick="ajax_PAS('<?php echo $SITE_URL;?>include/addons/design_suite/uploader.php?', 'for=flash_banner&delete_banner=<?php echo $entry;?>', 'get', 'banners-preview'); "/>
		    </li>
		  
		  <?php
		  
		  }
                }
            }
	    $i++;
        }


 


}else{
 ?>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">

 <center>
 
	      <table align="center" id="language_form" style="width:100%;">
		  <tr><td colspan="3" style="width:50%;">
		   
			      <h2>Edit <?php echo $_REQUEST['type'] = 'banner'; ?> Images</h2>
			  </td>
			  <td colspan="3" style="width:50%;" align="right">
			      <?php include($BASE_DIR . "/uploader/uploader.php");?>
			  </td>
			
		     
		   </tr>
		   <tr>
		   <td colspan="6" style="width:100%;max-height:80px;" align="left">
   <ul style="display:inline;list-style-type:none;width:800px;max-height:80px;" id="banners-preview">
 <?php


  $imgpath = dir($BASE_DIR . '/include/addons/slider/' . $template . '/img/');
	$i = 1;
        while (false !== ($entry = $imgpath->read())) {
            if (is_file($imgpath->path . '/' . $entry)) {
                if (preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $entry)) {
		  ?>
		  
		    <li style="display:inline;max-height:80px;">
			
			  <img src="<?php echo $SITE_URL . '/include/addons/slider/' . $template . '/img/' . $entry; ?>" style="width:200px; height:auto;max-height:80px;" id="banner[<?php echo $i;?>]" />
			
			 <input type="radio" onclick="javascript: ajax_PAS('include/addons/design_suite/DESIGN/logo.php?type=banner&src=' + document.getElementById('banner[<?php echo $i;?>]').src, 'get=sliderform', 'get','edit_inner');" style="position:relative;left:-50px;z-index:5000;" />
			
		      <img src="include/addons/design_suite/img/delete.png" style="width:15px;height:auto;position:relative;left:-90px;top:-30px;z-index:5000;" onclick="ajax_PAS('<?php echo $SITE_URL;?>include/addons/design_suite/uploader.php?', 'for=flash_banner&delete_banner=<?php echo $entry;?>', 'get', 'banners-preview'); "/>
		    </li>
		  
		  <?php
                }
            }
	    $i++;
        }


 ?>
 </ul>
		</td>
	    </tr>
	  </table>
	  <script>
      function cacheBuster(url) {
		    return url.replace(/\?cacheBuster=\d*/, "") + "?cacheBuster=" + new Date().getTime().toString();
		}
		
		
      function changeButtons(){
      
	document.getElementById("<?php echo $_REQUEST['image'];?>").src = cacheBuster('<?php echo $SITE_URL;?>include/addons/design_suite/<?php echo $_REQUEST['path'];?>/<?php echo basename($_REQUEST['file']);?>');
		$("img").each(function() {
		
			new_url = this.src;
			
			  
			
		    this.src = cacheBuster(new_url);
		    
		    
		});

		$("button").each(function() {
		    var bg_img = $(this).css("background-image");
		    if (bg_img !== "none") {
			var url = /url\((.*)\)/i.exec(bg_img);
			if (url) {
			new_url = url[1];
			
			 
			$(this).css("background-image", "url(" + cacheBuster(new_url) + ")");
			}
		    }
		}); 
		$("span").each(function() {
		    var bg_img = $(this).css("background-image");
		    if (bg_img !== "none") {
			var url = /url\((.*)\)/i.exec(bg_img);
			if (url) {
			new_url = url[1];
			
			$(this).css("background-image", "url(" + cacheBuster(new_url) + ")");
			}
		    }
		}); 
		$(".button").each(function() {
		    var bg_img = $(this).css("background-image");
		    if (bg_img !== "none") {
			var url = /url\((.*)\)/i.exec(bg_img);
			if (url) {
			new_url = url[1];
			
			  
			$(this).css("background-image", "url(" + cacheBuster(new_url) + ")");
			}
		    }
		}); 
		$("p").each(function() {
		    var bg_img = $(this).css("background-image");
		    if (bg_img !== "none") {
			var url = /url\((.*)\)/i.exec(bg_img);
			if (url) {
			new_url = url[1];
			
			$(this).css("background-image", "url(" + cacheBuster(new_url) + ")");
			}
		    }
		}); 
		$("img, input[type=image]").each(function() {
		    	new_url = this.src;
			
			
			
		    this.src = cacheBuster(new_url);
		  });     
      
      
      
      
      }
		
      function changeBackgrounds(){
      
		$("*").each(function() {
		
		  var bg_img = $(this).css("background-image");
		    if (bg_img !== "none") {
			var url = /url\((.*)\)/i.exec(bg_img);
			if (url) {
			new_url = url[1];
			
			
			$(this).css("background-image", "url(" + cacheBuster(new_url) + ")");
			}
		    }
		    
		});    
      
      
      }
      function changeBanner(img){
      
 
	$.get(cacheBuster('include/addons/design_suite/uploader.php?for=flash_banner'), function(response){
	
	    $('#edit_inner').html(response);
	
	});
	      
	}  
      function changeLogo(){
      
 
	document.getElementById("preview-logo").src = cacheBuster('<?php echo $SITE_URL;?>img/logo.png');
	  
	  
		$("#logo a").each(function() {
		
		  var bg_img = $(this).css("background-image");
		    if (bg_img !== "none") {
			var url = /url\((.*)\)/i.exec(bg_img);
			if (url) {
			new_url = url[1];
			
			
			$(this).css("background-image", "url(" + cacheBuster(new_url) + ")");
			}
		    }
		    
		});
	      
	}
        function createUploader(){
        
        
          

 var uploader = new qq.FileUploader({

    // pass the dom node (ex. $(selector)[0] for jQuery users)
    element: document.getElementById('upload-button-logo'),
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

switch($_REQUEST['type']){ 

case 'logo':
  ?>
   	   
		


<?php

break;

case 'button':
  ?>
   	   


<?php

break;
case 'banner':
  ?>
   	   
	<?php $_REQUEST['path'] = "../../../../img/banner/";?> 
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
	
	
	//$("#progress-<?php echo $_GET['type'];?>").html(responseJSON);

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
   	   
	<?php $_REQUEST['path'] = "../../../img/banner/";?> 
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
$('#alert_message_content').html(responseText);
$('#alert_message').dialog();


   

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
      }

});
      }

    
</script>

	  <script>
          createUploader('#upload-button-logo');

	  </script>
	  <span style="background-color:#fdfdfd!important;border-radius:6px;top:-130px;left:300px;position:relative;">
	  <div id="upload-button-logo" ></div>
	  </span>
	  </center>
 <?php

}




}else{

$protected = array("bidcacti", "wavee", "sticky", "quibids", "snapbids", "upbids", "kooldeal", "black_buttons", "blue_buttons", "orange_buttons", "red_buttons", "yellow_buttons", "green_buttons", "zipbids", "falcon_bids");


$num = 0;
      foreach($protected as $value){
      
	if(preg_match("/$value/", $_GET['path'])){
	
	$num = $num+1;
      
	}
      
      }
      
	if($num == 0){
	
	
	include("../uploader/uploader.php");
	
	
	
	}else{
	
	
	echo "This set is protected content if you would like to customize it then convert it to a custom set first";
	
	
	}
	
}

?>
 <script>
 
		$("img").each(function() {
		
			new_url = this.src;
			
			  
			
		    this.src = cacheBuster(new_url);
		    
		    
		});
</script>
<style>
.qq-uploader{
background:red!important;
}

</style>

<?php
