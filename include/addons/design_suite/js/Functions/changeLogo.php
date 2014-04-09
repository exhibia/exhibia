
      function closestHandle(){}
      function changeLogo(){
      
 
	document.getElementById("preview-logo").src = cacheBuster('<?php echo $SITE_URL;?>img/logo.png');
	  
	  
		$('[title="logo"]').each(function() {
		
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
	
	 function change_logo(){
      
 ajax_PAS('include/addons/design_suite/DESIGN/logo.php?type=logo', 'get=sliderform', 'get','css-editor');		
			
	      
	}