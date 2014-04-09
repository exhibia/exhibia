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
function createUploader(path){
        
        if(!path){
	  path = '<?php echo @ $_REQUEST['path'];?>';
        }
        
          

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
  params: {'type': '<?php echo $_REQUEST['type'];?>', 'path': path, 'file': '<?php echo @ $file[0];?>'},
  
<?php
}else{
?>
    params: {'element' : $(document.getElementById('background-element')).val(), 
	      'background-color': $(document.getElementById('background-color')).val(),
	      'background-attachment': $(document.getElementById('background-attachment')).val(), 
	      'background-repeat': $(document.getElementById('background-repeat')).val(), 
	      'type': 'background', 
	      'path': '<?php echo $BASE_DIR;?>/css/<?php echo $template;?>/'},
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
change_background( element, color, attachment, repeat, fileName);

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
      }

});
      }

    
</script>
<?php
if($_SESSION['admin'] >= 1 & empty($backend)){
?>
    <table width="100%">
	    <tr>
		<td id="upload-button-logo">
			    <noscript>
				    <p>Please enable JavaScript to use file uploader.</p>
				    <!-- or put a simple form for upload here -->
			    </noscript>
		   
		</td>
		<td id="progress-<?php echo $_GET['type'];?>" style="max-width:300px;">
		</td>
	    </tr>
	 </table>

    <script type="text/javascript">
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
      
 alert('Success');
	document.getElementById("preview-logo").src = cacheBuster(new_url);
	  
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
function createUploader(divId){
        
    if(divId){
	'#preview_frame ' + element = divId;
    }else{
    
	'#preview_frame ' + element = 'upload-button-logo';
    }     
          

 var uploader = new qq.FileUploader({

    // pass the dom node (ex. $(selector)[0] for jQuery users)

    '#preview_frame ' + element: document.getElementById('#preview_frame ' + element),
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
    params: {'element' : $(document.getElementById(element)).val(), 
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
      }

});
      }

        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load
       createUploader();
    </script>
    
<?php } else{ ?>


    <script type="text/javascript">
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
      function changeLogo(url){
      
 
	document.getElementById("preview-logo").src = cacheBuster(url + '/logo.png');
	  
	  
		$("#logo a").each(function() {
		
		  var bg_img = $(this).css("background-image");
		    if (bg_img !== "none") {
		    
		    if(!url){
			var url = /url\((.*)\)/i.exec(bg_img);
			if (url) {
			new_url = url[1];
			
			
			$(this).css("background-image", "url(" + cacheBuster(new_url) + ")");
			}
		    }
		    }
		});
	      
	}
	
	function image_no_image(){

    
var element = document.getElementById('background-element').value;
var backgroundImg;
backgroundImg = $('#hiddenImg').val();

    
    if($("#no-image").attr('checked') == true){
	$("#bg-submit").css('display', 'none');
	$('#preview_frame ' + element).css('background-image', backgroundImg);
	$('#upload-box').css('display', 'block');
    
    }else{
	$("#bg-submit").css('display', 'block');
	$('#preview_frame ' + element).css('background-image', 'url()');
	$('#upload-box').css('display', 'none');
    
    }



}
	function update_bg(){
var element = document.getElementById('background-element').value;
image_no_image();
    

    color = document.getElementById('background-color').value;
    repeat = $("#background-repeat").val();
    attachment = $("#background-attachment").val();
    
    
    
      $('#preview_frame').contents().find(element).css('background-repeat', repeat);
      
      $('#preview_frame').contents().find(element).css('background-attachment', attachment);
      
      $('#preview_frame').contents().find(element).css('background-color', color );

       



}
function send_background(image){

            color = document.getElementById('background-color').value;
            
	    repeat = $("#background-repeat option:selected").val();
	 
	    attachment = $("#background-attachment option:selected").val();
if(image){


      $.get('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/background.php?' + 'update_bg=yes&background-image=url(css/<?php echo $template;?>/' + image + ')&background-color=' + encodeURIComponent(color) + '&background-repeat=' + encodeURIComponent(repeat) + '&background-attachment=' + encodeURIComponent(attachment) + '&element=' + encodeURIComponent(document.getElementById('background-element').value) , function(response){
      
	  update_bg();
	  prompt(response);
      $(document.getElementById('background-element').value).css('background-image', 'url("")');
      
      });


}else{
      $.get('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/background.php?' + 'update_bg=yes&background-image=url()&background-color=' + encodeURIComponent(color) + '&background-repeat=' + encodeURIComponent(repeat) + '&background-attachment=' + encodeURIComponent(attachment) + '&element=' + encodeURIComponent(document.getElementById('background-element').value) , function(response){
      
	  update_bg();
	  prompt(response);
      $(document.getElementById('background-element').value).css('background-image', 'url("")');
      
      });

}

}
	function change_background(element, color, attachment, repeat, fileName){
	
	
			  $('#preview_frame').contents().find(element).css('background-repeat', repeat);
			  
			  $('#preview_frame').contents().find(element).css('background-attachment', attachment);
			  
			  $('#preview_frame').contents().find(element).css('background-color', color );

			  document.getElementById('hiddenImg').value = 'url("<?php echo $SITE_URL;?>img/backgrounds/' + fileName + '")';
			
			    $('#preview_frame').contents().find(element).css('background-image', 'url("<?php echo $SITE_URL;?>img/backgrounds/' + fileName + '")');
			    

			
		    }
function createUploader(divId){
        
    if(divId){
	element = divId;
    }else{
    
	element = 'upload-button-logo';
    }     
          

 var uploader = new qq.FileUploader({

    // pass the dom node (ex. $(selector)[0] for jQuery users)

    element: document.getElementById( element),
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
	      'type': 'background', 
	      'path': '<?php echo $BASE_DIR;?>/css/<?php echo $template;?>/'},
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
	    
send_background($('.qq-upload-file').html());
change_background(element, color, attachment, repeat, $('.qq-upload-file').html());

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
      }

});
      }

        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load
       createUploader();
    </script>


<?php } ?>