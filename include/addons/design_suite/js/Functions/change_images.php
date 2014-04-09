function change_images(){



		$("img").each(function() {
		
			new_url = this.src;
			
			  <?php if(!empty($button[0])){ ?>
			    
			    
			    new_url = new_url.replace(/<?php echo $button[0];?>/, <?php echo $_REQUEST['buttonset'];?>);
			    
			    <?php } ?>
			
		    $(this).attr('src', cacheBuster(new_url));
		    
		    
		});

		$("button").each(function() {
		    var bg_img = $(this).css("background-image");
		    
		    if (bg_img !== "none") {
			var url = /url\((.*)\)/i.exec(bg_img);
			if (url) {
			new_url = url[1];
			
			  <?php if(!empty($button[0])){ ?>
			    
			    
			    new_url = new_url.replace(/<?php echo $button[0];?>/, <?php echo $_REQUEST['buttonset'];?>);
			    
			    <?php } ?>
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
			
			  <?php if(!empty($button[0])){ ?>
			    
			    
			    new_url = new_url.replace(/<?php echo $button[0];?>/, <?php echo $_REQUEST['buttonset'];?>);
			    
			    <?php } ?>
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
			
			  <?php if(!empty($button[0])){ ?>
			    
			    
			    new_url = new_url.replace(/<?php echo $button[0];?>/, <?php echo $_REQUEST['buttonset'];?>);
			    
			    <?php } ?>
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
			
			  <?php if(!empty($button[0])){ ?>
			    
			    
			    new_url = new_url.replace(/<?php echo $button[0];?>/, <?php echo $_REQUEST['buttonset'];?>);
			    
			    <?php } ?>
			$(this).css("background-image", "url(" + cacheBuster(new_url) + ")");
			}
		    }
		}); 
		$("img, input[type=image]").each(function() {
		    	new_url = this.src;
			
			  <?php if(!empty($button[0])){ ?>
			    
			    
			    new_url = new_url.replace(/<?php echo $button[0];?>/, <?php echo $_REQUEST['buttonset'];?>);
			    
			    <?php } ?>
			
		    this.src = cacheBuster(new_url);
		  });
}

