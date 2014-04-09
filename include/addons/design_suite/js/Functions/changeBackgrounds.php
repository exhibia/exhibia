		
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