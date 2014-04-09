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